<?php


if (isset($_FILES['imagefile'])){
    //print "<pre>".print_r($_FILES['imagefile'], true). "</pre>";



    if (file_exists($_FILES['imagefile']['tmp_name'])) {
        //print "file exists";



        // File and new size
        $filename = $_FILES['imagefile']['tmp_name'] ;
        $percent = $_POST['coefficient'];

        // Content type
        header('Content-Type: '.$_FILES['imagefile']['type']);

        // Get new sizes
        list($width, $height) = getimagesize($filename);
        $newwidth = $width * $percent;
        $newheight = $height * $percent;

        // Load
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($filename);

        // Resize
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        // Output
        imagejpeg($thumb, 'tube_thumbnail.jpg');




    }

}

else {

    ?>


    <form method="POST" enctype="multipart/form-data" >
        <input name="coefficient" />
        <input type="file" name="imagefile" />
        <input type="submit" />





    </form>

    <?php

}

