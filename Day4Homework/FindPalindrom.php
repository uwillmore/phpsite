<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/17/2015
 * Time: 3:04 PM
 */

$Original = "otto";
$PalindromFound = true;
$Reason ="";

if ($Original == "") {
    $PalindromFound = false;
    $Reason = "String is Empty";
 //   print ($Reason . "<br/>");
}
else {
    $Helper = substr ($Original, 0);
    $Helper = strtolower($Helper);
//print ("Helper after to lower is " . $Helper . "<br/>");

    for ($i = 0; $i < strlen($Helper); $i++){
//        print ("Converting " . $Helper[$i] . "To ASCII. <br />");
        $OrdVal = ord($Helper[$i]);
 //       print ("Ordval is " . $OrdVal . "<br/>");
        if (!($OrdVal >= 97 && $OrdVal <= 122 )) {
 //           print ("Found non alpha character at position " . $i . "<br/>");
            $PalindromFound = false;
 //           print ("Found non char letter. <br/>");
            $Reason = "String contains invalid characters. Use only letters.";
            continue;
       }
    }
//    print ("Still going after for loop<br/>");
    if ($PalindromFound){
        $Helper =strrev(strtolower ($Original));
//        print ("Reversed all lower case string is '" . $Helper . "<br/>");
 //       print (" All lower case Original is '" . $Original . "<br/>");
        if ($Helper == strtolower ($Original)){
            $PalindromFound = true;
        }
        else {
            $PalindromFound = false;
            $Reason = $Original ." is not a Palindrom. The word is different when reversed.";
        }
    }
}

if ($PalindromFound) {
    print ("The String " . $Original . " is a Palindrom". "<br/>");
} else {
    print ("The String " . $Original . " is NOT a Palindrom". "<br/>");
    print ($Reason . "<br/>");
}

