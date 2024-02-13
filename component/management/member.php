<?php 
include_once('config.php');
include_once('component/auth/user.php');
include_once('component/security/data_encpt.php');

$user = new User();
$passwordEncryptor = new PasswordEncryptor();
$dbConnection = new DbConnection();
$connection = $dbConnection->getConnection();



if (isset($_POST['auth']) && $_POST['auth'] == "create") {
   $username = $user->escape_string($_POST['username']);
   $password = $user->escape_string($_POST['password']);
   $name     = $user->escape_string($_POST['name']);

   $checkUsesMember = $user->checkUsesMember($username);
   if(!$checkUsesMember){
      $insert = $user->createUser($username,$passwordEncryptor->encryptPassword($password),$name);
      if($insert){
      echo '
         <script>
            Swal.fire({
                  icon: "success",
                  title: "แจ้งเตือน",
                  text: "เพิ่มผู้ใช้งานเรียบร้อยแล้ว",
            }).then(function(result) {
                  if (result.isConfirmed) {
                     window.location.href = "?page=member";
                  }
            });
         </script>';
      }
   }else{
      echo '<script>
               Swal.fire({
                  icon: "error",
                  title: "แจ้งเตือน",
                  text: "ชื่อผู้ใช้ซ้ำ",
               });
            </script>';
   }
}






?>










<?php include_once("component/layout/include/sidebar.php") ?>

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg light:border-gray-700 mt-14">



      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
         <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white light:bg-gray-900">
            <div>
               <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 light:bg-green-600 light:hover:bg-green-700 light:focus:ring-green-800" type="button">
               เพิ่มผู้ใช้งาน
               </button>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
               <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500 light:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                  </svg>
               </div>
               <input type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500" placeholder="Search for users">
            </div>
         </div>
         <table class="w-full text-sm text-left rtl:text-right text-gray-500 light:text-gray-400">
            <thead class=" text-gray-700 uppercase bg-gray-50 light:bg-gray-700 light:text-gray-400">
               <tr>
                  <th scope="col" class="p-4 px-6 py-3">
                     ชื่อ - สกุล
                  </th>
                  <th scope="col" class="px-6 py-3">
                     จัดการ
                  </th>
               </tr>
            </thead>
            <tbody>
               <?php 
               $result = mysqli_query($connection,"SELECT * FROM accounts ORDER BY acc_id asc");
               while($row = mysqli_fetch_array($result)){
                  
                  echo '
                  <tr class="bg-white border-b light:bg-gray-800 light:border-gray-700 hover:bg-gray-50 light:hover:bg-gray-600">
                     <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap light:text-white">
                        <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                        <div class="ps-3">
                           <div class="text-base font-semibold">'.$row['acc_name'].'</div>
                        </div>
                     </th>
                     <td class="px-6 py-4">
                        <a  href="?page=memberProfile&&memberID='.base64_encode($row['acc_id']).'" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 light:bg-green-600 light:hover:bg-green-700 light:focus:ring-green-800" type="button">
                        แก้ไขข้อมูล
                        </a>
                     </td>
                  </tr>
               ';} ?>
            </tbody>
         </table>
      </div>
   </div>
</div>


<!-- Main modal -->
<div id="authentication-modal" tabindex="10" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow light:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t light:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 light:text-white">
                     เพิ่มผู้ใช้งาน
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center light:hover:bg-gray-600 light:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="" method="post">
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 light:text-white">ชื่อผู้ใช้งาน</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-600 light:border-gray-500 light:placeholder-gray-400 light:text-white" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 light:text-white">รหัสผ่าน</label>
                        <input type="password" name="password" id="password"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-600 light:border-gray-500 light:placeholder-gray-400 light:text-white" required>
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 light:text-white">ชื่อ - นามสกุล</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 light:bg-gray-600 light:border-gray-500 light:placeholder-gray-400 light:text-white" required>
                    </div>
                    <button type="submit" name="auth" value="create" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center light:bg-blue-600 light:hover:bg-blue-700 light:focus:ring-blue-800">เพิ่มผู้ใช้งาน</button>
                </form>
            </div>
        </div>
    </div>
</div> 
