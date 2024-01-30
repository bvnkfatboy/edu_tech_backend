<?php 
header('Content-Type: application/json; charset=utf-8');
include_once('../../config.php');
$dbConnection = new DbConnection();
$connection = $dbConnection->getConnection();

$database = isset($_GET['database']) ? $_GET['database'] : '' ;

if ($database != '') {
    switch ($database) {
        case ('carousal_img'):
            $sql = "SELECT * FROM carousel_img_slide";
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