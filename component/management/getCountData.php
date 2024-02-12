<?php 


function countRows($mysqli, $table) {
    $query = "SELECT * FROM $table";

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

function countGroupRows($mysqli, $group) {
    // ใช้ backtick (`) เพื่อคลุมชื่อคอลัมน์ที่มีชื่อเป็นคำสงวน
    $query = "SELECT * FROM `group_media` WHERE `group` = ?";

    // สร้าง statement
    $statement = $mysqli->prepare($query);

    // ตรวจสอบว่าสร้าง statement สำเร็จหรือไม่
    if ($statement) {
        // ผูกค่า parameter
        $statement->bind_param("s", $group);

        // execute query
        $statement->execute();

        // เก็บผลลัพธ์
        $result = $statement->get_result();

        // นับจำนวนแถวทั้งหมดในผลลัพธ์
        $rowCount = $result->num_rows;

        // ปิด statement
        $statement->close();

        // ส่งค่าจำนวนแถวกลับ
        return $rowCount;
    } else {
        // กรณีเกิดข้อผิดพลาดในการสร้าง statement
        return -1;
    }
}




?>