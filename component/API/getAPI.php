<?php 
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include_once('../../config.php');
$dbConnection = new DbConnection();
$connection = $dbConnection->getConnection();

$database = isset($_GET['database']) ? $_GET['database'] : '' ;

if ($database != '') {
    switch ($database) {
        case ('carousal_img'):
            $sql = "SELECT * FROM carousel_img_slide";
            break;
        case ('gallery'):
            $sql = "SELECT * FROM gallery";
            break;
        case ('article'):
            $sql = "SELECT * FROM article";
            break;
        case ('video'):
            $sql = "SELECT * FROM video";
            break;

        case ('evaluate_media'):
            $sql = "SELECT * FROM evaluate_media WHERE group = evaluate_media";
            break;
        case ('learning_media'):
            $sql = "SELECT * FROM learning_media WHERE group = learning_media";
            break;
        case ('request_media'):
            $sql = "SELECT * FROM request_media WHERE group = request_media";
            break;
        case ('product_service'):
            $sql = "SELECT * FROM product_service WHERE group = product_service";
            break;
        case ('room_service'):
            $sql = "SELECT * FROM room_service WHERE group = room_service";
            break;
        case ('service'):
            $sql = "SELECT * FROM services WHERE group = services";
            break;

        default:
            echo json_encode(["error" => "Invalid type"],JSON_UNESCAPED_UNICODE);
            exit;
    }

    $result = $connection->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data , JSON_UNESCAPED_UNICODE);
}else{
    echo json_encode(["error" => "Type parameter is missing"],JSON_UNESCAPED_UNICODE);
}


$connection->close();





?>