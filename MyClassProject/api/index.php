<?php

require 'vendor/autoload.php';
require 'controllers/ApiController.php';

die('this is in index.php');

Flight::route('observations', array('ApiController','index'));

Flight::start();