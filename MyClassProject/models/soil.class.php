<?php

/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/9/2015
 * Time: 6:02 PM
 */
class soil
{
    private $_soilID;
    private $_soilType;
    private $_soilCondition;

    public function getSoilUID(){return $this->_soilID;}
    public function setSoilUID($arg){$this->_soilID = $arg;}

    public function getSoilType(){return $this->_soilType;}
    public function setSoilType($arg){$this->_soilType = $arg;}

    public function getSoilCondition(){return $this->_soilCondition;}
    public function setSoilCondition($arg){$this->_soilCondition = $arg;}

    function hydrate ($soils){
        $this->setSoilUID(isset($arr["SoilID"])?$arr["SoilID"]:'');
        $this->setSoilType(isset($arr["SoilType"])?$arr["SoilType"]:'');
        $this->setSoilCondition(isset($arr["SoilCondition"])?$arr["SoilCondition"]:'');
    }

    function GetAllSoils () {
        $db = new Db();

        $results = $db -> select("SELECT * from Soils");

        foreach($results as $result){
            $soil = new soil();
            $soil->hydrate($result);
            $Soils[] = $soil;
        }

        return $Soils;
    }

    function GetSoil ($arg) {
      if(!is_numeric($arg)) return FALSE;

      $db = new Db();

      $SoilID = $db -> quote($arg);
      $results = $db -> select("SELECT * from Soils where SoilID = $SoilID limit 1");

      foreach($results as $result){
          $soil = new soil();
          $soil->hydrate($result);
      }

      return $soil;
    }
}