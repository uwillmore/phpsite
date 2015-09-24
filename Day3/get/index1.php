<?php

require_once('views/header.php');

if(isset($_GET['name'])){
    include_once('views/partials/hello.php');
}
else {
    include_once('views/partials/input.php');
}

?>

