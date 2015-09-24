<!--
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/16/2015
 * Time: 8:14 PM
*/
-->
<h1> <?php if (strlen ($EmailPart) > 0)
            print ("The first part of your email address is: " . $EmailPart);
           else
            print ("The email address you entered was invalid.");
    ?></h1>

<?php
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<a href='$url'>Try another Email</a>";
?>