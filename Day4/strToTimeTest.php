<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/18/2015
 * Time: 12:55 PM
 */

$today = date("y.m.d");
print ("Today formatted y.n.d is: " . $today . "<br/>");
$today = date("y.m.d G:i:s T");
print ("Today with time formatted is: " . $today . "<br/>");

$date = date_create();
echo "Today's date and time is " . date_format($date, 'U = Y-m-d H:i:s') . "<br/>";

date_timestamp_set($date, 1171502725);
echo date_format($date, 'U = Y-m-d H:i:s') . "<br/>";

?>