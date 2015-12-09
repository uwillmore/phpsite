<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/27/2015
 * Time: 6:15 PM
 */
require_once('classes/db.interface.php');
require_once('classes/db.class.php');
require_once('models/user.class.php');
require_once('models/manager.abstract.php');
require_once('models/user_manager.class.php');

if (!isset ($_SESSION)) {
    session_start();
}

if(isset($_GET['UserName'])){


    $UserName = isset($_GET["UserName"])?$_GET["UserName"]:'';
    $UserManager = new UserManager();
    $User = $UserManager->getUserByName($UserName);
    if (!$User) {
        $User = new User();
        $User->setName($UserName);
        $returnVal = $UserManager->save($User);

        // if ReturnVal has a value, we inserted a new user and need to save the returned
        // new userID.
        // Otherwise, we had an existing user and need to get the rest of the data for this
        // user from the DB.
        if (isset ($returnVal))
            $User->setUID($returnVal);
        else
            $User = $UserManager->getUserByName($UserName);

        print ("<br><Br> User from DB <br><Br> ");
        var_dump($User);
    }
    /* URW DEBUG
    print ("Saved UserName im RunIndex<br>");
    print_r($User);

    print("User saved to session<br> and off to UserInfo view <br>");
*/
    $_SESSION['current_user'] = $User;
    include_once('views/userInfo.php');
}
else {
    include_once ("index.php");
}