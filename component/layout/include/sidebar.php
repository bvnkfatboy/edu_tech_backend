<?php include_once('config.php'); ?>
<?php
$dbConnection = new DbConnection();
$connection = $dbConnection->getConnection();

include_once('component/management/getCountData.php');
include_once('component/auth/user.php');
$rowCarouseCount = countRows($connection,'carousel_img_slide');
$rowGalleryCount = countRows($connection,'gallery');
$rowArticleCount = countRows($connection,'article');
$rowVideoCount = countRows($connection,'video');

$rowMedia1Count = countGroupRows($connection,'learning_media');
$rowMedia2Count = countGroupRows($connection,'request_media');
$rowMedia3Count = countGroupRows($connection,'evaluate_media');

$rowService1Count = countGroupRows($connection,'product_service');
$rowService2Count = countGroupRows($connection,'room_service');
$rowService3Count = countGroupRows($connection,'services');

$user = new User();

$getAdminName = $user->responDataSQL($connection,'acc_name',$_SESSION['acc_id']);

?>
<nav class="fixed top-0 z-40 w-full bg-white border-b border-gray-200 light:bg-gray-800 light:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 light:text-gray-400 light:hover:bg-gray-700 light:focus:ring-gray-600">
          <span class="sr-only">Open sidebar</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
          </svg>
        </button>
        <a href="?page=dashboard" class="flex ms-2 md:me-24">
          <img src="<?php echo $logo; ?>" class="h-8 me-3" alt="FlowBite Logo" />
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap light:text-white flex items-center">ระบบหลังบ้าน <p class="text-base text-gray-900 dark:text-white ml-3">"เว็บไซต์ฝ่ายเทคโน"</p></span>
        </a>
      </div>
      <div class="flex items-center">
        <button id="theme-toggle" type="button" class="text-gray-500 light:text-gray-400 hover:bg-gray-100 light:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 light:focus:ring-gray-700 rounded-lg text-sm p-2.5">
          <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
          <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>
        <div class="flex items-center ms-3">
          <div>
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 light:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
            </button>
          </div>
          <div class="z-40 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow light:bg-gray-700 light:divide-gray-600" id="dropdown-user">

            <div class="px-4 py-3" role="none">
              <p class="text-sm text-gray-900 light:text-white" role="none">
                <?php echo $getAdminName;?>
              </p>
            </div>
            <ul class="py-1" role="none">
              <li>
                <a href="?page=profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 light:text-gray-300 light:hover:bg-gray-600 light:hover:text-white" role="menuitem">แก้ไขข้อมูล</a>
              </li>
              <li>
                <a href="?page=logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 light:text-gray-300 light:hover:bg-gray-600 light:hover:text-white" role="menuitem">ออกจากระบบ</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-30 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 light:bg-gray-800 light:border-gray-700" aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white light:bg-gray-800">
    <ul class="space-y-2 font-medium">
      <li>
        <a href="?page=dashboard" class="flex items-center p-2 text-gray-900 rounded-lg light:text-white hover:bg-gray-100 light:hover:bg-gray-700 group">
          <svg class="w-5 h-5 text-gray-500 transition duration-75 light:text-gray-400 group-hover:text-gray-900 light:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
          </svg>
          <span class="ms-3">Dashboard</span>
        </a>
      </li>
      <li>

        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-menu-1" data-collapse-toggle="dropdown-menu-1">
          <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M3 6c0-1.1.9-2 2-2h5.5a2 2 0 0 1 1.6.7L14 7H3V6Zm0 3v10c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V9H3Z" clip-rule="evenodd" />
          </svg>

          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">หน้าแรก</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </button>
        <ul id="dropdown-menu-1" class="hidden py-2 space-y-2">
          <li>
            <a href="?page=carousal_slide" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="flex-1 ms-3 whitespace-nowrap">รูป Banner slide</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full light:bg-blue-900 light:text-blue-300"><?php echo $rowCarouseCount; ?></span>
            </a>
          </li>
          <li>
            <a href="?page=gallery" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="flex-1 ms-3 whitespace-nowrap">คลังภาพ</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full light:bg-blue-900 light:text-blue-300"><?php echo $rowGalleryCount; ?></span>
            </a>
          </li>
          <li>
            <a href="?page=article" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="flex-1 ms-3 whitespace-nowrap">บทความ</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full light:bg-blue-900 light:text-blue-300"><?php echo $rowArticleCount; ?></span>
            </a>
          </li>
          <li>
            <a href="?page=video" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="flex-1 ms-3 whitespace-nowrap">Video</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full light:bg-blue-900 light:text-blue-300"><?php echo $rowVideoCount; ?></span>
            </a>
          </li>
        </ul>
        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-menu-2" data-collapse-toggle="dropdown-menu-2">
          <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M3 6c0-1.1.9-2 2-2h5.5a2 2 0 0 1 1.6.7L14 7H3V6Zm0 3v10c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V9H3Z" clip-rule="evenodd" />
          </svg>

          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">หน้าพัฒนาสื่อ</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </button>
        <ul id="dropdown-menu-2" class="hidden py-2 space-y-2">
          <li>
            <a href="?page=learning_media" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="flex-1 ms-3 whitespace-nowrap">ผลิตสื่อการเรียนรู้</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full light:bg-blue-900 light:text-blue-300"><?php echo $rowMedia1Count; ?></span>
            </a>
          </li>
          <li>
            <a href="?page=request_media" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="flex-1 ms-3 whitespace-nowrap">ผลิตสื่อตามร้องขอ</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full light:bg-blue-900 light:text-blue-300"><?php echo $rowMedia2Count; ?></span>
            </a>
          </li>
          <li>
            <a href="?page=evaluate_media" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="flex-1 ms-3 whitespace-nowrap">ประเมินผลสื่อ</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full light:bg-blue-900 light:text-blue-300"><?php echo $rowMedia3Count; ?></span>
            </a>
          </li>

        </ul>

        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-menu-3" data-collapse-toggle="dropdown-menu-3">
          <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M3 6c0-1.1.9-2 2-2h5.5a2 2 0 0 1 1.6.7L14 7H3V6Zm0 3v10c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V9H3Z" clip-rule="evenodd" />
          </svg>

          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">หน้าโสตทัศนูปกรณ์</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </button>
        <ul id="dropdown-menu-3" class="hidden py-2 space-y-2">
          <li>
            <a href="?page=product_service" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="flex-1 ms-3 whitespace-nowrap">บริการติดตั้ง</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full light:bg-blue-900 light:text-blue-300"><?php echo $rowService1Count; ?></span>
            </a>
          </li>
          <li>
            <a href="?page=room_service" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="flex-1 ms-3 whitespace-nowrap">บริการห้อง</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full light:bg-blue-900 light:text-blue-300"><?php echo $rowService2Count; ?></span>
            </a>
          </li>
          <li>
            <a href="?page=service" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="flex-1 ms-3 whitespace-nowrap">ซ่อมบำรุง</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full light:bg-blue-900 light:text-blue-300"><?php echo $rowService3Count; ?></span>
            </a>
          </li>

        </ul>

      </li>


    </ul>
  </div>
