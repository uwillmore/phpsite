<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 10/19/2015
 * Time: 4:52 PM
 */

echo "Twinkle, Twinkle little Star. <br>";

$firstWord = "Twinkle";
$lastWord = "Star";

echo "$firstWord, $firstWord little $lastWord. <br/>";

$firstWord = "die";
$lastWord = "darling";

$little = "little";
$str = str_replace("little", "my", $little);

echo "$firstWord, $firstWord, $firstWord $str $lastWord. <br/>";
    ?>