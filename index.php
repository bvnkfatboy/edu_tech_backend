<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="dist/css/tailwind.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <?php $output = '<title>%TITLE%</title>'; ?>
</head>

<body class="font-kanit">

  <?php
  session_start();

  $current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
  // if (!isset($_SESSION['acc_id']) && $_GET['page'] !== 'login') {
  //   echo '
  //   <script>
  //     Swal.fire({
  //         icon: "error",
  //         title: "คุณยังไม่ได้เข้าสู่ระบบ",
  //         text: "คุณจะถูกเปลี่ยนเส้นทางภายใน 2 วินาที",
  //     }).then(function() {
  //         // นับเวลาถอยหลังและ Redirect ไปที่หน้าอื่น
  //         var countdown = 0;
  //         var countdownInterval = setInterval(function() {
  //             countdown--;
  //             if (countdown <= 0) {
  //                 clearInterval(countdownInterval);
  //                 window.location.href = "?page=login";
  //             }
  //         }, 1000);
  //     });
  //   </script>';
  //   exit();
  // }


  switch ($current_page) {
    case ('login'):
      include_once 'component/auth/login.php';
      $title = "เข้าสู่ระบบ";
      $output = str_replace('%TITLE%', $title, $output);
      echo $output;
      break;
    case ('logout'):
      include_once 'component/auth/logout.php';
      $title = "เข้าสู่ระบบ";
      $output = str_replace('%TITLE%', $title, $output);
      echo $output;
      break;
    case ('member'):
      include_once 'component/management/member.php';
      $title = "Member";
      $output = str_replace('%TITLE%', $title, $output);
      echo $output;
      break;

    case ('dashboard'):
      include_once 'component/dashboard.php';
      $title = "Dashboard";
      $output = str_replace('%TITLE%', $title, $output);
      echo $output;
      break;
    case ('carousal_slide'):
      include_once 'component/carousal_index_slide.php';
      $title = "Carousal Index Slide";
      $output = str_replace('%TITLE%', $title, $output);
      echo $output;
      break;
      
    case ('gallery'):
      include_once 'component/image_gallery.php';
      $title = "Image gallery";
      $output = str_replace('%TITLE%', $title, $output);
      echo $output;
      break;
    case ('article'):
      include_once 'component/article.php';
      $title = "Article";
      $output = str_replace('%TITLE%', $title, $output);
      echo $output;
      break;
    case ('video'):
      include_once 'component/video.php';
      $title = "Video";
      $output = str_replace('%TITLE%', $title, $output);
      echo $output;
      break;

    case ('delete'):
      include_once 'component/management/getDelete.php';
      $title = "DELETE";
      $output = str_replace('%TITLE%', $title, $output);
      echo $output;
      break;



    default:
      // include_once 'error404.php';
      $title = "ERROR PAGE";
      $output = str_replace('%TITLE%', $title, $output);
      echo $output;
  }
  ?>

  <script src="tailwind.config.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>