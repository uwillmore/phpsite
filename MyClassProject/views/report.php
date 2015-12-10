<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/28/2015
 * Time: 8:37 PM
 */

require_once("models/plant.class.php");
require_once("models/plant_manager.class.php");

$PlantManager = new PlantManager();
$Plants = $PlantManager->getAllPLants();
?>
<h1> All Plants</h1>
<form name="Report" action="ExportData.php" method="get">
    <input type="submit" name="Export" value="Export">
    <input type="submit" name="Exit" value="Exit">
</form>
<?php

print_r ($Plants);

?>