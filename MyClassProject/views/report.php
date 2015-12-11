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

include_once 'include/Header.php';
?>
<h1> All Plants</h1>
<form name="Report" action="ExportData.php" method="get">
    <button type="submit" name="Export" class="btn btn-default">Export</button>
    <button type="submit" name="Exit" class="btn btn-default">Exit</button>
</form>

<div id="table"></div>
<?php

echo '<script type="text/javascript"> var plants = ' . $Plants . '; </script>';

$scripts = ['jquery.jsontotable.min.js', 'reportTable.js'];
include_once 'views/footer.php';
?>