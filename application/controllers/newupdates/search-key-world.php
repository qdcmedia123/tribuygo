<?php
header('Content-Type: application/json'); 
$m = new Memcached();
$m->addServer('localhost', 11211);

$productTitles = $m->get('product_title');
$searchKeys = $m->get('search_key_words');

//$m->flush();

//$suggesstion = [];
/*
if(is_array($productTitles) && count($productTitles) === count($searchKeys )) {

	foreach($searchKeys as $key => $value ) {

	$suggesstion[ucfirst (urldecode($value))] = $productTitles[$key];
} 
	die(json_encode($suggesstion));
}
*/

//$m->set(0, ['hello world', 'i will hunt you down', 'something']);

//$m->set(1, ['hello world', 'i will hunt you down', 'something']);


//$keys = $m->getAllKeys();

// Fetch all 
//$getAllValues = $m->fetchAll();

// Get the close 
//$getKeys = $m->get(0);

echo json_encode($searchKeys);
//die(json_encode(['error404' => 'Nothing found in cached.']));






