 <?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: applicaiton/json; charset=UTF-8");
    // use the connection here
    require_once 'db.php';
    try {

        $shoes = array();
        $result = $conn->query('SELECT * FROM ms_shoes');
        foreach ($result  as $row) {
            // print_r($row);
            $shoe = array(
                'id' => $row['shoes_id'],
                'name' => $row['shoes_name'],
                'price' => $row['price'],
                'stock' => $row['stock'],
                'desc' => mb_substr($row['description'], 0, 100),
                'image_name' => $row['image'],

            );
            array_push($shoes, $shoe);
        }
        echo json_encode($shoes);
        $conn = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "<br>";
        die();
    }
    ?>