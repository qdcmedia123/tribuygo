<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller { 

	public function __construct() {
        
        parent:: __construct();

        $this->load->helper('url');

        // Get the config keys 
        $this->load->helper('server');
        
   }


	public function index(){

		$this->load->view('administrator/index');
		
	}

	public function keywords() {

		// Load the keywords from db 
		$keywords = $this->getKeywords();

		// Get the all keywords here 
		$this->load->view('administrator/keywords', $keywords); 
	}

	public function addKeywords() {

		$this->load->view('administrator/add_keywords'); 
	}

	// Get the keywords 
	public function getKeywords():array {

		// Result = 
		$result = []; 
		
		// Using Memcached 
        $m = new Memcached();

        // Add server 
        $m->addServer(HOST_NAME, MEMCACHED_PORT);

        // Get the search keys 
		$searchKeys = $m->get('search_key_words');

		// Get the all search 
		count($searchKeys) > 0 ? $result['result'] = $searchKeys : $result['result'] = 'Unable to find antyhing.';

		// Return result 
		return $result; 

	}

	// List items under the keyswords 
	public function listItemUnderTheKeyWords() {

			

			$this->load->view('administrator/list_items');
	}


}

