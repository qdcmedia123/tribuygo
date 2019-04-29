<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Common  {

	private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
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

	
// Commin data checking 
public function RequiredForUsers() {

	// Defining message 
		$message = [];


		// Request method must post 
		if($this->CI->input->method() !== 'post') {

			$message = [
							'status' => '401',
							'error' => 'Request method is not allowed.'
						];

			return $this->CI->output
			->set_content_type('application/json')
			->set_output(json_encode($message));

		}
	

		if($this->CI->input->post('accesskey') === NULL) {

			$message = [
							'status' => '401',
							'error' => 'Unauthorized, Access key is required.'
						];

			return $this->CI->output
			->set_content_type('application/json')
			->set_output(json_encode($message));
		}

		// Check the access key 

		if($this->CI->input->post('accesskey') !== $this->CI->accessKey) {

			$message = [
							'status' => '401',
							'error' => 'Unauthorized, Invalid access key.'
						];

			return $this->CI->output
			->set_content_type('application/json')
			->set_output(json_encode($message));
		}

		
		return true;
}

}