<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/28/2015
 * Time: 8:37 PM
 */
$PlantManager = new PlantManager();
$Plants = $PlantManager->getAllPLants();
?>
<h1> All Plants</h1>

<?php

var_dump ($Plants);

?>


