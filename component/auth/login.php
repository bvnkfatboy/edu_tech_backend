<?php
require_once('user.php');
require_once('component/security/data_encpt.php');

$user = new User();
$passwordEncryptor = new PasswordEncryptor();

// Check if user is already logged in
if (isset($_SESSION['acc_id'])) {
    header("Location: ?page=carousal_slide");
    exit();
}

// Process login if form submitted
if (isset($_POST['auth']) && $_POST['auth'] == "login") {
    $username = $user->escape_string($_POST['username']);
    $password = $_POST['password'];
    $auth = $user->checkMember($username, $password);
    if ($auth) {

        // Login successful, redirect to carousal_slide
        $_SESSION['acc_id'] = $auth;
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "แจ้งเตือน",
                    text: "เข้าสู่ระบบเสร็จสิ้น",
                }).then(function(result) {
                    if (result.isConfirmed) {
                        window.location.href = "?page=carousal_slide";
                    }
                });
             </script>';
        exit();
    } else {
        // Show error alert
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "เข้าสู่ระบบผิดพลาด",
                    text: "ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง",
                });
             </script>';
    }
}

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
                ลงชื่อเข้าใช้บัญชีของคุณ
              </h1>
              <form class="space-y-4 md:space-y-6" action="" method="post">
                  <div>
                      <label for="text" class="block mb-2 text-sm font-medium text-gray-900 light:text-white">Your Username</label>
                      <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"  required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 light:text-white">Password</label>
                      <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500" required="">
                  </div>
                  <button type="submit" name="auth" value="login" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center light:bg-primary-600 light:hover:bg-primary-700 light:focus:ring-primary-800">เข้าสู่ระบบ</button>
              </form>
          </div>
      </div>
  </div>
</section>

