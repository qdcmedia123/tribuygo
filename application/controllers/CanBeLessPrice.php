<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CanBeLessPrice extends CI_Controller {

public function __construct() {
       

        parent:: __construct();
        ini_set('display_errors', 1);
        $this->load->helper('url');
        
   
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


		$searchString = $this->input->post('search') ?? '';

		$m = new Memcached();
		$m->addServer('localhost', 11211);
		$productTitles = $m->get('product_title');
		$searchKeys = $m->get('search_key_words');
		$productSearchResult = $m->get('product_search_result');


		$output = $searchString !== '' ? json_encode($this->IfProductFound($productTitles, $searchString, $productSearchResult, $searchKeys)) : [];
		
		
		//$_SESSION['test'] = rand(1, 10);

		$data = ['output' => $output, 'searchString' => $searchString];

		$this->load->view('can-be-less-price/templates/header');
		$this->load->view('can-be-less-price/contents/index', $data);
		$this->load->view('can-be-less-price/templates/footer');
	}

	public function defaut_page() {


		$this->load->view('lessprice/index');
		

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

		// defined variable 


		// Return something 
		$response = ['result' => '', 'csrf' => $csrf, 'data' => $this->input->post(), 'success' => true];

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


	
}
