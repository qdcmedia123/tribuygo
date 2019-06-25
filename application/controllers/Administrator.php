<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller { 

    // Username 
    private $username = 'info@qdc.ae';
    private $password;


    public function __construct() {
        
        parent:: __construct();

        $this->load->helper('url');

        // Get the config keys 
        $this->load->helper('server');

        // Session library 
        $this->load->library('session');

        // Setting the passowrd 
        $this->password = password_hash('Qdc@media123', PASSWORD_DEFAULT);
        
   }


    public function index(){

        if($this->session->has_userdata('administrator') !== true) {

            redirect('/login');
        }

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

                                                                                        
            // Check something found  
            
            // Json encode 
            $result['result'] = $this->GetProductByIndex();

            $this->load->view('administrator/list_items', $result);
    }

    public function GetProductByIndex() {

            $index =  $this->uri->segment(3);
            // Get the items 

            // Using Memcached 
            $m = new Memcached();

            // Add server 
            $m->addServer(HOST_NAME, MEMCACHED_PORT);

            


            // Set the resut 
            return  json_encode($m->get($index) ?? ['status' => 404, 'message' => 'Unable to find the product']);   

    }

    // Add keyword to the script to memcached 
    public function addKeyWordToMemcached() {

        header('Content-Type: application/json'); 
        // Defining message 
        

        // Check if data posted 
        $keyword = $this->input->post('keyword');

        // If null 
        if($keyword === NULL || strlen($keyword) < 3) {

            $message = ['error' => ['message'=> 'Keyword must string length must be greater then 2']];

            // return $this->output->set_output(json_encode($result));
            // Return message 
            return $this->output->set_output(json_encode($message));


        }

        // Run the script 
        if($this->FetchAndSetProducts($keyword) === true) {

            return $this->output->set_output(json_encode(['success' => true]));
            
        }

        // Set some error 
        $message = ['error' => ['message'=> 'Something went wrong.']];

        return $this->output->set_output(json_encode($message));

    }


    

    public function GetMaxRecord($records)  {
        return max(array_map(function ($items) {
            return count($items) ;
        }, $records));
    }



    public function FetchAndSetProducts($keyword)
    {       
        $doc = new DOMDocument();

        // Restore error level
        //libxml_use_internal_errors(false);
         // count keyworld 
        $countKeyword = str_word_count($keyword);

        $internalErrors = libxml_use_internal_errors(true);

        $search_key = urlencode($keyword);

        // count keyworld 
  $countKeyword = str_word_count($keyword);


    $data = [




        [
            
            'url' => 'https://www.amazon.ae/s?k='.$search_key.'&ref=nb_sb_noss',
            'attributes' => [
                                'title' => '//span[@class ="a-size-medium a-color-base a-text-normal"]',
                                'image' => '//div[@class="a-section aok-relative s-image-fixed-height"]/img/@src',
                                'price' => "//span[@class='a-price-whole']",
                                'description'=> "//a[@class='a-link-normal a-text-normal']/@href",
                                'review' => "//span[@class='rating-stars']",
                                'shipping' => "//div[@class='a-row']//span[@dir='auto']",
                                'original_price' => "//span[@class='a-price-whole']",
                                'discount_price' => "//span[@class='a-color-base']",
                                'ratings' => "//span[@class='rating-stars']//i[@class ='star-rating-svg']//i/@style",
                                'stock' => "//span[@class='a-color-price']",
                                'offer' => "//a[@class='a-link-normal']",
                                                                                                                    
                            ]
        ],
        
        [
            
            'url' => 'https://www.ebay.com/sch/i.html?_from=R40&_trksid=m570.l1313&_nkw='.$search_key.'&_sacat=0',
            'attributes' => [
                                'title' => '//h3[@class ="s-item__title"]',
                                'image' => '//img[@class="s-item__image-img"]/@src',
                                'price' => "//div[@class='s-item__detail s-item__detail--primary']//span[@class='s-item__price']",
                                'description'=> "//div[@class='s-item__image']//a/@href",
                                'review' => "//span[@class='rating-stars']",
                                'shipping' => "//span[@class='s-item__shipping s-item__logisticsCost']",
                                'original_price' => "//span[@class='a-price-whole']",
                                'discount_price' => "//span[@class='a-color-base']",
                                'ratings' => "//span[@class='rating-stars']//i[@class ='star-rating-svg']//i/@style",
                                'stock' => "//span[@class='s-item__time-end']",
                                'offer' => "//a[@class='a-link-normal']",
                                                                                                                    
                            ]
        ],
        
                [
            
            'url' => 'https://www.virginmegastore.ae/en/search/?text='.$search_key,
            'attributes' => [
                                'title' => '//a[@class ="name"]',
                                'image' => '//img[@itemprop="image"]/@src',
                                'price' => "//span[@class='price']",
                                'description'=> "//a[@class='thumb']/@href",
                                'review' => "//div[@class='tf-based']//div[@class='tf-count']",
                                'shipping' => "//span[@class='s-item__shipping s-item__logisticsCost']",
                                'original_price' => "//span[@class='a-price-whole']",
                                'discount_price' => "//span[@class='a-color-base']",
                                'ratings' => "//span[@class='tf-stars-svg']/@style",
                                'stock' => "//span[@class='s-item__time-end']",
                                'offer' => "//a[@class='a-link-normal']",
                                                                                                                    
                            ]
        ],





[
            'url' => 'https://www.erosdigitalhome.ae/catalogsearch/result/?q='.$search_key,
            'attributes' => [
                                'title' => '//a[@class ="product-item-link"]',
                                'image' => '//img[@class="product-image-photo"]//@src',
                                'price' => "//span[@class='price']",
                                'description'=> "//a[@class='product-item-link']/@href",
                                 'review' => "//span[@class='rating-stars']",
                                'shipping' => "//div[@class='free-shipping fs-ab-black']",
                                'original_price' => "//p[@class='comp-productcard__price']",
                                'discount_price' => "//span[@class='onoffer']",
                                'ratings' => "//span[@class='onoffer']",
                            ]
        ],
[
            'url' => 'https://www.axiomtelecom.com/home/search?q='.$search_key,
            'attributes' => [
                                'title' => '//span[@class ="variant-title"]/a',
                                'image' => "//div[@id='content-slot']//div[@class='variant-image']//img/@src",
                                'price' => "//span[@class='variant-final-price']",
                                'description'=> "//span[@class='variant-title']/a/@href",
                                'review' => "//span[@class='rating-stars']",
                                'shipping' => "//div[@class='free-shipping fs-ab-black']",
                                'original_price' => "//span[@class='variant-list-price']",
                                'discount_price' => "//span[@class='variant-list-price']",
                                'ratings' => "//span[@class='onoffer']",
                            ]
        ],
            [
            
            'url' => 'https://www.newegg.com/global/ae-en/p/pl?d='.$search_key.'&ignorear=0&N=-1&isNodeId=1&Submit=ENE&DEPA=0&Order=BESTMATCH',
            'attributes' => [
                                'title' => '//a[@class="item-title"]',
                                'image' => '//a[@class="item-img"]/img/@src',
                                'price' => '//li[@class="price-current"]',
                                'description'=> '//a[@class="item-img"]/@href',
                                'review' => "//span[@class='rating-stars']",
                                'shipping' => "//div[@class='a-row']//span[@dir='auto']",
                                'original_price' => "//span[@class='a-price-whole']",
                                'discount_price' => "//span[@class='a-color-base']",
                                'ratings' => "//span[@class='rating-stars']//i[@class ='star-rating-svg']//i/@style",
                                'stock' => "//span[@class='a-color-price']",
                                'offer' => "//a[@class='a-link-normal']",
                                                                                                                    
                            ]
        ],

        

        [
            
            'url' => 'https://www.alibaba.com/products/'.$search_key.'.html',
            'attributes' => [
                                'title' => "//h2[@class='title two-line']//a/@title",
                                'image' => "//div[@class='offer-image-box']//img/@src",
                                'price' => "//div[@class='price']",
                                'description'=> "//h2[@class='title two-line']//a/@href",
                                'review' => "//span[@class='rating-stars']",
                                'shipping' => "//div[@class='a-row']//span[@dir='auto']",
                                'original_price' => "//span[@class='a-price-whole']",
                                'discount_price' => "//span[@class='a-color-base']",
                                'ratings' => "//span[@class='rating-stars']//i[@class ='star-rating-svg']//i/@style",
                                'stock' => "//span[@class='a-color-price']",
                                'offer' => "//a[@class='a-link-normal']",
                                                                                                                    
                            ]
        ],


        [
            'url' => 'https://www.jumbo.ae/home/search?q='.$search_key.'/s/?as=1',
            'attributes' => [
                                'title' => '//span[@class = "variant-title"]/a',
                                'image' => "//div[@id='content-slot']//div[@class='variant-image']//img/@src",
                                'price' => "//div[@id='content-slot']//span[@class='variant-final-price']",
                                'description'=> "//span[@class='variant-title']/a/@href",
                                //need to add host name fot the description url
                                'review' => "//span[@class='rating-stars']",
                                 'shipping' => "//div[@class='free-shipping fs-ab-black']",
                                 'original_price' => "//span[@class='variant-list-price']",
                                'discount_price' => "//span[@class='variant-list-price']",
                                'ratings' => "//span[@class='tf-stars-svg']/@style",


            ]
        ],
[
            'url' => 'https://www.noon.com/uae-en/search?q='.$search_key,
            
            'attributes' => [
                                'title' => "//*[contains(concat(' ', normalize-space(@class), ' '), 'name')]",
                                'image' => "//*[contains(concat(' ', normalize-space(@class), ' '), 'imageContainer')]//div//div//img/@src",
                                'price' => "//*[contains(concat(' ', normalize-space(@class), ' '), 'sellingPrice')]",
                                'description'=> "//*[contains(concat(' ', normalize-space(@class), ' '), 'product gridView')]/@href",
                                 //need to add host name fot the description url
                                'review' => "//span[@class='rating-stars']",
                                'shipping' => "//div[@class='free-shipping fs-ab-black']",
                                'original_price' => "//span[@class='jsx-3248044173 preReductionPrice']",
                                 'discount_price' => "//span[@class='jsx-3248044173 discountBadge']",
                                 'ratings' => "//span[@class='onoffer']",
                            
                                 
                                 

                            ]
        ],


[
            'url' => 'https://uae.microless.com/search/?query='.$search_key,
            'attributes' => [
                                'title' => '//div[@class ="product-title"]/a',
                                'image' => "//*[contains(concat(' ', normalize-space(@class), ' '), 'product-image')]//a//img/@data-src",
                                //$nodes = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'product-image')]//a//img/@data-src")->item(0)->nodeValue;
                                'price' => "//span[@class='amount']",
                                'description'=> "//div[@class='product-title']/a/@href",
                                'review' => "//span[@class='rating-stars']",
                                'shipping' => "//div[@class='free-shipping']",
                                'original_price' => "//span[@class='price-old']",
                                'discount_price' => "//div[@class='product-discount-badge']",
                                'ratings' => "//span[@class='onoffer']",
                            ]
        ],
[
            'url' => 'https://www.amazon.com/s?k='.$search_key.'&ref=nb_sb_noss_2',
            'attributes' => [
                                'title' => '//span[@class ="a-size-medium a-color-base a-text-normal"]',
                                'image' => '//img[@class="s-image"]/@src',
                                'price' => "//span[@class='a-color-base']",
                                'description'=> "//a[@class='a-link-normal a-text-normal']/@href",
                                //need to add host name fot the description url
                                'review' => "//span[@class='starRating__count']",
                                'shipping' => "//span[@class='a-size-small a-color-secondary']",
                               'original_price' => "//span[@class='a-offscreen']",
                                'discount_price' => "//div[@class='product-discount-badge']",
                                'ratings' => "//span[@class='a-icon-alt']",
                            ]
        ],
        
        [
            'url' => 'https://www.carrefouruae.com/mafuae/en/search='.$search_key,
            'attributes' => [
                                'title' => '//p[@class ="comp-productcard__name"]',
                                'image' => '//img[@class="comp-productcard__img"]//@src',
                                'price' => "//p[@class='comp-productcard__price']",
                                'description'=> "//div[@class='comp-productcard__wrap']/a/@href",
                               'review' => "//span[@class='rating-stars']",
                               'shipping' => "//div[@class='free-shipping fs-ab-black']",
                               'original_price' => "//p[@class='comp-productcard__price']",
                               'discount_price' => "//span[@class='onoffer']",
                               'ratings' => "//div[@class='free-shipping fs-ab-black']",
                            ]
        ]
];





    $output = [];

    $siva = [];


    foreach ($data as $item) {
        $content = file_get_contents($item['url']);

        $doc->loadHTML($content);

        $xpath = new DomXPath($doc);

        // get grouped
        $groupedItems = [];

        // James
        $all = [];


        foreach ($item['attributes'] as $key => $value) {

            if ($xpath->query($value) === false) {

                continue;
                
            } else {

                $Inner = [];

                for ($j = 0; $j < $xpath->query($value)->length; $j++) {
                   
                    // We need some filed is required such as title, price , image must matched 

                    // if($j === 15) { break; }
                    // Getting value 
                    $valudNodes = preg_replace('/\s\s+/', ' ', trim($xpath->query($value)->item($j)->nodeValue, "\t\n\r\0\x0B"));;

                    // Some data need to be escaped proovided by ebay 
                    // Ebay some images is not provided thefore we need to escape those data 
                    // We are not storing those data in our database 

                    // IF key is image 
                    if($key === 'image') {

                        // if value is static images
                        if ($valudNodes === 'https://ir.ebaystatic.com/cr/v/c1/s_1x2.gif') {

                            continue;
                        }
                    }
                    if($key === 'title' || $key === 'price' || $key === 'image') {

                        // Check item containe something 
                        if($valudNodes === '') {

                            continue;
                        }
                    }

                    $Inner[] = $valudNodes;
                }

                $all[$key] = $Inner;


                $val = $xpath->query($value)->item(0)->nodeValue ?? '';

                $groupedItems[$key] = preg_replace('/\s\s+/', ' ', trim($val, "\t\n\r\0\x0B"));
            }
        }



        $parseurl = parse_url($item['url'])['host'];

        $siva[$parseurl] = $all;

        $output ["$parseurl"] = $groupedItems;
    }

    // Get data 
    $getData = [];


    // Loop data throught the value 
    foreach ($siva as $key => $value) {
        $getBlock = [];

        $howMany = count($value[key($value)]);

        for ($i = 0; $i < $howMany; $i++) {
            $a = [];

            foreach ($value as $k => $v) {
                $a[$k] = isset($value[$k][$i]) ? $value[$k][$i] : '';
            }

            $getBlock[] = $a;
        }
            
        $getData[$key] = $getBlock;
    }



    // Get max record 
    $getMaxRecord = $this->GetMaxRecord($getData);

    // Defining variable 
    $b = [];

    // Defining 
    $c = [];

    // Loop through each data 
    for ($i = 0; $i < $getMaxRecord; $i++) {
      foreach ($getData as $key => $value) {
        if (isset($getData[$key][$i])) {
            $b[$key] = $getData[$key][$i];
            $b[$key]['website'] = $key;


        } else {
            unset($b[$key]);
        }
    }

      $c[] = $b;
    }


$total = count($c);

$singleArray = [];



for($j = 0; $j < $total; $j++) {

    // Loop each 
    foreach($c[$j] as $key => $value) {

        // Get value 
        $singleArray[] = $value;
    }
}




    $productTitle = $siva['www.amazon.ae']['title'] ?? '';

    // Load the configuration file 

    // Get the config keys 
        $this->load->helper('server');


    // Using Memcached 
        $m = new Memcached();

        // Add server 
    $m->addServer(HOST_NAME, MEMCACHED_PORT);


    // Get the product search title 
    $memSearchedKeyword = $m->get('search_key_words');
    $memProductTitles = $m->get('product_title');
    // get all memcached keys 
    $keys = $m->getAllKeys();
    $i = 0;

    if(is_array($memSearchedKeyword)) {

      if(!in_array($search_key, $memSearchedKeyword)) {

        // Push the information 
        array_push($memSearchedKeyword, $search_key);
        array_push($memProductTitles, $productTitle);

        // Get only 
        $val = array_filter($keys, array($this, "getOnlyProductKey"));
        
        // Sort the  array 
        //sort($val);
        $productSearchResult = $c;
        // count the value 
        $i = count($val);

      
      } else {

        // Find the array index of title 
        $i = array_search($search_key, $memSearchedKeyword);

        // if index found 
        if($i !== false ){

          $memProductTitles[$i] = $productTitle;
         // $productSearchResult  = $c;
        }

      }

    } else {

      $memSearchedKeyword = [$search_key];
      $memProductTitles = [$productTitle];

    }

    $m->set('search_key_words', $memSearchedKeyword );
    $m->set('product_title', $memProductTitles);

    // Count the result 
    $countResult = count($singleArray);

    // Coun the already have data 
    $products = $this->getOnlyProductAsArray($keys, $m);

    // coun the product 
    if(is_array($products) && count($products) > 0) {

        // How many proudct 
        $coundOldProudct = count($products);

        // count new product that we have got 
        $countNewProduct = count($singleArray);

        // Loop through 
        $totalCount = $countNewProduct + $countNewProduct;

        // Loop through and add the product 
        for($j = 0; $j < $countResult; $j++) {

            $m->set($coundOldProudct + $j, $singleArray[$j]);
        }

    } else {

        // loop each data 
         for($j = 0; $j< $countResult; $j++) {

            $m->set($j, $singleArray[$j]);
    }

    }

    // Load view with all message   
    
    $message = 
      [
        'status' => 'success', 'message' => 'Product added sucessfull to you database'
      ];

        return true;
    }


    public function getOnlyProductAsArray(array $keys, Memcached $m):array {

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

    public function getOnlyProductKey($var) {
        $reg = '/^[0-9]{1,}$/';

        return preg_match($reg, $var);
    }

    public function Login($username, $password){

        

        // Defining message 
        $message = [];

        // Both index must set 
        if($username === NULL || $password === NULL) {

            return [
                        'username' => 'Username is required.',
                        'password' => 'Password is required'
                    ];      
        }   

        // Check if user is authenicated 
        if($this->username !== $username) {

            return ['username' => 'Please enter valid username.'];
        }

        // Check password  
        if(!password_verify($password, $this->password)) {

            return ['password' => 'Please enter valid password.'];
        }

        // return true 
        return true;

    }

    // Get admin login 
    public function SetAdminSession() {

        // Get the username 
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // is Valid login 
        $isLoginValid = $this->Login($username, $password);

        // Set the data 
        $data = $this->input->post();

        // Data tod return 
        $unSuccessData['data'] = $data;

        // Check the method 
        if($isLoginValid !== true) {

            $unSuccessData['error'] = $isLoginValid;

            $this->session->set_flashdata('errors', $unSuccessData);

            redirect('/login');
        }

        // Regenare session id 
        $userdata['administrator'] = array('username' => $username, 'passowrd' => $password, 'date' => date('Y-m-d H:i:s'));

        
        // Set the session data 
        $this->session->set_userdata($userdata);

        // Redirect to the admin page 
        redirect('/administrator');

    }

    
    public function ErrorOutput(array $message):CI_Output{

        // Change the message variable 
            $message = [
                            'error' => $message
                        ];

            // return message 
            return $this->output->set_output(json_encode($message));
    }
    


    // Adminstrator Login view 
    public function AdminLoginView() {

        if($this->session->has_userdata('administrator') === true) {

            redirect('/administrator');
        }
        

        $this->load->view('login/index');
        
    }

    // Logout administrator 
    public function LogoutAdmin() {

        if($this->session->has_userdata('administrator') === true) {

            // Unset user data session administrator 
            $this->session->unset_userdata('administrator');
            
            redirect('/login');
        }

        redirect('/login');

    }
    
    

}

