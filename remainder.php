<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/18/2015
 * Time: 4:32 PM
 */

$UNIXDate = 1217888348;

$DaysPerYear = 60 * 60 * 24;

print (" B4 Remainder DaysPerYear is " . $DaysPerYear . "<br/>");
print (" B$ Remainder UNIXDate is " . $UNIXDate . "<br/>");
$rtnVal = remainder ($UNIXDate, $DaysPerYear);

print ("Remainder returned " . $rtnVal . "<br/>");

print ("After Remainder DaysPerYear is " . $DaysPerYear . "<br/>");
print ("After Remainder UNIXDate is " . $UNIXDate . "<br/>");

function remainder($dividend, $divisor) {

    print ("Arguments received: dividend = " . $dividend . " and divisor = " . $divisor . "<br/");
    if ($dividend == 0 || $divisor == 0) return 0;

    print ("Arguments were not 0. <br/>");
    $dividend .= '';
    $remainder = 0;
    $division = '';

    // negative case
    while ($dividend < 0) {
        $dividend += $divisor;
        print ("Dividend incremented by divisor. Dividend = " .$dividend . "<br/>");
        if ($dividend >= 0) return $dividend;
        print ("divident is still negative. <br/>");
    }
print ("Found positive dividend <br/>");
    // positive case
    print ("Remainder.dividend * 1 = " . ($remainder.$dividend)*1 . "<br/>");
    print ("divisor is " . $divisor . "<br/>");
    while (($remainder.$dividend)*1 > $divisor) {
        // get remainder big enough to divide
        print ("remainder not big enough to divide. <br/>");
        while ($remainder*1 < $divisor) {
            $remainder .= $dividend[0];
            $remainder *= 1;
            print ("remainder is now " . $remainder . "<br/");
            $dividend = substr($dividend, 1);
            print ("dividend is now " . $dividend . "<br/");
        }
        // get highest multiplicator for remainder
        $mult = floor($remainder / $divisor);

        print ("Multiplicator set to " . $mult . "<br />");
        // add multiplicator to division
        $division .= $mult.'';

        print ("division set to " . $division . "<br />");
        // subtract from remainder
        $remainder -= $mult*$divisor;
        print ("remainder set to " . $remainder . "<br />");
    }

    // add remaining zeros if any, to division
    if (strlen($dividend) > 0 && $dividend*1 == 0) {

        print ("Adding 0s tp divident <br/>");
        $division .= $dividend;
    }
print ("Returning remainder " . $remainder . "<br/>");
    return $remainder;
}