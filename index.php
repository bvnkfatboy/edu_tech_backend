<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="dist/css/tailwind.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php $output = '<title>%TITLE%</title>'; ?>
</head>
<body class="font-kanit">

    <?php 
      session_start();
      $current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard' ;

      if (!isset($_SESSION['acc_id']) && $current_page !== 'login') {
        echo '
        <script>
        Swal.fire({
          icon: "error",
          title: "แจ้งเตือน",
          text: "คุณยังไม่ได้เข้าสู่ระบบ",
        }).then(function(result) {
            if (result.isConfirmed) {
                window.location.href = "?page=login";
            }
        });
        </script>';
        exit();
      }

      
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
          case ('dashboard'):
            include_once 'component/dashboard.php';
            $title = "Dashboard";
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