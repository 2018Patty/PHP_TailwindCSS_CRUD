<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: applicaiton/json; charset=UTF-8");
// use the connection here
require_once 'db.php';
try {

    $customers = array();
    $result = $conn->query('SELECT * FROM ms_customer');
    foreach ($result  as $row) {
        // print_r($row);
        $customer = array(
            'id' => $row['customer_id'],
            'name' => $row['customer_name'],
            'address' => $row['customer_address'],
            'username' => $row['username'],
        );
        array_push($customers, $customer);
    }
    echo json_encode($customers);
    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    die();
}
