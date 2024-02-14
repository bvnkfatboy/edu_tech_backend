<?php
// Set headers
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// Include configuration file and establish database connection
require_once('../../config.php');
$dbConnection = new DbConnection();
$connection = $dbConnection->getConnection();

// Retrieve the 'database' parameter from the request
$database = isset($_GET['database']) ? $_GET['database'] : '';

// Define SQL queries for different database types
$queries = [
    'carousal_img' => "SELECT * FROM carousel_img_slide",
    'gallery' => "SELECT * FROM gallery",
    'article' => "SELECT * FROM article",
    'video' => "SELECT * FROM video",
    'evaluate_media' => "SELECT * FROM group_media WHERE `group` = 'evaluate_media'",
    'learning_media' => "SELECT * FROM group_media WHERE `group` = 'learning_media'",
    'request_media' => "SELECT * FROM group_media WHERE `group` = 'request_media'",
    'product_service' => "SELECT * FROM group_media WHERE `group` = 'product_service'",
    'room_service' => "SELECT * FROM group_media WHERE `group` = 'room_service'",
    'service' => "SELECT * FROM group_media WHERE `group` = 'services'"
];

// Check if a valid 'database' parameter is provided
if ($database != '' && array_key_exists($database, $queries)) {
    // Execute the corresponding query
    $sql = $queries[$database];
    $result = $connection->query($sql);

    // Fetch data as associative array
    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        // Handle query execution error
        echo json_encode(["error" => "Failed to execute query"], JSON_UNESCAPED_UNICODE);
    }
} else {
    // Handle missing or invalid 'database' parameter
    echo json_encode(["error" => "Invalid or missing 'database' parameter"], JSON_UNESCAPED_UNICODE);
}

// Close database connection
$connection->close();
?>
