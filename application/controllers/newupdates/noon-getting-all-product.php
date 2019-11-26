<?php


libxml_use_internal_errors(true);

$url = 'https://www.noon.com/uae-en/search?q=samsung%20galaxy';

@$doc = new DOMDocument();

$content = file_get_contents($url);

$doc->loadHTML($content);


$xpath = new DOMXPath($doc);

foreach($xpath->query('//body//script[@id="__NEXT_DATA__"]') as $queryResult) {
 
	$getString = $queryResult->nodeValue;
	

}

// Get the string and decode 
$dataInArray = json_decode($getString, true);

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


exit();

for($i = 0; $i < $src->length; $i++) {

	//echo "<pre>";
	$no  =  getAbsUrl($src->item($i)->nodeValue, $url);
	//echo "</pre>";

	echo $no.'<br/>';
}




