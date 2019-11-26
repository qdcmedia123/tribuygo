<?php
 $keyword = urlencode('dell xps 15');

$url =  'https://www.jumbo.ae/home/search?q='. $keyword;

echo file_get_contents($url);