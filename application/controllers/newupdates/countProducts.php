<?php
require ('../../../../vendor/autoload.php');
$searchString = urldecode('apple 7');

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->tribuygo->products;

$collection->createIndex(["title" => "text"]);



//$collection->drop();

//exit();


$page = 1;

// Number of rows 
$numOfRows = $collection->count();



echo $numOfRows;




