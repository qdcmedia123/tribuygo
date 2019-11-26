<?php

function KeepAllKeyWordsAsBackUp(Memcached $m) {


	// Add server 
	


	// Before running the script remember you need to provide the permission 

	// When the loop is finished then it should create backup as well 

	// Read the keyworlds which is added 
	$searchKeys = $m->get('search_key_words');

	// Decode all keywords is array 
	$words = array_map('urldecode', $searchKeys);

	// Get string to lower 
	$words = array_map('strtolower', $words);

	// Set that to the array 
	$data = json_encode($words);

	// Open the file and wrire 
	$fopen = fopen('backup/search_key_words.json' , 'w+');

	// Write the files 
	fwrite($fopen, $data);

	// close 
	fclose($fopen);

}

