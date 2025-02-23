<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("status" => "error", "message" => "รองรับเฉพาะ POST เท่านั้น"));
    die();
}

// ตรวจสอบการอัปโหลดไฟล์
if (!isset($_FILES['product_pic']) || $_FILES['product_pic']['error'] != 0) {
    echo json_encode(array("status" => "error", "message" => "ไม่มีการอัปโหลดไฟล์หรือเกิดข้อผิดพลาด"));
    die();
}

// รับค่าจากฟอร์ม (ส่งมาในรูปแบบ multipart/form-data)
$id  = isset($_POST['product_id']) ? $_POST['product_id'] : '';
$name  = isset($_POST['product_name']) ? $_POST['product_name'] : '';
$desc  = isset($_POST['product_desc']) ? $_POST['product_desc'] : '';
$size  = isset($_POST['product_size']) ? $_POST['product_size'] : '';
$price = isset($_POST['product_price']) ? $_POST['product_price'] : 0;
$stock = isset($_POST['product_instock']) ? $_POST['product_instock'] : 0;

$originalFileName = basename($_FILES['product_pic']['name']);
$fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
$newFileName = uniqid('shoe_', true) . '.' . $fileExtension;

// echo "File Name: " . $newFileName;
// echo $id . "<br>";
// echo $name . "<br>";
// echo $desc . "<br>";
// echo $size . "<br>";
// echo $stock . "<br>";


//upload file
// echo $_FILES["picfile"]["name"];

$target_dir = "../product_display/";

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true); // สร้างโฟลเดอร์พร้อมปรับสิทธิ์ให้ writable
}

// $target_file = $target_dir . basename($_FILES["product_pic"]["name"]);
$target_file = $target_dir . $newFileName;
//echo $target_file .  "<br>";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["product_pic"]["tmp_name"]);

//print $check;
if ($check !== false) {
    //echo "<br>File is an image - " . $check["mime"] . ".";

} else {
    echo "File is not an image.";
    $uploadOk = 0;
    die();
}


// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    die();
}

// Check file size
if ($_FILES["product_pic"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    die();
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    die();
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    die();
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["product_pic"]["tmp_name"], $target_file)) {
        //echo "The file " . htmlspecialchars(basename($newFileName)) . " has been uploaded.";
    } else {
        $uploadOk == 0;
        $error = error_get_last();
        echo "Upload failed with error: " . $error['message'];
        echo "Sorry, there was an error uploading your file.";
        die();
    }
}

echo $uploadOk;
if ($uploadOk == 1) {
    try {

        //echo "Start Insert";
        $stmt = $conn->prepare("Update ms_shoes 
        SET shoes_name=?, 
        description=?, 
        size=?, 
        price=?, 
        stock=?, 
        image=? 
         WHERE shoes_id=?");



        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $desc);
        $stmt->bindParam(3, $size);
        $stmt->bindParam(4, $price);
        $stmt->bindParam(5, $stock);
        $stmt->bindParam(6, $newFileName);
        $stmt->bindParam(7, $id);


        //echo "Bindparam Insert";

        if ($stmt->execute()) {
            echo json_encode(array("status" => "ok"));
            //echo "<br>Update Completed!";
        } else {
            echo json_encode(array("status" => "error", "message" => "ไม่สามารถบันทึกข้อมูลลงฐานข้อมูลได้"));
        }

        $conn = null;
        //echo "<br>Update Completed!";
        header('Location: ../admin_product.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
