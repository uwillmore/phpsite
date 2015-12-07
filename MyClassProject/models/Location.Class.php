<?php

/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/9/2015
 * Time: 6:01 PM
 */
class Location
{
    private $_location_id;
    private $_longitude;
    private $_latitude;
    private $_gpsCoordinate;
    private $_locationNote;

    public function getLocationID(){return $this->_location_id;}
    public function setLocationID($arg){$this->_location_id = $arg;}

    public function getLongitude(){return $this->_longitude;}
    public function setLongitude($arg){$this->_longitude = $arg;}

    public function getLatitude(){return $this->_latitude;}
    public function setLatitude($arg){$this->_latitude = $arg;}

    public function getGPS(){return $this->_gpsCoordinate;}
    public function setGPS($arg){$this->_gpsCoordinate = $arg;}

    public function getLocationNote(){return $this->_locationNote;}
    public function setLocationNote($arg){$this->_locationNote = $arg;}


    function hydrate ($arr){
        $this->setLocationID(isset($arr["LocationID"])?$arr["LocationID"]:'');
        $this->setLongitude(isset($arr["Longitude"])?$arr["Longitude"]:'');
        $this->setLatitude(isset($arr["Latitude"])?$arr["Latitude"]:'');
        $this->setGPS(isset($arr["GPS"])?$arr["GPS"]:'');
        $this->setLocationNote(isset($arr["Note"])?$arr["Note"]:'');
    }

    function GetLocation ($arg){
        if(!is_numeric($arg)) return FALSE;

        $db = new Db();

        $LocationID = $db -> quote($arg);
        $results = $db -> select("SELECT * from Locations where LocationID = $LocationID limit 1");

        foreach($results as $result){
            $location = new Location();
            $location->hydrate($result);
        }

        return $location;
    }

    function SaveLocation (){
        $db = new Db();

        print ("Ready to add a new location<br>");


        $Long = $db -> quote($this->getLongitude());
        $Lat = $db -> quote($this->getLatitude());
        $GPS = $db-> quote($this->getGPS());
        $Note = $db->quote($this->getLocationNote());
        $query = "insert into Locations  (Longitude, Latitude, GPSCoordinates, LocationNotes) values ($Long, $Lat, $GPS, $Note);";

        $results = $db->insert($query);

        print ("Results were: " . $results . "<br>");
        print ("Saved new location<br>");
        return ($results);
    }
}