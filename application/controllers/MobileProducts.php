<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MobileProducts extends CI_Controller {
 
public $accessKey = '68c7d5436dcd487bbc1df43a9a6acc51716cc79c';


public function __construct() {
       

        parent:: __construct();
        ini_set('display_errors', 1);
        $this->load->helper('url');
        
        $this->load->library('../controllers/common');
   
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
		
		// Check everthing is passing 
		if($this->common->RequiredForUsers() !== true) {

			 return $this->common->RequiredForUsers();
		}

		// Search string must send 
		if(strlen($this->input->post('search')) < 2) {

			$message = [
							'status' => '411',
							'error' => 'Search string length must be greater then 3'
						];

			return $this->output
			->set_content_type('application/json')
			->set_output(json_encode($message));
		}


		//$searchString = $this->input->post('search') ?? '';
		$searchString = $this->input->post('search');

		$m = new Memcached();
		$m->addServer('localhost', 11211);
		$productTitles = $m->get('product_title');
		$searchKeys = $m->get('search_key_words');
		$productSearchResult = $m->get('product_search_result');


		$output = $searchString !== '' ? json_encode($this->common->IfProductFound($productTitles, $searchString, $productSearchResult, $searchKeys)) : [];
		
		return $this->output->set_output($output);


	}


	public function productLocations() {


		
		// Check everthing is passing 
		if($this->common->RequiredForUsers() !== true) {

			 return $this->common->RequiredForUsers();
		}
		

		// Set content header type 
        header('Content-Type: application/json'); 

          // Get the config keys 
        $this->load->helper('server');

        // Using Memcached 
        $m = new Memcached();

        // Add server 
        $m->addServer(HOST_NAME, MEMCACHED_PORT);

        // Product title 
        $productTitles = $m->get('product_title');

        // Keyworlds 
        $searchKeys = $m->get('search_key_words');

        // Sugesstion 
        $suggesstion = [];

        // Loop each keyworld 
        if(is_array($searchKeys ) && count($searchKeys ) > 0) {

        foreach($searchKeys as $key => $value ) {

        // Change value 
        $value = ucfirst (urldecode($value));

        // Suggesstion 
        $suggesstion[] = [
                        'listLocation' => $value,
                        'header' => "--$value--"
                    ];
        } 


        $result['result'] = $suggesstion;
         
        return $this->output->set_output(json_encode($result));
        
        }

        // REST FUL ERROR MESSAGE 
        $msg = json_encode(['status' => '404', 'message' => 'Opps, We are unable to find something.']);

        // Send message 
        return $this->output->set_output(json_encode($msg));
        
    }


    public function productSugesstion() {

    	// Check everthing is passing 
		if($this->common->RequiredForUsers() !== true) {

			 return $this->common->RequiredForUsers();
		}
		
    	// Set the header 
		header('Content-Type: application/json'); 
		
		// Load the configuration file 

		// Get the config keys 
        $this->load->helper('server');

		// Using Memcached 
        $m = new Memcached();

        // Add server 
        $m->addServer(HOST_NAME, MEMCACHED_PORT);


		$productTitles = $m->get('product_title');

		$searchKeys = $m->get('search_key_words');

		$suggesstion = [];

		if(is_array($productTitles) && count($productTitles) === count($searchKeys )) {

		foreach($searchKeys as $key => $value ) {

		   $suggesstion[ucfirst (urldecode($value))] = $productTitles[$key];
		
		} 

		// Sugession 
		$result['result'] = $suggesstion;

		return $this->output->set_output(json_encode($result));
		
		}

		 // REST FUL ERROR MESSAGE 
        $msg = json_encode(['status' => '404', 'message' => 'Opps, We are unable to find something.']);

        // Send message 
        return $this->output->set_output(json_encode($msg));
		

		}
    



	}
