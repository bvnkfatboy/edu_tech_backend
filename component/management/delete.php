<?php
include_once('config.php');
$dbConnection = new DbConnection();
$connection = $dbConnection->getConnection();

$delete = isset($_GET['deletetype']) ? $_GET['deletetype'] : '' ;

switch ($delete) {
    case ('carousal_img'):

        $deleteImgId = $_GET['confirm_delete'];
        // Sanitize and validate the input
        $deleteImgId = mysqli_real_escape_string($connection, $deleteImgId);
        $sql = "SELECT img_resource FROM carousel_img_slide WHERE img_id = $deleteImgId";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $file_to_delete = $row['img_resource'];
        
            // ลบข้อมูลจากฐานข้อมูล
            $sql_delete = "DELETE FROM carousel_img_slide WHERE img_id = $deleteImgId";
            $connection->query($sql_delete);
        
            // ลบไฟล์จากเครื่อง
            if (file_exists($file_to_delete)) {
                unlink($file_to_delete);
                header('Location: ?page=carousal_slide');
            } else {
                echo "Record deleted successfully, but file not found on the server.";
            }
        }
        $connection->close();
}
?>