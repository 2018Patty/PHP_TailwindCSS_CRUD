 <?php
    // header("Access-Control-Allow-Origin: *");
    // header("Content-type: applicaiton/json; charset=UTF-8");
    // // use the connection here
    // require_once 'db.php';
    // try {

    //     $shoes = array();
    //     $result = $conn->query('SELECT * FROM ms_shoes');
    //     foreach ($result  as $row) {
    //         // print_r($row);
    //         $shoe = array(
    //             'id' => $row['shoes_id'],
    //             'name' => $row['shoes_name'],
    //             'price' => $row['price'],
    //             'stock' => $row['stock'],
    //             'desc' => mb_substr($row['description'], 0, 100),
    //             'image_name' => $row['image'],

    //         );
    //         array_push($shoes, $shoe);
    //     }
    //     echo json_encode($shoes);
    //     $conn = null;
    // } catch (PDOException $e) {
    //     echo "Error: " . $e->getMessage() . "<br>";
    //     die();
    // } 
    ?>

 <?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: applicaition/json; charset=UTF-8");

    require_once 'db.php';

    try {
        // รับค่า page และ limit จาก URL (ถ้าไม่มีจะใช้ค่า default)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
        if ($page < 1) {
            $page = 1;
        }
        if ($limit < 1) {
            $limit = 5;
        }
        $offset = ($page - 1) * $limit;

        // Query เพื่อหาจำนวน record ทั้งหมดสำหรับคำนวณ totalPages
        $stmtCount = $conn->query("SELECT COUNT(*) as total FROM ms_shoes");
        $rowCount = $stmtCount->fetch(PDO::FETCH_ASSOC);
        $totalRecords = (int)$rowCount['total'];
        $totalPages = ceil($totalRecords / $limit);

        // Query เพื่อดึงข้อมูลสินค้าตาม limit และ offset
        $stmt = $conn->prepare("SELECT * FROM ms_shoes LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $shoes = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $shoe = array(
                'id'         => $row['shoes_id'],
                'name'       => $row['shoes_name'],
                'price'      => $row['price'],
                'stock'      => $row['stock'],
                'desc'       => mb_substr($row['description'], 0, 100),
                'image_name' => $row['image']
            );
            array_push($shoes, $shoe);
        }

        // ส่งกลับข้อมูลในรูปแบบ JSON
        $response = array(
            'products'   => $shoes,
            'totalPages' => $totalPages
        );
        echo json_encode($response);
        $conn = null;
    } catch (PDOException $e) {
        echo json_encode(array("status" => "error", "message" => $e->getMessage()));
        die();
    }
    ?>