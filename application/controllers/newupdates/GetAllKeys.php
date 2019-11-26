<?php
header('Content-Type: application/json'); 
$m = new Memcached();
$m->addServer('localhost', 11211);
$productTitles = $m->get('product_title');
$getAllProduct = $m->get('product_search_result');
// get all memcached keys 
$keys = $m->getAllKeys();



$val = array_filter($keys,"getOnlyProductKey");

//sort($val);

$len = count($val);

//echo $len;
// get all product 
$getallProdcut = [];

for($i = 0; $i <= $len; $i++) {

	
	$getallProdcut[] = $m->get($i);
}



function getOnlyProductKey($var)
{
	$reg = '/^[0-9]{1,}$/';

	return preg_match($reg, $var);
}



echo json_encode($keys);




