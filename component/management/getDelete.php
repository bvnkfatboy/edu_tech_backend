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
        $sql = "SELECT img_location FROM carousel_img_slide WHERE img_id = $deleteImgId";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $file_to_delete = $row['img_location'];
        
            // ลบข้อมูลจากฐานข้อมูล
            $sql_delete = "DELETE FROM carousel_img_slide WHERE img_id = $deleteImgId";
            $connection->query($sql_delete);
        
            // ลบไฟล์จากเครื่อง
            if (file_exists($file_to_delete)) {
                unlink($file_to_delete);
                header('Location: ?page=carousal_slide');
            } else {
                header('Location: ?page=carousal_slide');
            }
        }
    case ('gallery'):

        $deleteImgId = $_GET['confirm_delete'];
        // Sanitize and validate the input
        $deleteImgId = mysqli_real_escape_string($connection, $deleteImgId);
        $sql = "SELECT img_location FROM gallery WHERE img_id = $deleteImgId";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $file_to_delete = $row['img_location'];
        
            // ลบข้อมูลจากฐานข้อมูล
            $sql_delete = "DELETE FROM gallery WHERE img_id = $deleteImgId";
            $connection->query($sql_delete);
        
            // ลบไฟล์จากเครื่อง
            if (file_exists($file_to_delete)) {
                unlink($file_to_delete);
                header('Location: ?page=gallery');
            } else {
                header('Location: ?page=gallery');
            }
    }
    case ('article'):

        $deleteImgId = $_GET['confirm_delete'];
        // Sanitize and validate the input
        $deleteImgId = mysqli_real_escape_string($connection, $deleteImgId);
        $sql = "SELECT img_location FROM article WHERE article_id = $deleteImgId";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $file_to_delete = $row['img_location'];
        
            // ลบข้อมูลจากฐานข้อมูล
            $sql_delete = "DELETE FROM article WHERE article_id = $deleteImgId";
            $connection->query($sql_delete);
        
            // ลบไฟล์จากเครื่อง
            if (file_exists($file_to_delete)) {
                unlink($file_to_delete);
                header('Location: ?page=article');
            } else {
                header('Location: ?page=article');
            }
    }
    case ('video'):

        $deleteImgId = $_GET['confirm_delete'];
        // Sanitize and validate the input
        $deleteImgId = mysqli_real_escape_string($connection, $deleteImgId);
        $sql = "SELECT img_location FROM video WHERE video_id = $deleteImgId";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $file_to_delete = $row['img_location'];
        
            // ลบข้อมูลจากฐานข้อมูล
            $sql_delete = "DELETE FROM video WHERE video_id = $deleteImgId";
            $connection->query($sql_delete);
        
            // ลบไฟล์จากเครื่อง
            if (file_exists($file_to_delete)) {
                unlink($file_to_delete);
                header('Location: ?page=video');
            } else {
                header('Location: ?page=video');
            }
    }
    case ('learning_media'):

        $deleteImgId = $_GET['confirm_delete'];
        // Sanitize and validate the input
        $deleteImgId = mysqli_real_escape_string($connection, $deleteImgId);
        $sql = "SELECT img_location FROM learning_media WHERE media_id = $deleteImgId";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $file_to_delete = $row['img_location'];
        
            // ลบข้อมูลจากฐานข้อมูล
            $sql_delete = "DELETE FROM learning_media WHERE media_id = $deleteImgId";
            $connection->query($sql_delete);
        
            // ลบไฟล์จากเครื่อง
            if (file_exists($file_to_delete)) {
                unlink($file_to_delete);
                header('Location: ?page=learning_media');
            } else {
                header('Location: ?page=learning_media');
            }
    }
    case ('request_media'):

        $deleteImgId = $_GET['confirm_delete'];
        // Sanitize and validate the input
        $deleteImgId = mysqli_real_escape_string($connection, $deleteImgId);
        $sql = "SELECT img_location FROM request_media WHERE media_id = $deleteImgId";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $file_to_delete = $row['img_location'];
        
            // ลบข้อมูลจากฐานข้อมูล
            $sql_delete = "DELETE FROM request_media WHERE media_id = $deleteImgId";
            $connection->query($sql_delete);
        
            // ลบไฟล์จากเครื่อง
            if (file_exists($file_to_delete)) {
                unlink($file_to_delete);
                header('Location: ?page=request_media');
            } else {
                header('Location: ?page=request_media');
            }
    }
    case ('evaluate_media'):

        $deleteImgId = $_GET['confirm_delete'];
        // Sanitize and validate the input
        $deleteImgId = mysqli_real_escape_string($connection, $deleteImgId);
        $sql = "SELECT img_location FROM evaluate_media WHERE media_id = $deleteImgId";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $file_to_delete = $row['img_location'];
        
            // ลบข้อมูลจากฐานข้อมูล
            $sql_delete = "DELETE FROM evaluate_media WHERE media_id = $deleteImgId";
            $connection->query($sql_delete);
        
            // ลบไฟล์จากเครื่อง
            if (file_exists($file_to_delete)) {
                unlink($file_to_delete);
                header('Location: ?page=evaluate_media');
            } else {
                header('Location: ?page=evaluate_media');
            }
    }

}
$connection->close();
?>