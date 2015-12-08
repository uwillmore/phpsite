
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
        $plant = new plant();

        $uid = $db->quote($arg);

        $query = " select P.PlantID, P.PlantName, P.PlantNote, P.SoilCondition, P.EnteredOnSite, P.DateEntered, ";
        $query = $query . " U.UserName, U.UserEmail, U.UserRole, ";
        $query = $query . " S.SoilType, W.ObservationDate, W.ObservationTime, W.TemperatureF, W.Conditions, ";
        $query = $query . " L.Longitude, L.Latitude, L.GPSCoordinates, L.LocationNotes ";
        $query = $query . " from Plants as P  ";
        $query = $query . " join Users as U on U.userID = P.userID ";
        $query = $query . " join Weather W on P.WeatherID = W.WeatherID ";
        $query = $query . " join Locations L on L.LocationID = P.LocationID ";
        $query = $query . " join Soils S on S.SoilID = P.SoilTypeID ";
        $query = $query . " where P.PlantID = " .$uid . " limit 1 ";
        $results = $db->select($query);

        foreach ($results as $result) {
            $plant->hydrate($result);
        }

        return $plant;

    }

    public function getAllPLants(){

        $plants = Array();

        $db = new Db();

        $query = " select P.PlantID, P.PlantName, P.PlantNote, P.SoilCondition, P.EnteredOnSite, P.DateEntered, ";
	    $query = $query . " U.UserName, U.UserEmail, U.UserRole, ";
        $query = $query . " S.SoilType, W.ObservationDate, W.ObservationTime, W.TemperatureF, W.Conditions, ";
        $query = $query . " L.Longitude, L.Latitude, L.GPSCoordinates, L.LocationNotes ";
        $query = $query . " from Plants as P  ";
        $query = $query . " join Users as U on U.userID = P.userID ";
        $query = $query . " join Weather W on P.WeatherID = W.WeatherID ";
        $query = $query . " join Locations L on L.LocationID = P.LocationID ";
        $query = $query . " join Soils S on S.SoilID = P.SoilTypeID ";
        $query = $query . " Order by P.DateEntered, P.PlantName, U.UserName ";
        $results = $db -> select($query);

        foreach($results as $result){
            $plant = new Plant();
            $plant->hydrate($result);
            $plants[] = $plant;
        }

        return $plants;

    }

    public function savePlant($plant){

    //print ("<br> Ready to save a plant. <br><br>");
        if ($plant->getPlantID()) {
           $returnVal = $this->updatePlant($plant);
        } else {
            $returnVal = $this->addPlant($plant);
        }

   //print ("<br><br> Saved plant <br><br><br>");
        return ($returnVal);
    }

    private function addPLant($plant){
        $db = new Db();

  // print ("<br> Ready to Add a plant<br><br>");

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
  // print ("<br> Done inserting new plant.<br><br>");
        return ($results);
    }

    private function UpdatePlant($plant){
        $db = new Db();

 // print ("<br> Ready to Update  a plant<br><br>");

        $plantID = $db -> quote($plant->getPlantID());
        $name = $db -> quote($plant->getPlantName());
        $user = $db -> quote($plant->getPlantUser());
        $soil = $db -> quote($plant->getPlantSoil());
        $weather = $db->quote($plant->getPlantWeather());
        $location = $db->query($plant->getPlantLocation());
        $note = $db -> quote($plant->getPlantNote());
        $onSite = $db -> quote($plant->getEnteredOnSite());

        $results = $db -> query("update Plants set PLantName=$name, UserID=$user, SoilID=$soil, LocationID = $location, WeatherID = $weather, PlantName = $name, PlantNote = $note, EnteredOnSite = $onSite where PlantID = $plantID;");
//print ("<br> Done updating   plant.<br><br>");
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