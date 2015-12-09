<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/29/2015
 * Time: 12:51 PM
 */

// check if a class is defined before including it again.

    require_once('classes/db.interface.php');
    require_once('classes/db.class.php');
    require_once('models/user.class.php');
    require_once('models/plant.class.php');
    require_once('models/soil.class.php');
    require_once('models/weather.class.php');
    require_once('models/Plant_manager.class.php');
    require_once('models/manager.abstract.php');
    require_once('models/user_manager.class.php');

if (!class_exists('Location')) {
    require_once('models/Location.Class.php');
}

if (!isset ($_SESSION)) {
   // print ("Starting Session SaveFLower<br><br>");
    session_start();
}

if (isset ($_SESSION)) {
    if (isset ($_SESSION['current_user'])) {
        $user = $_SESSION['current_user'];
        /* URW DEBUG
              print ("<br> User object set from Session<br>");

              print_r ($user);

              print "Save FLower Session print follows: <br>";
              var_dump($_SESSION);
              print ("<br>AFter session print <br>");
              */
    }
}


// to see what is defined and included use thisL:
// debug_print_backtrace();
$php_errormsg = null;

$Plant = new Plant();
$Soil = new soil();
$Location = new Location();
$Weather = new weather();

if (isset ($_GET['uid'])) {
    $Plant->setPlantUser($_GET ['uid']);
}
else {
    $php_errormsg = "Missing UserID. ";
}
if (isset ($_GET['PlantName'])) {
    $Plant->setPlantName($_GET ['PlantName']);
}
else {
    $php_errormsg = $php_errormsg . "Missing Plant Name.<br> ";
}
if (isset ($_GET['OnSite'])) {
    $Plant->setPlantEnteredOnSite( $_GET ['OnSite']);
}
else {
    $php_errormsg = $php_errormsg . "Missing On Site.<br> ";
}

if (isset ($_GET['PlantNotes'])) {
    $Plant->setPlantNote($_GET ['PlantNotes']);
}

$LocationCount = 0;
if (isset ($_GET['Longitude'])) {
    $LocationCount++;
    $Location->setLongitude($_GET ['Longitude']);
}

if (isset ($_GET['Latitude'])) {
    $LocationCount++;
    $Location->setLatitude($_GET ['Latitude']);
}

if (isset ($_GET['GPS'])) {
    $LocationCount++;
    $Location->setGPS ($_GET ['GPS']);
}


$locationError = false;

if (! $Location->getGPS() && (!$Location->getLatitude()) && !$Location->getLongitude()) {
    $LocationError = true;
}

if (isset ($_GET['Note'])) {
    $LocationCount++;
    $Location->setLocationNote($_GET ['Note']);
    $LocationError = false;
}

if ($LocationError){
    $php_errormsg = $php_errormsg . "Please enter either a note describing the location, GPS Coordinates or Langitude and Latitude.<br>";
}

if (isset ($_GET ['SoilType'])){
    $Soil->setSoilType( $_GET ['SoilType']);
    $Plant->setPlantSoilType($_GET['SoilType']);
}
else {
    $php_errormsg =  $php_errormsg . "Please select a Soil Type.<br>";
}

if (isset ($_GET ['SoilConditions'])){
    $Plant->setPlantSoil($_GET ['SoilConditions']);
}

$weatherCount = 0;
if (isset ($_GET ['ObservationTime'])){

    $Weather->setTime($_GET['ObservationTime']);
    $weatherCount++;
}
if (isset ($_GET ['ObservationDate'])){

    $Weather->setObservationDate($_GET['ObservationDate']);
    $weatherCount++;
}
if (isset ($_GET ['Temperature'])){
    $Weather->setTemperature( $_GET ['Temperature']);
    $weatherCount++;
}

if (isset ($_GET ['Conditions'])){
    $Weather->setConditions( $_GET ['Conditions']);
    $weatherCount++;
}

if (!isset ($user)) {
    print ("<br>Resetting user object");
    $userID = $Plant->getPlantUser();
    $UserManager = new UserManager();
    $user = $UserManager->getUserByID($userID);
}
$_SESSION['current_plant'] = $Plant;
$_SESSION['current_location']= $Location;
$_SESSION['current_soil'] = $Soil;
$_SESSION['current_weather'] = $Weather;
$_SESSION['current_user'] = $user;

/* URW DEBUG
print " screen data was: <br>";

print ("<BR><BR><BR>Soil<BR><BR>");
var_dump ($Soil, null);

print ("<BR><BR><BR>Plant<br><br>");
var_dump ($Plant, null);

print ("<BR><BR><BR>Weather<br><br>");
var_dump($Weather, null);

print ("<BR><BR><BR>Location<br><br>");
var_dump($Location, null);

print ("<BR><BR><BR>php_errormsg is: <br>");
print ("<br><br>" . $php_errormsg . "<br>");
*/
// IF no error was found, save the data
if (!(isset($php_errormsg))) {
    if ($weatherCount > 0) {
        $WeatherID = $Weather->SaveWeatherData();
        $Plant->setPlantWeather($WeatherID);
    }
    else
        $Plant->setPlantWeather(null);

    if ($LocationCount > 0) {
         $LocationID = $Location->SaveLocation();
         $Plant->setPlantLocation($LocationID);
    }
    else
        $Plant->setPlantLocation(null);

    $PlantManager = new PlantManager();
    $PlantID = $PlantManager->savePlant($Plant);
}

// use REQUEST_URI or PHP_SELF TO GET The path AND filename of the current file.
// truncate file name, append new file, pre-pend http_post to get the path to the new file.

//$temp = 'Location: ' . $_SERVER['HTTP_HOST'] . '/site/phpsite/MyclassProject/views/flower_add.php';

//print "<br><br> " .$temp . "<br><br>";

//header('Location: ' . $_SERVER['HTTP_HOST'] . '/site/phpsite/MyclassProject/views/flower_add.php');
//exit;
include_once ("views/flower_add.php");

?>