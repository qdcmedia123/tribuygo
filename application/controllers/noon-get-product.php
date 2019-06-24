<?php


libxml_use_internal_errors(true);

$search = urlencode('omega 3');

//exit();

$url = "https://www.noon.com/uae-en/search?q=$search";

@$doc = new DOMDocument();

$content = file_get_contents($url);

$doc->loadHTML($content);

//echo htmlspecialchars($content);



$xpath = new DOMXPath($doc);

//$this->xpath('//span[@class="cke_button_icon"]/img');

//sleep(1);
//$src = $xpath->query(''); # "/images/image.jpg"
// //script[contains(text(),"sources:")]
//$src = $xpath->query('script[@id=__NEXT_DATA__)]');
//$src = $xpath->evaluate("string(//img/@src)"); # "/images/image.jpg"
//$src = $xpath->query ('//script[contains(text(),"hits:")]')->item(0)->nodeValue;
foreach($xpath->query('//body//script[@id="__NEXT_DATA__"]') as $queryResult) {
    // access the element here. Documentation:
    // http://www.php.net/manual/de/class.domelement.php

	$getString = $queryResult->nodeValue;
	

}

// Get the string and decode 
$dataInArray = json_decode($getString, true);


//echo json_encode($dataInArray['props']['pageProps']['catalog']['hits']);
//echo "<pre>";
//print_R($dataInArray['props']['initialI18nStore']['uae-en']['common']['search']);
//echo "</pre>";
//echo $getString;
//echo $content;
//props.pageProps.catalog.hits
$hits = $dataInArray['props']['pageProps']['catalog']['hits'];



$newArray = [];

foreach($hits as $item) {

	$item['image_key'] = "https://k.nooncdn.com/t_desktop-thumbnail-v2/".$item['image_key'].'.jpg';
	$item['url'] = "https://www.noon.com/uae-en/".$item['url'].'/'.$item['sku'].'/p?o='.$item['offer_code'];

	// Some index that we have in another website 
	// We are trying to add those indexs are 
	// discription, discount_price = sales_price,
	// original_price, price is already there 
	$item['discount_price'] = $item['sale_price'];
	$item['original_price'] = $item['price'];

	// Get new array 
	$newArray[] = $item;
}


echo json_encode($newArray);

//echo "<pre>";
//print_R($assoc_arr);

//echo "</pre>";

exit();

for($i = 0; $i < $src->length; $i++) {

	//echo "<pre>";
	$no  =  getAbsUrl($src->item($i)->nodeValue, $url);
	//echo "</pre>";

	echo $no.'<br/>';
}




