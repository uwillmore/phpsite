<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/16/2015
 * Time: 8:03 PM
 */


if(isset($_GET['ReverseThis'])){
    include_once('views/partials/ShowReversedString.php');
}
else {
    include_once('views/partials/ReverseStringForm.php');
}

$MyString = "WILLMORE";

print "Reversing the string " . $MyString . "<br />";

$ReverseThis = MyStringReverse ($MyString);

print "Reversed string is " . $reversed . "<br />";

function MyStringReverse ($str){

    $rtnval = "";
    $helper = str_split($str);

    $count = strlen ($str);

    for ($i = $count - 1; $i >= 0; $i--){
        $rtnval = $rtnval . $helper[$i];
    }

    return ($rtnval);
}