</aside>




<script>
document.addEventListener("DOMContentLoaded", function() {
  // Find all dropdown menu elements
  var dropdownMenus = document.querySelectorAll("[id^='dropdown-menu-']");

  // Loop through each dropdown menu
  dropdownMenus.forEach(function(dropdownMenu) {
    // Check if the dropdown state is stored in localStorage
    var dropdownId = dropdownMenu.id;
    var isDropdownOpen = localStorage.getItem(dropdownId + "-dropdownOpen");

    // If the dropdown state is 'open', remove the 'hidden' class
    if (isDropdownOpen === "open") {
      dropdownMenu.classList.remove("hidden");
    }

    // Toggle the dropdown state when the button is clicked
    document.querySelector("[data-collapse-toggle='" + dropdownId + "']").addEventListener("click", function() {
      if (dropdownMenu.classList.contains("hidden")) {
        // Close all other dropdown menus
        dropdownMenus.forEach(function(menu) {
          if (!menu.classList.contains("hidden")) {
            menu.classList.add("hidden");
            localStorage.setItem(menu.id + "-dropdownOpen", "closed");
          }
        });

        dropdownMenu.classList.remove("hidden");
        localStorage.setItem(dropdownId + "-dropdownOpen", "open");
      } else {
        dropdownMenu.classList.add("hidden");
        localStorage.setItem(dropdownId + "-dropdownOpen", "closed");
      }
    });
  });
});


</script>
