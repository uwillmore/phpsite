<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/16/2015
 * Time: 8:11 PM
 */

if(isset($_POST['ReverseThis'])){
    $ReversedString = MyStringReverse ($_POST['ReverseThis']);
    include_once('views/partials/ShowReversedString.php');
}
else {
    include_once('views/partials/ReverseStringForm.php');
}


function MyStringReverse ($str){

    $rtnval = "";
    $helper = str_split($str);

    $count = strlen ($str);

    for ($i = $count - 1; $i >= 0; $i--){
        $rtnval = $rtnval . $helper[$i];
    }

    return ($rtnval);
}
