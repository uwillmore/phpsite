<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/17/2015
 * Time: 4:50 PM
 */
$theString = "dwrth  n";

$AllLower = isAllLower($theString);

if ($AllLower){
    print ("String '" .$theString . "' contains only lower case letters. <br/>");
} else {
    print ("String '" .$theString . "' contains characters that are not lower case letters. <br/>");
}

function isAllLower ($Helper)
{
    $rtnVal = true;
    for ($i = 0; $i < strlen($Helper); $i++) {
//        print ("Converting " . $Helper[$i] . "To ASCII. <br />");
        $OrdVal = ord($Helper[$i]);
        //       print ("Ordval is " . $OrdVal . "<br/>");
        if (!($OrdVal >= 97 && $OrdVal <= 122)) {
            //           print ("Found non alpha character at position " . $i . "<br/>");
            $rtnVal = false;
            //           print ("Found non char letter. <br/>");
            continue;
        }
    }
    return ($rtnVal);
}
