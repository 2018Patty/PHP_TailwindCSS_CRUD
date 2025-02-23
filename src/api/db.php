<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fr_shoestoredb";
try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    // echo "Connection failed: " . $e->getMessage();
}

function test_input($data)
{

    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}

$data = "Up in the '80s, the adidas Originals Samoa blends a mix of upper materials with the iconic colorful stripes for a look that never falls off.";

// echo test_input($data);

function uploadPic()
{
    //upload file
    // echo $_FILES["picfile"]["name"];
    $target_dir = "../product_display/";
    $target_file = $target_dir . basename($_FILES["picfile"]["name"]);
    //echo $target_file.  "<br>";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["picfile"]["tmp_name"]);

    print $check;
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["picfile"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["picfile"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["picfile"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
