<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/28/2015
 * Time: 8:37 PM
 */

require_once("models/plant.class.php");
require_once("models/plant_manager.class.php");
require_once("classes/db.interface.php");
require_once("classes/db.class.php");
require_once("models/exportResultsToCSV.php");

if (isset($_GET ['Export'])) {

    $PlantManager = new PlantManager();
    $plants = $PlantManager->getAllPlantsAsMSQLiObjects();
    $exporter = new DataExport();
    $exporter->toCSV ($plants);

}
else if (isset($_GET ['Exit'])) {
    session_destroy();
    print "<script type='text/javascript'>window.close();</script>";


}

?>