
<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/2/2015
 * Time: 7:50 PM
 */



/*require_once("models/plant.class.php");*/
/*if (!class_exists('Location')) {
  require_once("models/Location.class.php");
}*/
  /*require_once("models/weather.class.php");*/
  require_once("models/soil.class.php");
  require_once("models/user.class.php");
  require_once("classes/SelectMenu.php");

if (!isset ($_SESSION)) {
print ("REsetting session im flower_add");
  session_start();
}
$temp = 'Location: ' . $_SERVER['HTTP_HOST'] . '/site/phpsite/MyclassProject/index.php';

//print "<br><br> " .$temp . "<br><br>";


if(!isset($_SESSION['current_user'])){
 print "<p> <h1>session not set </h1> </p><br><br>";
// header('Location: ' . $_SERVER['HTTP_HOST'] . '/site/phpsite/MyclassProject/index.php');
 // exit;
}else{
  $user = $_SESSION['current_user'];
/* URW DEBUG
  print "Add FLower: Session print follows: <br>";
var_dump ($_SESSION);
print ("<br>AFter session print <br>");
*/
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
}

$Soil = new soil();
$SoilList = $Soil->GetAllSoils() ;

$SoilMenu = new selectMenu;
$SoilMenu->setOptions($SoilList);

Include_once ('include/header.php');
?>
<?php if (isset ($php_errormsg)) { ?>
    <h1> Please correct the following errors: <?php $php_errormsg ?></h1>
<?php  } ?>

<div class="row">
  <div class="col-sm-4 col-sm-offset-4">
    <form action="SaveFlower.php" method="get">
      <input type="hidden" name="uid" value="<?= $user->getUID() ?>">
      <input type="hidden" name="LocationID" value="<?= $Plant->getPlantLocation()?>">
      <input type="hidden" name="SoilID" value="">
      <input type="hidden" name="WeatherID" value="<?= $Plant->getPlantWeather() ?>">

      <h3 class="text-center">Observer's Name: <?= $user->getName() ?></h3>

      <div class="form-group">
        <label for="plant-name">Plant Name: </label>
        <input class="form-control" id="plant-name" type="text" name="PlantName" value="<?= $Plant->getPlantName() ?>">
      </div>

      <div class="form-group">
        <label for="onsite">Entering Data on Location? (Y/N)</label>
        <input id="onsite" class="form-control" type="text" name="OnSite" value="<?= $Plant->getPlantEnteredOnSite() == 0 ? 'No' : 'Yes' ?>">
      </div>

      <div class="form-group">
        <label for="plant-notes">Plant Notes:</label>
        <input class="form-control" id="plant-notes" type="text" name="PlantNotes" value="<?= $Plant->getPlantNote() ?>">
      </div>

      <h3 class="text-center">Plant Location:</h3>

      <div class="form-group">
        <label for="longitude">Longitude:</label>
        <input class="form-control" id="longitude" type="text" name="Longitude" value="<?= $Location->getLongitude() ?>">
      </div>

      <div class="form-group">
        <label for="latitude">Latitude:</label>
        <input class="form-control" id="latitude" type="text" name="Latitude" value="<?= $Location->getLatitude() ?>">
      </div>

      <div class="form-group">
        <label for="gps">GPS:</label>
        <input class="form-control" id="gps" type="text" name="GPS" value="<?= $Location->getGPS() ?>">
      </div>

      <div class="form-group">
        <label for="note">Note:</label>
        <input id="note" class="form-control" type="text" name="Note" value="<?= $Location->getLocationNote()?>">
      </div>

      <h3 class="text-center">Soil Type:</h3>

      <div class="form-group">
        <label for="soildropdown">Soil Type: </label>
        <?= $SoilMenu->makeMenu("Select a Soil Type", "SoilType", $SoilList); ?>
      </div>

      <div class="form-group">
        <label for="soilconditions">Soil Conditions:</label>
        <input id="soilconditions" class="form-control" type="text" name="SoilConditions" value="<?= $Plant->getPlantSoil() ?>">
      </div>

      <h3 class="text-center">Weather Conditions:</h3>

      <div class="form-group">
        <label for="observationdate">Observation Date:</label>
        <input class="form-control" id="observationdate" type="date" name="ObservationDate" value="<?= $Weather->getObservationDate() ?>">
      </div>

      <div class="form-group">
        <label for="observationtime">Observation Time:</label>
        <input id="observationtime" class="form-control" type="text" name="ObservationTime" value="<?= $Weather->getTime() ?>">
      </div>

      <div class="form-group">
        <label for="temp">Temperature:</label>
        <input class="form-control" id="temp" type="text" name="Temperature" value="<?= $Weather->getTemperature() ?>">
      </div>

      <div class="form-group">
        <label for="conditions">Conditions:</label>
        <input id="conditions" class="form-control" type="text" name="Conditions" value="<?= $Weather->getConditions() ?>">
      </div>

      <?php
      $date = new DateTime('America/Denver');
      $CurrentDate = $date->format ("Y-m-d H:i:s");
      $currentConditions = "Cold And Snowing";
      $currentLocation = "Fort Collins, CO";
      ?>

      <div class="form-group">
        <label for="currenttime">Current Date and Time:</label>
        <input id="currenttime" class="form-control" type="text" name="CurrentTime" value="<?= $CurrentDate ?>" readonly>
      </div>

      <div class="form-group">
        <label for="currentconditinos">Current Weather Conditions:</label>
        <input id="currentconditinos" class="form-control" type="text" name="CurrentConditions" value="<?= $currentConditions ?>" readonly>
      </div>

      <div class="form-group">
        <label for="currentlocation">Current Location:</label>
        <input id="currentlocation" class="form-control" type="text" name="CurrentLocation" value="<?= $currentLocation?>" readonly>
      </div>
      <div class="text-center">
        <button type="submit" class='btn btn-default btn-block'>Save</button>
      </div>
    </form>
  </div>
</div>

</div>
</body>
</html>
