<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: applicaiton/json; charset=UTF-8");
// use the connection here
include 'db.php';
try {
    //echo $_GET['id'];
    $stmt = $conn->prepare('select * from ms_shoes where shoes_id=:id');
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();


    foreach ($stmt  as $row) {
        // print_r($row);
        $shoe = array(
            'id' => $row['shoes_id'],
            'name' => $row['shoes_name'],
            'price' => $row['price'],
            'stock' => $row['stock'],
            'desc' => $row['description'],
            'size' => $row['size'],
            'image_name' => $row['image'],
        );
        echo json_encode($shoe);
    }
    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    die();
}
