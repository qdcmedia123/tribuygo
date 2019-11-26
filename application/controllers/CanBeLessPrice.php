<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CanBeLessPrice extends CI_Controller {

public function __construct() {
       

        parent:: __construct();
        ini_set('display_errors', 1);
        $this->load->helper('url');
        $this->load->helper('credential');

        
        
   
    }


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		

		//$searchString = $this->input->post('search') ?? '';

		//$searchString = 'tv';

		$searchString = $this->input->get('search', TRUE);
		$page = $this->input->get('page', TRUE);
		$searchString = urldecode($searchString);
		$m = new Memcached();

		
		$m->addServer('localhost', 11211);
		// Get the product in array getOnlyProductAsArray(array $keys, Memcached $m)
		$keys = $m->getAllKeys();
		
		$searchKeys = $m->get('search_key_words');


$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->tribuygo->products;
$searchString = $searchString."-cover -case -pen -watch -STANDING -COVER";

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

// Cover

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

/*
'sort' => [
        'score' => ['$meta' => 'textScore']
        ]
*/


$search = ['$text' => [ '$search' => $searchString]];


$result = $collection->find( $search, $options);




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
                                'search' => $searchString,
                                'perpage' => $perpage,
                                'numberOfPages' => $numberOfPages,
                                'numberOfResult' => $numberOfResult,
                                'whichpage' => $whichpage,
                                'page' => $whichpage,
                                'status' => 400,
                                'didyoumean' => false
                            ] : 
                            $message;






		

		$this->load->view('can-be-less-price/templates/header');
		$this->load->view('can-be-less-price/contents/index', ['output' => $result]);
		$this->load->view('can-be-less-price/templates/footer');
	}


	

	public function didyoumean(array $words, string $input) {

		// no shortest distance found, yet
		$shortest = -1;

		// Get all matched words 

		// loop through words to find the closest
		foreach ($words as $word) {

		// calculate the distance between the input word,
		// and the current word
		$lev = levenshtein($input, $word);

		// check for an exact match
		if ($lev == 0) {

		    // closest word is this one (exact match)
		    $closest = $word;
		    $shortest = 0;

		    // break out of the loop; we've found an exact match
		    break;
		}

		// if this distance is less than the next found shortest
		// distance, OR if a next shortest word has not yet been found
		if ($lev <= $shortest || $shortest < 0) {
		    // set the closest match, and shortest distance
		    $closest  = $word;
		    $shortest = $lev;
		}
		}

		// Return data 
		return $shortest === 0 ? ['exactmatch' => true, 'string' => $closest, 'didyoumean' => null] : ['exactmatch' => null, 'string' => $closest, 'didyoumean' => true];



}





	public function GetOnlyProductFromMemcached(Memcached $m, array $data) :array {

		// Filter array 
		$val = array_filter($data, array($this, 'getOnlyProductKey'));

		// Sort 
		sort($val);

		// Array length 
		$len = count($val);

		// Product search result
		$productSearchResult = [];

		for($i = 0; $i <= $len; $i++) {

		$productSearchResult[] = $m->get($i);

		}

		// Return the data 
		return $productSearchResult;

	}

	function getOnlyProductKey(string $var):string {
	
		$reg = '/^[0-9]{1,}$/';

		return preg_match($reg, $var);
	}

	public function defaut_page() {


		$this->load->view('lessprice/index');
		

	}


