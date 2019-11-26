<?php

echo curl_get_file_contents('https://www.amazon.ae/s?k=laptops&ref=nb_sb_noss_2');
function curl_get_file_contents($URL)
    {
        $c = curl_init();
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($c, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
        else return FALSE;
    }