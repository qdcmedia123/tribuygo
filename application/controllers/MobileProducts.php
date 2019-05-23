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

		// Sending emails 

    		

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
	    $mail->Host       = 'smtp.office365.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'info@tribuygo.com';                     // SMTP username
	    $mail->Password   = '$QDC$12345678$';                               // SMTP password
	    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
	    $mail->Port       = 587;                                    // TCP port to connect to

	    // This is client will receive the email from tribuy go 
	    $mail->setFrom('info@tribuygo.com', 'Mailer');
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
	    $mail->setFrom('info@tribuygo.com', 'Mailer');
	    $mail->addAddress('info@tribuygo.com', 'Tribuygo.com');
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

/*
		// Subject 
		if (strlen($subject) < 1) {
  			
  			$errors['subject'] = 'Subject is required.';
		}
		*/
		//  

		if (strlen($message) < 1) {
  			
  			$errors['message'] = 'Please type some message.';
		}

		return count($errors) < 1 ? true : $errors;

	}

	public function enquiryRequest() {

		
		// Check everthing is passing 
		if($this->common->RequiredForUsers() !== true) {

			 return $this->common->RequiredForUsers();
		}


		// Extract all variable 
		// Errors 
		$errors = '';
		$success = true;



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
			
		$data = ['data' => $this->input->post(), 'error' => $errors , 'success' => $success];

		return $this->output->set_output(json_encode($data));
		
	}




	}
