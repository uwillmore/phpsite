<!--
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/16/2015
 * Time: 8:14 PM
*/
-->
<h1> <?php print "The reversed string is ' ". $ReversedString . "'"; ?></h1>

<?php
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
 echo "<a href='$url'>Reverse another string</a>";
?>


