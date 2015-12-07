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
    private $_observationDate;
    private $_temperature;
    private $_conditions;


    public function getWeatherID(){return $this->_weatherID;}
    public function setWeatherID($arg){$this->_weatherID = $arg;}

    public function getTime(){return $this->_observationTime;}
    public function setTime($arg){$this->_observationTime = $arg;}

    public function getObservationDate(){return $this->_observationDate;}
    public function setObservationDate($arg){$this->_observationDate = $arg;}

    public function getTemperature(){return $this->_temperature;}
    public function setTemperature($arg){$this->_temperature = $arg;}

    public function getConditions(){return $this->_conditions;}
    public function setConditions($arg){$this->_conditions = $arg;}

    public function hydrate($arr){
        $this->setWeatherID(isset($arr["WeatherID"]) ? $arr["WeatherID"] : '');
        $this->setTime(isset($arr["Time"]) ? $arr["Time"] : '');
        $this->setTemperature(isset($arr["Temp"]) ? $arr["Temp"] : '');
        $this->setConditions(isset($arr["Conditions"]) ? $arr["Conditions"] : '');
        $this->setObservationDate(isset($arr["Date"]) ? $arr["Date"] : '');
    }

    function GetWeatherByID ($arg)
    {
        if (!is_numeric($arg)) return FALSE;

        $db = new Db();

        $WeatherID = $db->quote($arg);
        $results = $db->select("SELECT * from Weather where WeatherID = $WeatherID limit 1");

        if ($results) {
            $weather = new weather();
            foreach ($results as $result) {
                $weather->hydrate($result);
            }

            return $weather;
        }
        else
            return ($results);

    }

    function SaveWeatherData (){
        $db = new Db();

 print ("Ready to add a new weather<br>");

        $ObservationDate = $db ->quote($this->getObservationDate());
        $ObservationTime = $db -> quote($this->getTime());
        $Temp = $db -> quote($this->getTemperature());

        $Conditions = $db-> quote($this->getConditions());
        $results = $db->insert("insert into Weather (ObservationTime, ObservationDate, TemperatureF, Conditions, DateEntered) values ($ObservationTime, $ObservationDate, $Temp, $Conditions, now());");

        print ("Saved new weather<br>");
        return ($results);

    }
}