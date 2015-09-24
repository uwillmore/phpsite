<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/18/2015
 * Time: 5:23 PM
 */

$UTS = 1217888348; // Seconds since 01.01.1970
$SecondsPerYear = 86400; // 60* 60 * 24
$DaysPerYear = 365;

$YearByMonth [] = array (
    "Abbr"          => "Jan",
    "Ord"           => "01",
    "DaysInMonth"   => 31,
    "TotalInYear"   => 31
);

$YearByMonth [] = array (
    "Abbr"          => "Feb",
    "Ord"           =>  "02",
    "DaysInMonth"   => 28,
    "TotalInYear"   => 59
);

$YearByMonth [] = array (
    "Abbr"          => "Mar",
    "Ord"           => "03",
    "DaysInMonth"   => 30,
    "TotalInYear"   => 90
);

$YearByMonth [] = array (
    "Abbr"          => "Apr",
    "Ord"           =>  "04",
    "DaysInMonth"   =>    31,
    "TotalInYear"   =>  120
);

$YearByMonth [] = array (
    "Abbr"          => "May",
    "Ord"           =>  "05",
    "DaysInMonth"   =>    31,
    "TotalInYear"   =>  151
);

$YearByMonth [] = array (
    "Abbr"          => "Jun",
    "Ord"           =>  "06",
    "DaysInMonth"   =>    30,
    "TotalInYear"   =>  181
);

$YearByMonth [] = array (
    "Abbr"          => "Jul",
    "Ord"           =>  "07",
    "DaysInMonth"   =>    31,
    "TotalInYear"   =>  212
);

$YearByMonth [] = array (
    "Abbr"          => "Aug",
    "Ord"           =>  "08",
    "DaysInMonth"   =>    31,
    "TotalInYear"   =>  243
);

$YearByMonth [] = array (
    "Abbr"          => "Sep",
    "Ord"           =>  "09", 30,
    "TotalInYear"   =>  273
);

$YearByMonth [] = array (
    "Abbr"          => "Oct",
    "Ord"           =>  "10",
    "DaysInMonth"   =>    31,
    "TotalInYear"   =>  304
);

$YearByMonth [] = array (
    "Abbr"          => "Nov",
    "Ord"           =>  "11",
    "DaysInMonth"   =>    30,
    "TotalInYear"   =>  334
);

$YearByMonth [] = array (
    "Abbr"          => "Dec",
    "Ord"           =>  "12",
    "DaysInMonth"   =>    31,
    "TotalInYear"   =>  365
);

print "<pre>". print_r ($YearByMonth, true) . "</pre>";
print ("<br/>");
$PartYear = $UTS % $SecondsPerYear;
print ("PartYear = " . $PartYear . " seconds.<br/>");

$WholeDays = ($UTS/$SecondsPerYear) - ($PartYear/$SecondsPerYear) ;  //
print ("Whole days = " . $WholeDays . "<br/>");

$PartYear = $WholeDays % $DaysPerYear;
print ("PartYear = " . $PartYear . " days.<br/>");

$WholeYears = ($WholeDays - $PartYear)/$DaysPerYear;
print ("WholeYears = " . $WholeYears . " <br/>");

$PartLeapYears = $WholeYears % 4;
print ("PartLeapYears = " . $PartLeapYears . " <br/>");

$LeapDays = ($WholeYears - $PartLeapYears)/4;
print ("LeapDays = " . $LeapDays . " <br/>");

$PartYear -= $LeapDays;
print ("PartYear = Days Left to add to Date = " . $PartYear . "<br/>");

$FullDays = 0;
$MonthOrd = "";
$MonthDays = 0;
$MonthName = "";
$idx = 0;
foreach ($YearByMonth as $ThisMonth){
   if ($ThisMonth["TotalInYear"] <= $PartYear) {
       $idx++;
   }
}

print ("Correct Month is at index " . $idx . "<br/>");
print ("Abbr is '" . $YearByMonth[$idx -1]["Abbr"] . "'<br/>");
print ("Ord is '" . $YearByMonth[$idx -1]["Ord"] . "'<br/>");
print ("DaysInMonth is " . $YearByMonth[$idx -1]["DaysInMonth"] . "<br/>");
print ("TotalInYear is " . $YearByMonth[$idx -1]["TotalInYear"] . "<br/>");

/*
$FullDays = $thisMonth["TotalInYear"];
$MonthOrd = $thisMonth["Ord"];
$MonthDays = $thisMonth["DaysInMonth"];
$MonthName = $thisMonth["Abbr"];
*/
