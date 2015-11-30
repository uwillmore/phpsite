<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/29/2015
 * Time: 12:51 PM
 */

require_once('classes/db.interface.php');
require_once('classes/db.class.php');
require_once('models/Plant.php');
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
    $php_errormsg = $php_errormsg . "Missing Plant Name. ";
}
if (isset ($_GET['OnSite'])) {
    $Plant->setEnteredOnSite( $_GET ['OnSite"']);
}
else {
    $php_errormsg = $php_errormsg . "Missing On Site. ";
}
if (isset ($_GET['ObservationDate'])) {
    $Plant->setPlantDate($_GET ['ObservationDate']);
}
else {
    $php_errormsg = $php_errormsg . "Missing Observation Date. ";
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

if (isset ($_GET['Note'])) {
    $Location->setLocationNote($_GET ['Note']);
}

$locationError = false;

if (! isset ($GPS)) {
   if (!isset($Latitude) && !isset($Longitude))
     $LocationError = true;
}

if ($LocationError){
    $php_errormsg = $php_errormsg . "Please enter either GPS Coordinates or Langitude and Latitude.";
}

if (isset ($_GET ['SoilID'])){
    $Plant->setPlantSoil($_GET ['SoilID']);
}

if (isset ($_GET ['SoilType'])){
    $Soil->setSoilType( $_GET ['SoilType']);
}

if (isset ($_GET ['SoilConditions'])){
    $Soil->setSoilCondition($_GET ['SoilConditions']);
}

if (isset ($_GET ['WeatherID'])){
    $Plant->setPlantWeather($_GET ['WeatherID']);
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

// IF no error was found, save the data
if (!(isset($php_errormsg))){
    $Weather->SaveWeatherData($Weather);
    $Location->SaveLocation($Location);
    $Soil->GetSoil($Plant->getPlantSoil());
    $PlantManager = new PlantManager();
    $PlantManager->savePlant($Plant);
}

include ("views/flower_add.php");

?>