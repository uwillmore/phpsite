<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/29/2015
 * Time: 12:51 PM
 */

require_once('classes/db.interface.php');
require_once('classes/db.class.php');
require_once('models/plant.class.php');
require_once('models/soil.class.php');
require_once('models/weather.class.php');
require_once('models/Location.Class.php');
require_once('models/Plant_manager.class.php');

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
if (isset ($_GET['ObservationDate'])) {
    $Plant->setPlantDate($_GET ['ObservationDate']);
}
else {
    $php_errormsg = $php_errormsg . "Missing Observation Date. <br>";
}
if (isset ($_GET['PlantNotes'])) {
    $Plant->setPlantNote($_GET ['PlantNotes']);
}

if (isset ($_GET['Longitude'])) {
    $Location->setLongitude($_GET ['Longitude']);
}

if (isset ($_GET['Latitude'])) {
    $Location->setLatitude($_GET ['Latitude']);
}

if (isset ($_GET['GPS'])) {
    $Location->setGPS ($_GET ['GPS']);
}


$locationError = false;

if (! $Location->getGPS() && (!$Location->getLatitude()) && !$Location->getLongitude()) {
    $LocationError = true;
}

if (isset ($_GET['Note'])) {
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

if (isset ($_GET ['ObservationTime'])){
    $Weather->setTimer(['ObservationTime']);
}

if (isset ($_GET ['Temperature'])){
    $Weather->setTemperature( $_GET ['Temperature']);
}

if (isset ($_GET ['Conditions'])){
    $Weather->setConditions( $_GET ['Conditions']);
}

$_SESSION['current_plant'] = $Plant;
$_SESSION['current_location']= $Location;
$_SESSION['current_soil'] = $Soil;
$_SESSION['current_weather'] = $Weather;

print " screen data was: <br>";

print ("<BR><BR><BR>Soil<BR><BR>");
print_r ($Soil, null);

print ("<BR><BR><BR>Plant<br><br>");
print_r ($Plant, null);

print ("<BR><BR><BR>Weather<br><br>");
print_r($Weather, null);

print ("<BR><BR><BR>Location<br><br>");
print_r($Location, null);

print ("<BR><BR><BR>php_errormsg is: <br>");
print ("<br><br>" . $php_errormsg . "<br>");

exit;
// IF no error was found, save the data
if (!(isset($php_errormsg))){
    $WeatherID = $Weather->SaveWeatherData($Weather);
    $LocationID = $Location->SaveLocation($Location);

    $Plant->setPlantWeather($WeatherID);
    $Plant->setPlantLocation($LocationID);

    $PlantManager = new PlantManager();
    $PlantID = $PlantManager->savePlant($Plant);
}

include ("views/flower_add.php");

?>