<?php
include_once('user.php');
include_once('component/security/data_encpt.php');

$user = new User();
$passwordEncryptor = new PasswordEncryptor();
$dbConnection = new DbConnection();
$connection = $dbConnection->getConnection();
// Check if user is already logged in
// if (isset($_SESSION['acc_id'])) {
//     header("Location: ?page=carousal_slide");
//     exit();
// }

// Process login if form submitted
if (isset($_POST['auth']) && $_POST['auth'] == "edit") {
    $username = $user->escape_string($_POST['username']);
    $fullname = $user->escape_string($_POST['name']);
    $newPassword = $_POST['new_password']; // เพิ่มการรับค่ารหัสผ่านใหม่จากฟอร์ม
    $changePassword = isset($_POST['change_password']); // เพิ่มการตรวจสอบ radio button
    $nochangePassword = isset($_POST['no_change_password']); // เพิ่มการตรวจสอบ radio button

    // ตรวจสอบว่ามีการติกเช็คbox เพื่อต้องการเปลี่ยนรหัสผ่านหรือไม่
    if ($changePassword) {
        // รหัสผ่านถูกต้อง ทำการอัปเดตข้อมูลผู้ใช้
        $updateResult = $user->updateMember($username, $fullname, $newPassword);

        if ($updateResult) {
            // อัปเดตสำเร็จ
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "แจ้งเตือน",
                        text: "อัปเดตข้อมูลเสร็จสิ้น",
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            window.location.href = "?page=carousal_slide";
                        }
                    });
                 </script>';
            exit();
        } else {
            // อัปเดตข้อมูลไม่สำเร็จ
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถอัปเดตข้อมูลได้",
                    });
                 </script>';
        }
    } 
    if($nochangePassword) {
        // ไม่ต้องการเปลี่ยนรหัสผ่าน
        $updateResult = $user->updateMember($username, $fullname, null);

        if ($updateResult) {
            // อัปเดตสำเร็จ
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "แจ้งเตือน",
                        text: "อัปเดตข้อมูลเสร็จสิ้น",
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            window.location.href = "?page=carousal_slide";
                        }
                    });
                 </script>';
            exit();
        } else {
            // อัปเดตข้อมูลไม่สำเร็จ
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถอัปเดตข้อมูลได้",
                    });
                 </script>';
        }
    }
}

?>

<?php
$sql = "SELECT * FROM accounts WHERE acc_id='".$_SESSION['acc_id']."' ";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);
extract($row);

?>

<section class="bg-gray-50 light:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 light:text-white">
          <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
          ระบบหลังบ้าน ฝ่ายเทคโน    
      </a>
      <div class="w-full bg-white rounded-lg shadow light:border md:mt-0 sm:max-w-md xl:p-0 light:bg-gray-800 light:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl light:text-white">
                แก้ไขโปรไฟล์
              </h1>
              <form class="space-y-4 md:space-y-6" action="" method="post">
                  <div>
                      <label for="text" class="block mb-2 text-sm font-medium text-gray-900 light:text-white">ชื่อผู้ใช้งาน</label>
                      <input type="text" value="<?=$acc_user ?>" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"  required="">
                  </div>
                  <div>
                      <label for="text" class="block mb-2 text-sm font-medium text-gray-900 light:text-white">ชื่อ - นามสกุล</label>
                      <input type="text" value="<?=$acc_name ?>" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"  required="">
                  </div>
                  <!-- <div class="flex items-center">
                        <input id="change_password" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="change_password" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">ต้องการเปลี่ยนรหัสผ่านไหม?</label>
                  </div>
                  <div class="flex items-center">
                        <input checked id="no_change_password" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="no_change_password" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">ไม่ต้องการเปลี่ยนรหัสผ่าน</label>
                  </div> -->


                  <div class="flex items-center mb-4">
                        <input id="change_password" type="radio" value="" name="change_password" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="change_password" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">ต้องการเปลี่ยนรหัสผ่านไหม?</label>
                    </div>
                    <div class="flex items-center">
                        <input checked id="no_change_password" type="radio" value="" name="no_change_password" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="no_change_password" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">ไม่ต้องการเปลี่ยนรหัสผ่าน</label>
                    </div>

                  <div id="password_container" style="display:none;">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 light:text-white">รหัสผ่าน</label>
                        <input type="password" value="" name="new_password" id="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500">
                  </div>

                  <button type="submit" name="auth" value="edit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center light:bg-primary-600 light:hover:bg-primary-700 light:focus:ring-primary-800">แก้ไขข้อมูล</button>
                  <a href="?page=carousal_slide" class="w-full block text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5   text-center light:bg-primary-600 light:hover:bg-primary-700 light:focus:ring-primary-800">กลับหน้าแรก</a>
              </form>
          </div>
      </div>
  </div>
</section>

