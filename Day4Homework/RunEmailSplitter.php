<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/17/2015
 * Time: 8:01 PM
 */

if(isset($_POST['email'])){
    $EmailPart = GetEmailName ($_POST['email']);
    include_once('views/partials/ShowEmailPart.php');
}
else {
    include_once('views/partials/GetEmail.php');
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