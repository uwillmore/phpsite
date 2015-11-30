<?php

/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/9/2015
 * Time: 6:01 PM
 */
class weather
{
    private $_weatherID;
    private $_observationTime;
    private $_temperature;
    private $_conditions;
    private $_dateEntered;


    public function getWeatherID(){return $this->_weatherID;}
    public function setWeatherID($arg){$this->_weatherID = $arg;}

    public function getTime(){return $this->_observationTime;}
    public function setTimer($arg){$this->_observationTime = $arg;}

    public function getTemperature(){return $this->_temperature;}
    public function setTemperature($arg){$this->_temperature = $arg;}

    public function getConditions(){return $this->_conditions;}
    public function setConditions($arg){$this->_conditions = $arg;}

    public function getDate(){return $this->_dateEntered;}
    public function setDate($arg){$this->_dateEntered = $arg;}

    public function hydrate($arr){
        $this->setWeatherID(isset($arr["WeatherID"]) ? $arr["WeatherID"] : '');
        $this->setTime(isset($arr["Time"]) ? $arr["Time"] : '');
        $this->setTemperature(isset($arr["Temp"]) ? $arr["Temp"] : '');
        $this->setConditions(isset($arr["Conditions"]) ? $arr["Conditions"] : '');
        $this->setDate(isset($arr["Date"]) ? $arr["Date"] : '');
    }

    function GetWeatherByID ($arg) {
        if(!is_numeric($arg)) return FALSE;

        $db = new Db();

        $WeatherID = $db -> quote($arg);
        $results = $db -> select("SELECT * from Weather where WeatherID = $WeatherID limit 1");

        foreach($results as $result){
            $weather = new weather();
            $weather->hydrate($result);
        }

        return $weather;
        // select and return the weather data for the specified ID
    }

    function SaveWeatherData ($weather){
        $db = new Db();

        print ("Ready to add a new weather<br>");

        $ObservationTime = $db -> quote($weather->getTime());
        $temp = $db -> quote($weather->getTemperature());
        $Conditions = $db-> $this->quote($weather->getConditions());

        $results = $db->query("insert into Weather (ObservationTime, TemperatureF, Conditions, DateEntered) values ($ObservationTime, $temp, $Conditions, now());");
        print ("Saved new waether<br>");
        print_r ($results);
        exit;

    }
}