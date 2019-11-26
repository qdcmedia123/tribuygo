<?php
function getOnlyProductAsArray(array $keys, Memcached $m):array {

$val = array_filter($keys,"getOnlyProductKey");

//sort($val);

$len = count($val);

//echo $len;
// get all product 
$getallProdcut = [];

for($i = 0; $i <= $len; $i++) {

	if($m->get($i) !== false ) {

		$getallProdcut[] = $m->get($i);
	}
	
}

return $getallProdcut;

}


function getOnlyProductKey($var)
{
	$reg = '/^[0-9]{1,}$/';

	return preg_match($reg, $var);
}

function trimSearchKeyWord(string $string  ): string   {

	$string = trim($string);
	$string = rtrim($string);
	$string = preg_replace('/\s\s+/', ' ', $string);
	$string = strtolower($string);

	// Return search string 
	return $string;
}


function SearchProduct(Memcached $m, string $searchString,  int $page) :array {

    
    

    $stringToSearch = trimSearchKeyWord($searchString);

    $searchResult = [];
    
    // Get all the keys$ 
    $keys = $m->getAllKeys();

    // Count 
    $keyscount = count($keys);

    // Unset two key we already know that 
    //unset($keys['product_title']);
    //unset($keys['search_key_words']);

   if (($donotneed = array_search('product_title', $keys)) !== false) {
    	
    	unset($keys[$donotneed]);
	}

	if (($donotneed = array_search('search_key_words', $keys)) !== false) {
    	
    	unset($keys[$donotneed]);
	}


    foreach($keys as $key => $value) {

        
    	$title = $m->get($keys[$value])['title'];

    	// Check string post if there is data 
	    if(stripos(strtolower($title), $stringToSearch) !== false) {

	        $searchResult[] = $m->get($keys[$value]);
	    }
    }

    /*
    for($i = 0; $i < $keyscount; $i++) {

    	
    	// Here check with each 
    	// Get 
    	$title = $m->get($keys[$i])['title'];

    	// Check string post if there is data 
	    if(stripos(strtolower($title), $stringToSearch) !== false) {

	        $searchResult[] = $m->get($keys[$i]);
	    }



    }
    */

    // Make the number of page 
$perpage = 20;

// Number of result 
$numberOfResult = count($searchResult);

// Number of pages 
$numberOfPages = ceil($numberOfResult / $perpage);

// Page number 
$page = $page - 1;

$whichpage = $page + 1;



$skipfrom = $page * $perpage;




$message = [
            'status' => 404 , 
            'message' => 'Sorry, We are unable to find anything at the moment.',
            'search' => $searchString
        ];


return count($searchResult) > 0 ? 
                            [	//'result' => $searchResult,
                                'result' => $searchResult > 20 ? $searchResult : array_splice($searchResult, $skipfrom , $perpage),

                                'perpage' => $perpage,
                                'numberOfPages' => $numberOfPages,
                                'numberOfResult' => $numberOfResult,
                                'page' => $whichpage,
                                'status' => 400
                            ] : 
                            ['result' => $message];


}




// Search product in memcahced 

// $searchString = 'Apple MacBook Pro MPXQ2 Laptop - Intel Core i5, 2.3Ghz Dual Core, 13-Inch, 128GB SSD, 8GB, English Keyboard, Mac OS Sierra, Space Gray - International Version';

$searchString = 'samsung';

$m = new Memcached();
$m->addServer('localhost', 11211);
// Get the product in array getOnlyProductAsArray(array $keys, Memcached $m)
$keys = $m->getAllKeys();

//$products = getOnlyProductAsArray($keys, $m);

$searchResult = SearchProduct($m, $searchString,  3);

$didyoumean = false;


if($searchResult['status'] !== 400) {

            // Then again go and search by the given suggessing 
            $didyoumean = true;

            $words = array_map('urldecode', $searchKeys);
            $words = array_map('strtolower', $words);

            $result = $this->didyoumean($words, $searchString);

            // Get the string 
            $didyoumean = $result['string'];

            // Check if not empty 
            if($didyoumean !== '') {

                // Again search for 
                $searchResult = SearchProduct($m, $didyoumean,  $page);
            }


        }



echo json_encode($searchResult);



//echo json_encode(IfProductFound($productTitles, $searchString, $productSearchResult, $searchKeys));