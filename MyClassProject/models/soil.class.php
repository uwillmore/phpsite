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

    public function getSoilUID(){return $this->_soilID;}
    public function setSoilUID($arg){$this->_soilID = $arg;}

    public function getSoilType(){return $this->_soilType;}
    public function setSoilType($arg){$this->_soilType = $arg;}

    function hydrate ($soils){
        $this->setSoilUID(isset($soils["SoilID"])?$soils["SoilID"]:'');
        $this->setSoilType(isset($soils["SoilType"])?$soils["SoilType"]:'');
    }

    function GetAllSoils ()
    {
        $db = new Db();

        $results = $db->select("SELECT SoilID, SoilType from Soils");

        if ($results) {

            $Soils = null;
            foreach ($results as $result) {
                $soil = new soil();
                $soil->hydrate($result);
                $Soils[] = $soil;
            }

            return $Soils;
        }
        else
            return ($results);
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