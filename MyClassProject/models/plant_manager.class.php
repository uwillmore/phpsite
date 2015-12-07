
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

        if ($plant->getPlantID()) {
           $returnVal = $this->updatePlant($plant);
        } else {
            $returnVal = $this->addPlant($plant);
        }
        return ($returnVal);
    }

    private function addPLant($plant){
        $db = new Db();

        $name = $db -> quote($plant->getPlantName());
        $user = $db -> quote($plant->getPlantUser());
        $location = $db->query($plant->getPlantLocation());
        $weather = $db->query($plant->getPlantWeather());
        $soil = $db -> quote($plant->getPlantSoil());
        $note = $db -> quote($plant->getPlantNote());
        $onSite = $db -> quote($plant->getPlantEnteredOnSite());

        $results = $db->insert("insert into Plants (SoilID, LocationID, WeatherID, UserID, PlantName, PlantNote, EnterInSite, CreatedDate) values ($soil, $location, $weather, $user, $name, $note, $onSite, now());");
        return ($results);
    }

    private function UpdatePlant($plant){
        $db = new Db();

        $plantID = $db -> quote($plant->getPlantID());
        $name = $db -> quote($plant->getPlantName());
        $user = $db -> quote($plant->getPlantUser());
        $soil = $db -> quote($plant->getPlantSoil());
        $weather = $db->quote($plant->getPlantWeather());
        $location = $db->query($plant->getPlantLocation());
        $note = $db -> quote($plant->getPlantNote());
        $onSite = $db -> quote($plant->getEnteredOnSite());

        $results = $db -> query("update Plants set PLantName=$name, UserID=$user, SoilID=$soil, LocationID = $location, WeatherID = $weather, PlantName = $name, PlantNote = $note, EnteredOnSite = $onSite where PlantID = $plantID;");
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