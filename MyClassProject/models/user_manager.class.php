<?php 

class UserManager extends Manager{

  public function authenticate($username, $password){
        
      $db = new Db();
    
      $username = $db -> quote($username);
      $results = $db -> select("SELECT * from Users where UserName = $username limit 1");
      
      if(!$results){
        return FALSE;
      }
      
      foreach($results as $result){
        $user = new User();
        $user->hydrate($result);
      }
      
      
      if(password_verify($password, $user->getPassword())){
        return $user;
      } else {
        return FALSE;
      }     

  }

    	
  public function getUserByID($arg){
    
    if(!is_numeric($arg)) return FALSE;
    
      $db = new Db();
    
      $uid = $db -> quote($arg);
      $results = $db -> select("SELECT * from Users where UserID = $uid limit 1");
      
      foreach($results as $result){
        $user = new User();
        $user->hydrate($result);
      }
      
      return $user;
    
  }

    public function getUserByName($arg){


        $db = new Db();

        $name = $db -> quote($arg);

        $results = $db -> select("SELECT * from Users where UserName = $name limit 1");
        foreach($results as $result){
            $user = new User();
            $user->hydrate($result);
            return ($user);
        }
        return (null);
    }

  public function getAllUsers(){
    
      $db = new Db();
      $users = array();
          
      $results = $db -> select("SELECT * from Users");
      
    foreach($results as $result){
        $user = new User();
        $user->hydrate($result);
        $users[] = $user;
      }
            
      return $users;    
      
  }
  public function save($user){

    if ($user->getUID()) {
        $results = $this->_update($user);
    } else {
        $results = $this->_add($user);
    }
      return ($results);
  }
  
  private function _add($user){
    $db = new Db();

    $name = $db -> quote($user->getName());
    $mail = $db -> quote($user->getMail());
   // $pass = password_hash($user->getPassword(), PASSWORD_BCRYPT, array("cost" => 10));
   // $pass = $db -> quote($pass);
    $pass = $db -> quote($user->getPassword());

    $results = $db->insert("insert into Users (UserName, UserPassword, UserEmail, CreatedDate) values ($name, $pass, $mail, now());");
    if ($results){
       return ($results);
    }
      return (false);
  }
  
  private function _update($user){
    $db = new Db();

    $uid = $db -> quote($user->getUID());
    $name = $db -> quote($user->getName());
    $mail = $db -> quote($user->getMail());
    $role = $db -> quote($user->getRole());
    
    if($user->getPassword()){
     // $pass = password_hash($user->getPassword(), PASSWORD_BCRYPT, array("cost" => 10));
      //$pass = $db -> quote($pass);
      $pass = $db -> quote($user->getPassword());
    } else {
      $pass = '';
    }

    if(!empty($pass)){
      $results = $db -> query("update Users set UserName=$name, UserPassword=$pass, UserEmail=$mail where UserID = $uid;");
    } else {
      $results = $db -> query("update Users set UserName=$name, UserEmail=$mail where UserID = $uid;");
    }

      return ($results);
  }
  
  public function delete($arg){
    
    if(!is_numeric($arg)) return FALSE;
    
      $db = new Db();
    
      $uid = $db -> quote($arg);
      $results = $db -> query("DELETE from Users where UserID = $uid");
  }
  
}

