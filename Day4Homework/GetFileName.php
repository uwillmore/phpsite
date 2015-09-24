<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/17/2015
 * Time: 7:54 PM
 */

$MyPath = $_SERVER["PHP_SELF"];
print ("The current file path is: " . $MyPath . "<br/>");

$SplitPath = explode("/", $MyPath);

$length = count($SplitPath);

$FileName = $SplitPath[$length-1];
print ("The current file name is: " . $FileName . "<br/>");

?>