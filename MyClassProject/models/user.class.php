<?php

/**
 * User Object
 */
class User{
  
  private $_uid;
  private $_name;
  private $_pass;
  private $_mail;
  private $_created;
  private $_role;

  public function getUID(){return $this->_uid;}
  public function setUID($arg){$this->_uid = $arg;}
  
  public function getName(){return $this->_name;}
  public function setName($arg){$this->_name = $arg;}
  
  public function getPassword(){return $this->_pass;}
  public function setPassword($arg){$this->_pass = $arg;}
  
  public function getMail(){return $this->_mail;}

  public function setMail($arg)
  {
    if (filter_var($arg, FILTER_VALIDATE_EMAIL)) {
      $this->_mail = $arg;
    }
    else {
      $this->_mail = "";
    }
  }
  
  public function getCreated(){return $this->_created;}
  public function setCreated($arg){$this->_created = $arg;}        
  
  public function getRole(){return $this->_role;}
  public function setRole($arg){

    $this->_role = $arg;

  }
  
  public function isAdmin(){
    if ($this->_role == 1) {
      return TRUE;
    }
    return FALSE;
  }
    
  public function hydrate($arr) {

    $this->setUID(isset($arr["UserID"])?$arr["UserID"]:'');
    $this->setName(isset($arr["UserName"])?$arr["UserName"]:'');
    $this->setPassword(isset($arr["UserPassword"])?$arr["UserPassword"]:'');
    $this->setMail(isset($arr["UserEmail"])?$arr["UserEmail"]:'');
    $this->setCreated(isset($arr["CreatedDate"])?$arr["CreatedDate"]:'');
    $this->setRole(isset($arr["UserRole"])?$arr["UserRole"]:'0');

  }
  
}

