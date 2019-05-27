<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FetchProductDetails extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */
  public function index()
  {   
    $doc = new DOMDocument();

    // Restore error level
    //libxml_use_internal_errors(false);

    $internalErrors = libxml_use_internal_errors(true);

    $search_key = urlencode('Apple iPhone 6');


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
                'price' => "//span[@class='s-item__price']",
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
                'title' => "//div[@style ='overflow:hidden']/span",
                'image' => '//div[@class="jsx-2714670158 mediaContainer"]/img/@src',
                'price' => "//span[@class='jsx-3248044173 sellingPrice']",
                                'description'=> "//a[@class='jsx-3796044909 product gridView']/@href",
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
                'image' => '//div[@class="product-image-wrap"]//img/@src',
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
                   
                    // if($j === 15) { break; }
                    $Inner[] = preg_replace('/\s\s+/', ' ', trim($xpath->query($value)->item($j)->nodeValue, "\t\n\r\0\x0B"));
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
        } else {
            unset($b[$key]);
        }
    }

      $c[] = $b;
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
    // Product Search Result 
    $productSearchResult = $m->get('product_search_result');



    if(is_array($memSearchedKeyword)) {

      if(!in_array($search_key, $memSearchedKeyword)) {

        array_push($memSearchedKeyword, $search_key);
        array_push($memProductTitles, $productTitle);
        array_push($productSearchResult, $c);

      
      } else {

        // Find the array index of title 
        $keyIndex = array_search($search_key, $memSearchedKeyword);

        // if index found 
        if($keyIndex !== false ){

         
          $memProductTitles[$keyIndex] = $productTitle;
          $productSearchResult[$keyIndex] = $c;
        }

      }

    } else {

      // Initialize the array 
      $memSearchedKeyword = [$search_key];
      $memProductTitles = [$productTitle];
      $productSearchResult = [$c];


    }



    // Check the product title 
    $m->set('search_key_words', $memSearchedKeyword );
    $m->set('product_title', $memProductTitles);
    $m->set('product_search_result', $productSearchResult);

    // Load view with all message 
  
    
    
    $message = 
      [
        'status' => 'success', 'message' => 'Product added sucessfull to you database'
      ];




    $this->load->view('can-be-less-price/templates/header.php');
    $this->load->view('administrator/content/index', $message);
    $this->load->view('can-be-less-price/templates/footer');
  }

  public function GetMaxRecord($records)  {
      return max(array_map(function ($items) {
          return count($items) ;
      }, $records));
  }

  

  
}
