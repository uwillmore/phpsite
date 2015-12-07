
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/28/2015
 * Time: 9:22 PM
 */
<?php
class PlantManager
{

    public function getPlantByID($arg)
    {

        if (!is_numeric($arg)) return FALSE;

        $db = new Db();

        $uid = $db->quote($arg);
        $results = $db->select("SELECT * from Plants where PlantID = $uid limit 1");

        foreach ($results as $result) {
            $plant = new plant();
            $plant->hydrate($result);
        }

        return $plant;

    }

    public function getAllPLants(){

        $db = new Db();
        $users = array();

        $results = $db -> select("SELECT * from Plants");

        foreach($results as $result){
            $plant = new User();
            $plant->hydrate($result);
            $plants[] = $plant;
        }

        return $plants;

    }

    public function savePlant($plant){

    print ("<br> Ready to save a plant. <br><br>");
        if ($plant->getPlantID()) {
           $returnVal = $this->updatePlant($plant);
        } else {
            $returnVal = $this->addPlant($plant);
        }

    print ("<br><br> Saved plant <br><br><br>");
        return ($returnVal);
    }

    private function addPLant($plant){
        $db = new Db();

   print ("<br> Ready to Add a plant<br><br>");

        $name = $db -> quote($plant->getPlantName());
        $user = $db -> quote($plant->getPlantUser());
        $location = $db->quote($plant->getPlantLocation());
        $weather = $db->quote($plant->getPlantWeather());
        $soilID = $db -> quote($plant->getPlantSoilType());
        $soilCondition = $db -> quote ($plant->getPlantSoil());
        $note = $db -> quote($plant->getPlantNote());
        $onSite = $db -> quote($plant->getPlantEnteredOnSite());
        $query = "insert into Plants (SoilTypeID, LocationID, WeatherID, UserID, PlantName, PlantNote, SoilCondition, EnteredOnSite, DateEntered) values ($soilID, $location, $weather, $user, $name, $note, $soilCondition, $onSite, now());";

        $results = $db->insert($query);
   print ("<br> Done inserting new plant.<br><br>");
        return ($results);
    }

    private function UpdatePlant($plant){
        $db = new Db();

  print ("<br> Ready to Update  a plant<br><br>");

        $plantID = $db -> quote($plant->getPlantID());
        $name = $db -> quote($plant->getPlantName());
        $user = $db -> quote($plant->getPlantUser());
        $soil = $db -> quote($plant->getPlantSoil());
        $weather = $db->quote($plant->getPlantWeather());
        $location = $db->query($plant->getPlantLocation());
        $note = $db -> quote($plant->getPlantNote());
        $onSite = $db -> quote($plant->getEnteredOnSite());

        $results = $db -> query("update Plants set PLantName=$name, UserID=$user, SoilID=$soil, LocationID = $location, WeatherID = $weather, PlantName = $name, PlantNote = $note, EnteredOnSite = $onSite where PlantID = $plantID;");
print ("<br> Done updating   plant.<br><br>");
        return ($results);
    }
    public function delete($arg){

        if(!is_numeric($arg)) return FALSE;
        $db = new Db();

        $plantID = $db -> quote($arg);
        $results = $db -> query("DELETE from UPlants where PlantID = $plantID");
    }

}
?>