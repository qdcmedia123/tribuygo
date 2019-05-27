<?php
header('Content-Type: application/json'); 
$m = new Memcached();
$m->addServer('localhost', 11211);
$productTitles = $m->get('product_title');
$searchKeys = $m->get('search_key_words');
$suggesstion = [];
/*
categories: [
        {   //Category fruits
            listLocation: "Apple macbook pro",
            header: "--Apple--"
           
        }, 
        {   //Category vegetables
            listLocation: "Huawei MateBook 13 Laptop",
            header: "--Huawei--"
            
        }
    ],
*/

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



die(json_encode($suggesstion));
}

die(json_encode(['error404' => 'Nothing found in cached.']));