
<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/2/2015
 * Time: 7:50 PM
 */
require_once ("models/plant.class.php");
require_once ("models/Location.class.php");
require_once ("models/weather.class.php");
require_once ("models/soil.class.php");
require_once ("classes/SelectMenu.php");

if(!isset($_SESSION['current_user'])){
  include ('index.php');
}else{
  $user = $_SESSION['current_user'];

  if(isset($_SESSION['current_plant']))
    $Plant = $_SESSION['current_plant'];
  else
    $Plant = new Plant();

  if(isset($_SESSION['current_location']))
      $Location = $_SESSION['current_location'];
  else
      $Location = new Location();

  if(isset($_SESSION['current_weather']))
      $Weather = $_SESSION['current_weather'];
  else
      $Weather = new weather();

  if(isset($_SESSION['current_soil']))
      $Soil = $_SESSION['current_soil'];
  else
      $Soil = new soil();
}

$SoilList = $Soil->GetAllSoils() ;

$SoilMenu = new selectMenu;
$SoilMenu->setOptions($SoilList);

Include_once ('include/header.php');
?>
<?php if (isset ($php_errormsg)) { ?>
    <h1> Please correct the following errors: <?php $php_errormsg ?></h1>
<?php  } ?>
<html>
<body>
<form action="SaveFlower.php" method="get">
  <input type="hidden" name="uid" value="<?= $user->getUID() ?>">

  <label>Observer's Name: </label><b><?= $user->getName() ?></b><br><br>
  <label>Plant Name: </label><input type="text" name="PlantName" value="<?= $Plant->getPlantName() ?>"><br>
  <label>Entering Data on Location? (Y/N)</label><input type="text" name="OnSite" value="<?= $Plant->getEnteredOnSite() ?>"><br>
  <label>Observation Date: </label><input type="text" name="ObservationDate" value="<?= $Plant->getPlantDate() ?>"><br>
  <label>Notes: </label><input type="text" name="PlantNotes" value="<?= $Plant->getPlantNote() ?>"><br><br><br>

  <label>Plant Location: </label>
  <input type="hidden" name="LocationID" value="<?= $Plant->getPlantLocation()?>"><br>
  <label>Longitude: </label><input type="text" name="Longitude" value="<?= $Location->getLongitude() ?>"><br>
  <label>Latitude: </label><input type="text" name="Latitude" value="<?= $Location->getLatitude() ?>"><br>
  <label>GPS: </label><input type="text" name="GPS" value="<?= $Location->getGPS() ?>"><br>
  <label>Note: </label><input type="text" name="Note" value="<?= $Location->getLocationNote()?>"><br><br><br>



  <label>Soil Type: </label>
  <input type="hidden" name="SoilID" value=""><br>
  <label>Soil Type: </label><?= $SoilMenu->makeMenu("Select a Soil Type", "SoilType"); ?><br>
  <label>Soil Conditions: </label><input type="text" name="SoilConditions" value="<?= $Plant->getPlantSoil() ?>"><br><br><br>

  <label>Weather Conditions: </label>
  <input type="hidden" name="WeatherID" value="<?= $Plant->getPlantWeather() ?>"><br>
  <label>ObservationTime: </label><input type="text" name="ObservationTime" value="<?= $Weather->getTime() ?>"><br>
  <label>Temperature: </label><input type="text" name="Temperature" value="<?= $Weather->getTemperature() ?>"><br>
  <label>Conditions: </label><input type="text" name="Conditions" value="<?= $Weather->getConditions() ?>"><br><br><br>
  <?php
  $date = new DateTime();
  $CurrentDate = $date->format ("Y-m-d H:i:s");
  $currentConditions = "Cold And Snowing";
  $currentLocation = "Fort Collins, CO";
  ?>
  <label>Current Date and Time: </label><input type="text" name="CurrentTime" value="<?= $CurrentDate ?>" readonly><br>
  <label>Current Weather Conditions: </label><input type="text" name="CurrentConditions" value="<?= $currentConditions ?>" readonly><br>
  <label>Current Location: </label><input type="text" name="CurrentLocation" value="<?= $currentLocation?>" readonly><br><br><br>
  <input type="submit" value="Save"  class='button'>
</form>

</body>
</html>
