<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: applicaiton/json; charset=UTF-8");
// use the connection here
require_once 'db.php';

$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("status" => "error"));
    die();
}

try {


    $stmt = $conn->prepare("INSERT INTO ms_shoes (shoes_name, description,size,price,stock,image) VALUES (?,?,?,?,?,?)");

    $stmt->bindParam(1, $data->name);
    $stmt->bindParam(2, $data->desc);
    $stmt->bindParam(3, $data->size);
    $stmt->bindParam(4, $data->price);
    $stmt->bindParam(5, $data->stock);
    $stmt->bindParam(6, $data->image);

    if ($stmt->execute()) {
        echo json_encode(array("status" => "ok"));
    } else {
        echo json_encode(array("status" => "error"));
    }
    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    die();
}


// $arrayData = [
//     "name" => "adidas Originals Samoa - Mens Comin",
//     "price" => 7000,
//     "stock" => 16,
//     "desc" => "Up in the '80s, the adidas Originals Samoa blends a mix of upper materials with the iconic colorful stripes for a look that never falls off.",
//     "size" => "42",
//     "image_name" => "addidas-adidas_originals_samoa_-_mens_comin-090214083733.jpeg"
// ];
// $data = (object) $arrayData;

// echo $data->name;