public function getOnlyProductAsArray(array $keys, Memcached $m):array {

$val = array_filter($keys, array($this, "getOnlyProductKey"));

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




public function trimSearchKeyWord(string $string  ): string   {

    $string = trim($string);
    $string = rtrim($string);
    $string = preg_replace('/\s\s+/', ' ', $string);
    $string = strtolower($string);

    // Return search string 
    return $string;
}


public function SearchProduct(Memcached $m, string $searchString,  string $page) :array {

    $stringToSearch = $this->trimSearchKeyWord($searchString);

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
                            [    //'result' => $searchResult,
                                'result' => count($searchResult) <= 20 ? $searchResult : array_splice($searchResult, $skipfrom , $perpage),

                                'perpage' => $perpage,
                                'numberOfPages' => $numberOfPages,
                                'numberOfResult' => $numberOfResult,
                                'page' => $whichpage,
                                'status' => 400,
                                'search' => $searchString,
                                'whichpage'=>$whichpage,
                                'page' => $whichpage
                            ] : 
                            ['result' => $message];


}



	public function IfProductFound( 
						array $productTitles, 
						string $searchString, 
						array $productSearchResult, 
						array $searchKeys ):array {

	$finding = false;

	foreach($productTitles as $key => $value) {

	$found = false;

	// Again value foreach 
	foreach($value as $iKey => $iValue) {
		// Match the string 
		if(strtolower($iValue) === strtolower($searchString)) {

			// Set the variable 
			$found = true;

			// Break the  loop
			break;
		}
	}

	// Check if found is true 
	if($found === true ) {

		// Exchange key value 
		$copyFirstIndex = $productSearchResult[$key][0];

		$productSearchResult[$key][0] = $productSearchResult[$key][$iKey];

		$productSearchResult[$key][$iKey] = $copyFirstIndex;

		$finding =  [ 'result' => $productSearchResult[$key], 'index_to_find' => $iKey];
		// Then break the loop 
		break;
	}  

	}

	if($finding === false ) {

		// If nothing found we still need to look if the keyword is matching in the product search array array somewhere 
		foreach($searchKeys  as $key => $value ) {

			
			// If search string is greater then value 
			$found = strlen($value) <= strlen($searchString) ? stripos($searchString, urldecode ($value)) : stripos(urldecode($value), $searchString);
			
			// Check if it is false 
			if($found !== false ) {

				$finding = ['result' => $productSearchResult[$key]];

				break;
			}
		}
	}
	
	// Return finding 
	return $finding ? $finding : ['status' => 404, 'message' => 'Opps, We are unable to find anything right at the moment.', 'searchString' => $searchString];

}

	

	public function  joinus() {

		$this->load->view('can-be-less-price/templates/header');
		$this->load->view('can-be-less-price/contents/joinus');
		$this->load->view('can-be-less-price/templates/footer');
	}

	public function joinUsRequest(){

		// Return somet
		$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);

		extract($this->input->post());
		
		$subject = '';

		$error = $this->SendMailToRecipent($message, $email, $subject) !== true ? $this->SendMailToRecipent($message, $email, $subject) : [];

		// defined variable 



		// Return something 
		$response = ['result' => '', 'csrf' => $csrf, 'data' => $this->input->post(), 'success' => true, 'error' => []];

		return $this->output->set_output(json_encode($response));
		
	}

	public function joinUsRequestValidation(string $email,
											string $message,
											string $mobile,
											string $name,
											string $subject
											) {

		// Return message 
		$errors = [];

		// followin varialbe is required 
		// email, message, mobile, name, subject 
		// status on errro 411 length required 
		// Check the name 
		if(!isset($name) || strlen($name) < 2) {

			// Message 
			$errors = ['error' => 'Name is required.', 'status' => 411];

			// Return error 
			return $errors;

		}

		if(!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

			// Message 
			$errors = ['error' => 'Email addresss required.', 'status' => 411];

			// Return error 
			return $errors;
		}

		// Message 
		if(!isset($message) || strlen($message) < 5) {

			// Message 
			$errors = ['error' => 'Email addresss required.', 'status' => 411];

			// Return error 
			return $errors;
		}

		// Check number 
		$regression = '/^[0-9]$/';

		if(!isset($mobile) || !preg_match($mobile)) {

			// Message 
			$errors = ['error' => 'Mobile number is required.', 'status' => 411];

			// Return error 
			return $errors;
		}
	
		// Check the  subject 
		if(!isset($subject) || strlen($subject) < 2) {

			// Message 
			$errors = ['error' => 'Subject is  required.', 'status' => 411];

			// Return error 
			return $errors;
		}

		// Return true 
		return true;

	}


	


	public function enquiryRequest() {

		$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);

		// Extract all variable 
		// Errors 
		$errors = '';
		$success = '1';


		if($this->enquiryValidation($this->input->post()) !== true) {

			$errors = $this->enquiryValidation($this->input->post());
			$success = false;
		}

		
		// if error is empty 
		if($errors  === '') {
			// Extract post 
			extract($this->input->post());

			$subject = 'Thank you for contacting us, We will get back to you sortly.';
			// Send email to the client 
			// 
			$this->SendMailToRecipent($message, $email, $subject);
			


		}
			
		$data = ['csrf' => $csrf, 'data' => $this->input->post(), 'error' => $errors , 'success' => $success];

		return $this->output->set_output(json_encode($data));
		
	}

	public function enquiryValidation(array $enquiry_form) {

		//data: {name: "a", mobile: "", email: "", subject: "", message: ""}
		// Extract 
		extract($enquiry_form);

		// Errors 
		$errors = [];

		if(strlen($name) < 1) {

			$errors['name'] = 'Name field is required';
		}

		// Check mobile 
		if(strlen($mobile) < 8) {

			$errors['mobile'] = 'Mobile number is required.';
		}

		// Check email address '
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			
  			$errors['email'] = 'Email address is required.';
		} 

		// Subject 
		if (strlen($subject) < 1) {
  			
  			$errors['subject'] = 'Subject is required.';
		}

		//  

		if (strlen($message) < 1) {
  			
  			$errors['message'] = 'Please type some message.';
		}

		return count($errors) < 1 ? true : $errors;

	}

	

	public function SendMailToRecipent(string $message, string $to, string $subject){

		// Somevariable is different 
		$subject = '';
		$website = $this->input->post('website') ?? '';
		// contact type 
		$contact_type = $this->input->post('contact_type') ?? '';

		$additionalInfo = '';
		// Two var is different 
		if($website !== '') {

			$additionalInfo = '<li>Website : '.$website.'</li>
								<li>Contact Type: '.$contact_type.'</li>';
		} 

		// Extract the post message 

		// load the library 
		$this->load->library("Phpmailer_library");
		
		$mail = $this->phpmailer_library->load();

	
	    //Server settings
	    $mail->SMTPDebug = false;                                       // Enable verbose debug output
	    $mail->isSMTP();                                            // Set mailer to use SMTP
	    $mail->Host       = SMTP_HOST;  // Specify main and backup SMTP servers
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = SMTP_USERNAME;                     // SMTP username
	    $mail->Password   = SMTP_PASSWORD;                               // SMTP password
	    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
	    $mail->Port       = 587;                                    // TCP port to connect to

	    // This is client will receive the email from tribuy go 
	    $mail->setFrom(SMTP_USERNAME, 'Mailer');
	    $mail->addAddress($to, 'Client');     // Add a recipient
	    
	    
	    $mail->addReplyTo($to, 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    
	    /*
	    	Template 

			Dear customer 

			We appreciate your email, We shall get back to you in 2 working days.


			Best Regards 

			tribuygo Support Team 

	    */
	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Thank you for contacting us';
	    $mail->Body    = 'Dear customer 
	    							<br/>
	    				We appreciate your email, We shall get back to you in 2 working days.

	    				<br/>
	    				<br/>

	    			Best Regards 

	    			<br/>

					tribuygo Support Team 


	    					';
	    //$mail->AltBody = 'Our customer service processing your request, we will get back to you sortly';

	    $mail->send();

	    // Clear all recepinent 
		$mail->ClearAllRecipients();
		/*
		csrf_test_name:csrfid,
        name: name.val(),
        mobile: mobile.val(),
        email: email.val(),
        subject: subject.val(),
        message: message.val()
        */

        extract($this->input->post());


	    // This is where we will receive the email 
	    $mail->setFrom(SMTP_USERNAME, 'Mailer');
	    $mail->addAddress(SMTP_USERNAME, 'Tribuygo.com');
	    $mail->addReplyTo($to, 'Information');

	    $mail->Subject = $subject;
	    $mail->Body    = "Please find the below details of the client <br/>
	    					<ul>
	    						<li>Full Name: $name</li>
	    						<li>Mobile: $mobile</li>
	    						<li>Email Address: $email</li>
	    						$additionalInfo
	    						<li>Message:</li>
	    						<br/>
	    						$message
	    					</ul>
	    				";
	    $mail->AltBody = $message;

	    $mail->send();


		return true;

	}


	public function testing() {

		// Load unite Library 

		$test = 1 +1 ;

		$this->load->library('unit_test');

		$expected_result = 1;

		$test_name = 'Adds one plus one';

		$this->unit->run($test, $expected_result, $test_name);

		echo json_encode($this->unit->result());

	}

	public function privacyandpolicy() {

		$this->load->view('can-be-less-price/templates/header');
		$this->load->view('can-be-less-price/contents/privacyandpolicy');
		$this->load->view('can-be-less-price/templates/footer');
	}


	

	
}
