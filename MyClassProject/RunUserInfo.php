<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/28/2015
 * Time: 8:14 PM
 */
require_once("models/plant.class.php");
if (!class_exists('Location')) {
    require_once("models/Location.class.php");
}
require_once("models/weather.class.php");


require_once('classes/db.interface.php');
require_once('classes/db.class.php');
require_once('models/user.class.php');
require_once('models/manager.abstract.php');
require_once('models/user_manager.class.php');

if (!isset ($_SESSION)) {
    session_start();
}
if(isset($_GET['password'])){
print "Found a password.<br>";
    $username = $_get ['name'];
    $UserID = $_GET['UID'];
    $userManager = new UserManager();
    $User = $userManager->authenticate($username, $password);
    // if user was authenticated, redirect to report form
    // after you save User data to sesson
    // otherwise, return to UserInfo page.
    if (!$User)
        include('views/userInfo.php');
    else {
        $_SESSION['current_user'] = $User;
        include('view/report.php');
    }
}
else{ // is user entered email address, go ahead and update user in case it is a new email.

    if (isset ($_GET['email'])){
        $username = $_GET ['name'];
        $email = $_GET ['email'];
        $UserID = $_GET['UID'];
        $User = new User();
        $User->setMail($email);
        $User->setName($username);
        $User->setUID($UserID);
        $UserManager = new UserManager();

        $returnVal = $UserManager->save($User);
       // URW TODO Remove commented line
       // No need to set user ID. this should always be an update User was added before this page
       // came up.
       // $User->setUID($returnVal);
        $_SESSION['current_user'] = $User;

     //   print("<br><br>Saving to session before PlantAdd. <br>");

        /*var_dump ($User);*/


    }

    // now go to the plant data collection form
    include_once ("views/flower_add.php");
}

