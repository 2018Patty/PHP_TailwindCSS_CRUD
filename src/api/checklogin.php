<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: applicaiton/json; charset=UTF-8");
// use the connection here
require_once 'db.php';

// อ่านค่าที่ส่งมาจาก Form
$data = json_decode(file_get_contents("php://input"));


//ตรวจสอบว่าส่งมาแบบ POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("status" => "error"));
    die();
}
try {

    if (!empty($data->username) && !empty($data->password)) {
        $username = $data->username;
        $password = $data->password;

        // ตรวจสอบว่า username มีอยู่ในระบบหรือไม่
        $stmt = $conn->prepare("SELECT password FROM ms_customer WHERE username = :username LIMIT 1");
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // ตรวจสอบรหัสผ่าน
            if ($password ==  $user['password']) {
                http_response_code(200);
                echo json_encode(["status" => true, "message" => "Login successful"]);
            } else {
                http_response_code(401);
                echo json_encode(["status" => false, "message" => "Invalid password"]);
            }
        } else {
            http_response_code(404);
            echo json_encode(["status" => false, "message" => "User not found"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["status" => false, "message" => "Username and password required"]);
    }

    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    die();
}
