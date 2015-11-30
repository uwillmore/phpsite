<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/17/2015
 * Time: 8:01 PM
 */
include_once ('menu.php');
$TitleArray = ['Mr.', 'Mrs.', 'Ms.'];
$BeatleArray = ['Ringo', 'John', 'Paul', 'George'];
if(isset($_POST['FirstName'])){
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Title = $_POST['Title'];
    $Beatle = $_POST['Beatle'];
    $Index = array_search( $Beatle, $BeatleArray);
    $UserName = substr($FirstName, 0, 2) . substr ($LastName, -2);
    $UserName = $UserName . $Index;
    $UserName = $UserName . substr ($Beatle, 0, 2) .substr ($Beatle, -1);
    include_once('ShowUserInfo.php');
}
else {
    include_once('GetUserInfo.php');
}

function GetEmailName ($email){
    $FindThis = '@';

    $Pos = strpos ($email, $FindThis);
    if ($Pos === false){
        $rtnVal = "";
    } else {
        $rtnVal = substr ($email, 0, $Pos);
    }

    return ($rtnVal);
}