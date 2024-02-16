<?php
require_once('config.php');
$dbConnection = new DbConnection();
$connection = $dbConnection->getConnection();

$delete = isset($_GET['deletetype']) ? $_GET['deletetype'] : '';
$group = isset($_GET['group']) ? $_GET['group'] : '';


function deleteGroupImageAndData($connection, $deleteImgId, $group)
{
    // Sanitize and validate the input
    $deleteImgId = mysqli_real_escape_string($connection, $deleteImgId);

    $sql = "SELECT img_location FROM `group_media` WHERE media_id = $deleteImgId AND `group` = '$group'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_to_delete = $row['img_location'];

        // ลบข้อมูลจากฐานข้อมูล
        $sql_delete = "DELETE FROM `group_media` WHERE media_id = $deleteImgId AND `group` = '$group'";
        $connection->query($sql_delete);

        // ลบไฟล์จากเครื่อง
        if (file_exists($file_to_delete)) {
            unlink($file_to_delete);
        }
        header('Location: ?page=' . urlencode($group)); // แก้ไขการส่งค่า $group ด้วย urlencode เพื่อป้องกันปัญหา URL encoding
        exit; // ออกจากสคริปต์เพื่อป้องกันการทำงานเพิ่มเติมหลังจากการ redirect
    } else {
        // ไม่พบข้อมูล กลับไปที่หน้าเดิม
        header('Location: ?page=' . urlencode($group));
        exit;
    }
}

switch ($delete) {
    case 'carousal_img':
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
            }
        }
        header('Location: ?page=carousal_slide');
        break;
    case 'gallery':
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
            }
        }
        header('Location: ?page=gallery');
        break;
    case 'article':
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
            }
        }
        header('Location: ?page=article');
        break;
    case 'video':
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
            }
        }
        header('Location: ?page=video');
        break;
    default:
        // กรณีไม่มีการระบุเงื่อนไขตรงกับ case ใด ๆ
        // คุณอาจต้องกำหนดการกระทำเพิ่มเติมที่นี่หากต้องการ
        break;
}
