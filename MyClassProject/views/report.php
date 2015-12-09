<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/28/2015
 * Time: 8:37 PM
 */


if (!class_exists('Location')) {
    require_once("models/Location.class.php");
}
require_once("models/weather.class.php");

require_once("models/plant.class.php");
require_once("models/plant_manager.class.php");
require_once('classes/db.interface.php');
require_once('classes/db.class.php');
require_once('models/user.class.php');
require_once('models/manager.abstract.php');
require_once('models/user_manager.class.php');

$PlantManager = new PlantManager();
$Plants = $PlantManager->getAllPLants();
?>
<h1> All Plants</h1>

<?php

print_r ($Plants);

?>


