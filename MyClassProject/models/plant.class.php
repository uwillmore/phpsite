<?php

/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/9/2015
 * Time: 6:01 PM
 */
class Plant
{
    private $_plantID;
    private $_userID;
    private $_locationID;
    private $_soilType;
    private $_weatherID;
    private $_soilCondition;
    private $_plantName;
    private $_plantNote;
    private $_enteredOnSite;
    private $_dataEntered;

    public function getPlantID(){return $this->_plantID;}
    public function setPlantID($arg){$this->_plantID = $arg;}

    public function getPlantUser(){return $this->_userID;}
    public function setPlantUser($arg){$this->_userID = $arg;}

    public function getPlantLocation(){return $this->_locationID;}
    public function setPlantLocation($arg){$this->_locationID = $arg;}

    public function getPlantSoil(){return $this->_soilCondition;}
    public function setPlantSoil($arg){$this->_soilCondition = $arg;}

    public function getPlantSoilType(){return $this->_soilType;}
    public function setPlantSoilType($arg){$this->_soilType = $arg;}

    public function getPlantWeather(){return $this->_weatherID;}
    public function setPlantWeather($arg){$this->_weatherID = $arg;}

    public function getPlantName(){return $this->_plantName;}
    public function setPlantName($arg){$this->_plantName = $arg;}

    public function getPlantNote(){return $this->_plantNote;}
    public function setPlantNote($arg){$this->_plantNote = $arg;}

    public function getPlantDate(){return $this->_dataEntered;}
    public function setPlantDate($arg){$this->_dataEntered = $arg;}

    public function getPlantEnteredOnSite () {return $this->_enteredOnSite;}
    public function setPlantEnteredOnSite($arg){
        if ($arg === 0 || $arg === 1)
            $this->_enteredOnSite = $arg;
        else
            $this->_enteredOnSite = 0;
    }

    public function hydrate($arr) {
        $this->setPlantID(isset($arr["PlantID"])?$arr["PlantID"]:'');
        $this->setPlantUser(isset($arr["UserID"])?$arr["UserID"]:'');
        $this->setPlantLocation(isset($arr["LocationID"])?$arr["LocationID"]:'');
        $this->setPlantName(isset($arr["PlantName"])?$arr["PlantName"]:'');
        $this->setPlantSoilType(isset($arr["SoilTypeID"])?$arr["SoilTypeID"]:'');
        $this->setPlantSoil(isset($arr["SoilCondition"])?$arr["SoilCondition"]:'');
        $this->setPlantWeather(isset($arr["WeatherID"])?$arr["WeatherID"]:'');
        $this->setPlantNote(isset($arr["PlantNote"])?$arr["PlantNote"]:'');
        $this->setPlantEnteredOnSite(isset($arr["EnteredOnSite"])?$arr["EnteredOnSite"]:'0');
        $this->setPlantDate(isset($arr["Date"])?$arr["Date"]:'');
    }


}