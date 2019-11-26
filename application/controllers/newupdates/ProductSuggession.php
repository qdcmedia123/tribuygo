<?php
header('Content-Type: application/json'); 
$m = new Memcached();
$m->addServer('localhost', 11211);
$productTitles = $m->get('product_title');
$searchKeys = $m->get('search_key_words');
$suggesstion = [];
if(is_array($productTitles) && count($productTitles) === count($searchKeys )) {

	foreach($searchKeys as $key => $value ) {

	$suggesstion[ucfirst (urldecode($value))] = $productTitles[$key];
} 
	die(json_encode($suggesstion));
}

die(json_encode(['error404' => 'Nothing found in cached.']));




