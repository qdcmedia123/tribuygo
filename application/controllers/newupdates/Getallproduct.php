<?php
require ('../../../../vendor/autoload.php');
$searchString = "Samsung galaxy note 9 -Case -Cover";
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->tribuygo->products;

//$collection->createIndex(["title" => "text"]);
//$collection->createIndex(["keyword" => "text"]);

print_R($collection->getIndexes());
exit();


//$collection->drop();

//exit();


$page = 1;

// Number of rows 
$numOfRows = $collection->count(
								['$text' => [ '$search' => $searchString]], 
							
								['score' => ['$meta' => "text Score"],
								'projection' => ['_id' => true]
						    ]);
// Make the number of page 
$perpage = 20;

$totalResult = $numOfRows;

// Number of result 
$numberOfResult = $totalResult;

// Number of pages 
$numberOfPages = ceil($numberOfResult / $perpage);

$page = $page ?? 1;


// Page number 
$page = $page - 1;

$whichpage = $page + 1;

$skipfrom = $page * $perpage;



// Setting options 
$options =  [
	'limit' => $perpage,
    'skip' => $skipfrom,
    'projection' => [
        "title"=> true,
        "image"=> true,
        "price"=> true,
        "description"=> true,
        "review"=> true,
        "shipping"=> true,
        "original_price"=> true,
        "discount_price"=> true,
        "ratings"=> true,
        "stock"=> true,
        "offer"=> true,
        "website"=> true,
        "keyword"=> true,
        'score' => ['$meta' => 'textScore'],
	],
    'sort' => [
        'score' => ['$meta' => 'textScore']
        ]
];


$search = ['$text' => [ '$search' => $searchString]];


/*$result = $collection->find($search, $options);
*/
$result = $collection->find($search, $options);


$papgeResult = [];


foreach ($result as $entry) {

	$papgeResult[] = $entry;
}



$message = [
            'status' => 404 , 
            'message' => 'Sorry, We are unable to find anything at the moment.',
            'search' => $searchString
        ];

$result =  $totalResult > 0 ? 
                            [	//'result' => $searchResult,
                                'result' => $papgeResult,

                                'perpage' => $perpage,
                                'numberOfPages' => $numberOfPages,
                                'numberOfResult' => $numberOfResult,
                                'page' => $whichpage,
                                'status' => 400
                            ] : 
                            $message;




echo json_encode($result);