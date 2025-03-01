<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
    die();
}


// ตรวจสอบว่าไฟล์ถูกอัปโหลดมาหรือไม่
if (!isset($_FILES['product_pic'])) {
    echo json_encode(array("status" => false, "message" => "No file uploaded"));
    exit;
}

$fileName  = $_FILES['product_pic']['name'];
$tempPath  = $_FILES['product_pic']['tmp_name'];
$fileSize  = $_FILES['product_pic']['size'];

// ตรวจสอบชื่อไฟล์
if (empty($fileName)) {
    echo json_encode(array("status" => false, "message" => "Please select an image"));
    exit;
}

$upload_path = '../product_display/'; // ระบุพาธให้ชัดเจน
if (!is_dir($upload_path)) {
    mkdir($upload_path, 0777, true); // สร้างโฟลเดอร์ถ้ายังไม่มี
}

// ตรวจสอบนามสกุลของไฟล์
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

if (!in_array($fileExt, $valid_extensions)) {
    echo json_encode(array("status" => false, "message" => "Invalid file type"));
    exit;
}

// ตรวจสอบขนาดไฟล์
if ($fileSize > 5000000) {
    echo json_encode(array("status" => false, "message" => "File is too large. Maximum size is 5MB"));
    exit;
}

// เปลี่ยนชื่อไฟล์เพื่อป้องกันการซ้ำกัน
$newFileName = uniqid('img_', true) . '.' . $fileExt;
$filePath = $upload_path . $newFileName;

//echo $newFileName . "<br>";
//echo $filePath;

if (move_uploaded_file($tempPath, $filePath)) {
    // บันทึกลงฐานข้อมูล
    try {
        $stmt = $conn->prepare("INSERT INTO ms_shoes (shoes_name, description, size, price, stock, image) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bindParam(1, $_POST['product_name']);
        $stmt->bindParam(2, $_POST['product_desc']);
        $stmt->bindParam(3, $_POST['product_size']);
        $stmt->bindParam(4, $_POST['product_price']);
        $stmt->bindParam(5, $_POST['product_instock']);
        $stmt->bindParam(6, $newFileName);

        if ($stmt->execute()) {
            echo json_encode(array("status" => "ok", "message" => "File uploaded successfully"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Database insert failed"));
        }
    } catch (PDOException $e) {
        echo json_encode(array("status" => "error", "message" => "Error: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("status" => false, "message" => "File upload failed"));
}