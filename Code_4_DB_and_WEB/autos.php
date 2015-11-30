<?php
    class car {
        private $wheels = 4;
        private $seats = 2;
        private $convertible = true;

        public function accelerate() {
            echo 'vroooom';
        }

        protected function openTop() {
            $this->convertible = true;
            echo "opened the top";
        }

        protected function closeTop() {
            $this->convertible = false;
            echo "closed the top";
        }

        public function letsOpenTheTop() {
            $this->openTop();
        }

        public function letsCloseTheTop() {
            $this->closeTop();
        }
    }

    class bmw extends car {
        public function accelerate() {
            echo 'VROOOOOOOOMMMMM';
        }



    }

    class chanceOfRain {
        public $chance;
        function __construct() {
            $this->chance = rand(0,10);
            // echo $this->chance;
        }

        function checkForRain() {
            if($this->chance > 5) {
                return true;
            } else {
                return false;
            }
        }
    }

    $myCar = new car;
    $myCar->accelerate();
    $myCar->letsOpenTheTop();

    $myNewCar = new bmw;
    $myNewCar->accelerate();

    // $myNewCar->letsOpenTheTop();

    $rain = new chanceOfRain;

    if($rain) {
        echo "<p>It's raining!</p>";
        $myCar->letsCloseTheTop();
    }
 ?>
