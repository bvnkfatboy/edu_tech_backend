<?php 


function countCarouselRows($mysqli) {
    $query = "SELECT * FROM carousel_img_slide";

    // ทำการ execute query
    $result = $mysqli->query($query);

    // เช็คว่า query ทำงานสำเร็จหรือไม่
    if ($result) {
        // นับจำนวนแถวทั้งหมดในผลลัพธ์
        $rowCount = mysqli_num_rows($result);

        // ปิด result set เพื่อปล่อยทรัพยากร
        mysqli_free_result($result);

        // ส่งค่าจำนวนแถวกลับ
        return $rowCount;
    } else {
        // กรณีเกิดข้อผิดพลาดในการ execute query
        return -1;
    }
}

function countGalleryRows($mysqli) {

    $query = "SELECT * FROM gallery";

    // ทำการ execute query
    $result = $mysqli->query($query);

    // เช็คว่า query ทำงานสำเร็จหรือไม่
    if ($result) {
        // นับจำนวนแถวทั้งหมดในผลลัพธ์
        $rowCount = mysqli_num_rows($result);

        // ปิด result set เพื่อปล่อยทรัพยากร
        mysqli_free_result($result);

        // ส่งค่าจำนวนแถวกลับ
        return $rowCount;
    } else {
        // กรณีเกิดข้อผิดพลาดในการ execute query
        return -1;
    }
}
function countArticleRows($mysqli) {

    $query = "SELECT * FROM article";

    // ทำการ execute query
    $result = $mysqli->query($query);

    // เช็คว่า query ทำงานสำเร็จหรือไม่
    if ($result) {
        // นับจำนวนแถวทั้งหมดในผลลัพธ์
        $rowCount = mysqli_num_rows($result);

        // ปิด result set เพื่อปล่อยทรัพยากร
        mysqli_free_result($result);

        // ส่งค่าจำนวนแถวกลับ
        return $rowCount;
    } else {
        // กรณีเกิดข้อผิดพลาดในการ execute query
        return -1;
    }
}
function countVideoRows($mysqli) {

    $query = "SELECT * FROM video";

    // ทำการ execute query
    $result = $mysqli->query($query);

    // เช็คว่า query ทำงานสำเร็จหรือไม่
    if ($result) {
        // นับจำนวนแถวทั้งหมดในผลลัพธ์
        $rowCount = mysqli_num_rows($result);

        // ปิด result set เพื่อปล่อยทรัพยากร
        mysqli_free_result($result);

        // ส่งค่าจำนวนแถวกลับ
        return $rowCount;
    } else {
        // กรณีเกิดข้อผิดพลาดในการ execute query
        return -1;
    }
}



?>