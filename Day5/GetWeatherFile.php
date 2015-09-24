<?php


$a = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=denver,co");


$b = json_decode($a, true);

print_r($b);




$c = "David wrote to the file ". date('D, d M Y H:i:s') . "\r\n";

file_put_contents("file.log", $c, FILE_APPEND);

?>