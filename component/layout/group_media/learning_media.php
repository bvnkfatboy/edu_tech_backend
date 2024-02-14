<?php

require_once('config.php');
$dbConnection = new DbConnection();
$connection = $dbConnection->getConnection();
require_once('component/management/getDelete.php');


// var_dump($_POST);
if (isset($_POST['learning_media']) && $_POST['learning_media'] == "create") {
    $option = $_POST['option-image-category'];
    $option_type = $_POST['option-image-type'];
    $imgonweb = $_POST['imageweb'];
    $mediatitle = $_POST['mediatitle'];
    $medialink = $_POST['medialink'];
    if ($option == 'PC') {

        if (isset($_FILES['imagepc']) && $_FILES['imagepc']['error'] === UPLOAD_ERR_OK) {
            // ตรวจสอบประเภทของไฟล์ (optional)
            $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
            $file_info = pathinfo($_FILES['imagepc']['name']);
            $file_extension = strtolower($file_info['extension']);

            if (in_array($file_extension, $allowed_types)) {

                $upload_dir = 'dist/img/learning_media/';
                $original_file_name = $_FILES['imagepc']['name'];

                $file_extension = pathinfo($original_file_name, PATHINFO_EXTENSION);

                $new_file_name = date('YmdHis') . '.' . $file_extension;
                $upload_file = $upload_dir . $new_file_name;

                // บันทึกไฟล์
                if (move_uploaded_file($_FILES['imagepc']['tmp_name'], $upload_file)) {
                    $upload_url = $myURL.''. $upload_file;
                    $insert_sql = "INSERT INTO group_media (media_title , img_resource, img_source,media_link, media_date,img_location,media_type,`group`) 
                    VALUES ('$mediatitle','$upload_url', 'คอมพิวเตอร์','$medialink', NOW(),'$upload_file','$option_type','learning_media')";
                    if ($connection->query($insert_sql) === TRUE) {
                        // สำเร็จ
                        echo '
                        <script>
                            Swal.fire({
                                    icon: "success",
                                    title: "บันทึกข้อมูลสำเร็จ!",
                                    text: "ข้อมูลถูกบันทึกลงในฐานข้อมูล",
                            }).then(function(result) {
                                    if (result.isConfirmed) {
                                    window.location.href = "?page=learning_media";
                                    }
                            });
                        </script>';
                    } else {
                        // ไม่สำเร็จ
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ข้อผิดพลาด!',
                                    text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                                });
                            </script>";
                    }

                    // ปิดการเชื่อมต่อ
                } else {
                    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด!',
                        text: 'เกิดข้อผิดพลาดในการอัพโหลดไฟล์',
                    });
                  </script>";
                }
            } else {

                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'ข้อผิดพลาด!',
                    text: 'ประเภทไฟล์ไม่ถูกต้อง',
                });
              </script>";
            }
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด!',
                text: 'ไม่มีไฟล์ถูกอัพโหลดหรือเกิดข้อผิดพลาด',
            });
          </script>";
        }
    } else {
        $insert_sql = "INSERT INTO group_media (media_title , img_resource, img_source,media_link, media_date,media_type,`group`) 
        VALUES ('$mediatitle','$imgonweb', 'เว็บไซต์','$medialink', NOW(),'$option_type','learning_media')";
        if ($connection->query($insert_sql) === TRUE) {
            // สำเร็จ
            echo '
            <script>
                Swal.fire({
                        icon: "success",
                        title: "บันทึกข้อมูลสำเร็จ!",
                        text: "ข้อมูลถูกบันทึกลงในฐานข้อมูล",
                }).then(function(result) {
                        if (result.isConfirmed) {
                        window.location.href = "?page=learning_media";
                        }
                });
            </script>';
        } else {
            // ไม่สำเร็จ
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด!',
                        text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                    });
                </script>";
        }
    }
}
if (isset($_GET['delete_img'])) {
    $deleteImgId = $_GET['delete_img'];

    // Assuming you have a column named 'media_id' in your table
    $sql = "SELECT * FROM `group_media` WHERE `media_id` = $deleteImgId AND `group` = 'learning_media'";
    $result = $connection->query($sql);
    $imgRow = $result->fetch_assoc();

    if ($imgRow && isset($imgRow['media_id']) && $imgRow['media_id'] == $deleteImgId) {
        deleteGroupImageAndData($connection, $deleteImgId, 'learning_media');
    }
}
?>


<?php require_once("component/layout/include/sidebar.php") ?>

<div id="imageModal" class="z-50 fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center " onclick="closeModal()">
    <div class="modal-content rounded-lg animate__animated animate__fadeIn" style="max-width:1500px;" onclick="event.stopPropagation()">
        <!-- <span class="absolute top-0 right-0 m-4 text-2xl cursor-pointer" onclick="closeModal()">&times;</span> -->
        <img class="w-full" id="modalImage" alt="" />
    </div>
</div>


<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg light:border-gray-700 mt-14">
        <button data-modal-target="learning_media-create" data-modal-toggle="learning_media-create" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            เพิ่มรูปภาพ
        </button>

        <div class="flex flex-wrap py-5 ">
            <?php $sql = "SELECT * FROM `group_media` WHERE `group` = 'learning_media'";
            $result = $connection->query($sql); ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-3">
                    <a href="#" onclick="openModal('<?php echo $row['img_resource']; ?>')">
                        <img class="rounded-lg img_detail_menu" src="<?php echo $row['img_resource']; ?>" alt="<?php echo $row['media_title']; ?>" />
                    </a>
                    <div class="p-5 ">
                        <div class="mb-3 flex flex-wrap justify-between">
                            <p class=" text-xs text-gray-700 dark:text-gray-400">ชื่อผลงาน: <?php echo $row['media_title']; ?></p>
                            <p class=" text-xs text-gray-700 dark:text-gray-400">ประเภทภาพ: <?php echo $row['media_type']; ?></p>

                        </div>

                        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="openModal('<?php echo $row['img_resource']; ?>')">
                            
                            <div class="pr-1">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                    <defs>
                                        <image width="20" height="20" id="img1" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAAXNSR0IB2cksfwAAAMxQTFRF////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////QQSP0wAAAER0Uk5TADmZwuyYNwaK/f/8hgTJoE8WGFGkg+VBReiAMzu/Qy+ex0dMwQ8a6ecZt0lLtYeuuCD59h93REb7Ax3YF4mS2cPr1s0pdDGZAAAAwElEQVR4nJXQ1xKCMBAF0EgRuYoCih3sir33rv//T4bEGGd8ch+ymzOTye4SQiOmqJqm6nEiw0iYYJFMGcKsNJCxHTebA9LWGz3kC7wqllDmVcVElSbfp0cAs8awDiVKAL/oDBtoSmyhzVBDh/j8d5900WMYwpXYR8hwgKF8PsKY4QRTiTN4DOcLBKIlG8sVb3SNcMOr7U40T/Z0zJztHKIxcTyJhZzFQi5XqXR1N+0ere50/NJP/KMu1R8k7uP5AsufEdYdGtErAAAAAElFTkSuQmCC" />
                                    </defs>
                                    <g id="Interface / Magnifying_Glass_Plus">
                                        <use id="Vector" href="#img1" x="2" y="2" />
                                    </g>
                                </svg>
                            </div>
                            ดูรูปเพิ่มเติม
                        </a>
                        <a href="<?php echo $row['media_link']; ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <div class="pr-1 flex">
                            <svg class="w-5 h-5 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.4 5H5a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2v-6.4a3 3 0 0 1-1.7-1.6l-3 3A3 3 0 1 1 10 9.8l3-3A3 3 0 0 1 11.4 5Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M13.2 4c0-.6.5-1 1-1H20c.6 0 1 .4 1 1v5.8a1 1 0 1 1-2 0V6.4l-6.2 6.2a1 1 0 0 1-1.4-1.4L17.6 5h-3.4a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                            </svg>
                            ลิ้งก์
                            </div>
                        </a>
                        <a href="?page=learning_media&&delete_img=<?php echo $row['media_id']; ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            <div class="pr-1">
                                <svg class="w-5 h-5  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8.6 2.6A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4c0-.5.2-1 .6-1.4ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            ลบ
                        </a>

                    </div>
                </div>
            <?php } 
            $connection->close();
            ?>
        </div>
    </div>
</div>

<!-- learning_media create  -->
<div id="learning_media-create" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full" style="max-width: 35rem;">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    เพิ่มภาพมีเดี่ย
                </h3>
                <button type="button" id="learning_media-create-close" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="learning_media-create">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5 learning_media-create-body" action="" method="post" enctype="multipart/form-data">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2" >
                        <label for="mediatitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อผลงาน <p class="text-xs text-gray-900 dark:text-white">*ไม่ได้แสดงชื่อภาพ แต่จะแสดงใน alt image*</p></label>
                        <input type="text" name="mediatitle" id="mediatitle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required>
                        <label  class="hidden mt-5 flex flex-col items-center justify-center w-full  border-2 border-gray-300 border-dashed rounded-lg  bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6"></div>
                        </label>
                    </div>
                    <div class="col-span-2" >
                        <label for="medialink" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ลิ้งก์เชื่อมโยงไปยังผลงาน<p class="text-xs text-gray-900 dark:text-white">*ไม่มีไม่ต้องใส่ก็ได้*</p></label>
                        <input type="text" name="medialink" id="medialink" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="เช่น https://youtu.be/yw_08bzRXvk?si=-AlbV4w02Dsbsar_" >
                        <label  class="hidden mt-5 flex flex-col items-center justify-center w-full  border-2 border-gray-300 border-dashed rounded-lg  bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6"></div>
                        </label>
                    </div>
                    <div class="col-span-2" id="option-image">
                        <label for="option-image-category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">แหล่งที่มาภาพ</label>
                        <select id="option-image-category" name="option-image-category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                            <option value="WEB">เว็บไซต์</option>
                            <option value="PC" selected>คอม</option>
                        </select>
                    </div>
                    <div class="col-span-2" id="option-type">
                        <label for="option-image-type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ประเภทภาพ</label>
                        <select id="option-image-type" name="option-image-type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="ภาพหลัก" selected>ภาพหลัก</option>
                            <option value="ตัวอย่าง">ตัวอย่างผลงาน</option>
                        </select>
                    </div>
                    <div class="col-span-2" id="option-image-1">
                        <label for="imageweb" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ลิ้งก์แหล่งที่มาภาพ</label>
                        <input type="text" name="imageweb" id="imageweb" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="ป้อนลิ้งก์เว็บรูป เช่น www.oo.com/a.jpg">
                        <label id="imageweb-zone" class="hidden mt-5 flex flex-col items-center justify-center w-full  border-2 border-gray-300 border-dashed rounded-lg  bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6"></div>
                        </label>
                    </div>


                    <div class="col-span-2" id="option-image-2">
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full  border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="main">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>  
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="imagepc" class="hidden" />
                            </label>
                        </div>
                    </div>

                </div>
                <button type="submit" name="learning_media" value="create" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    เพิ่ม
                </button>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropzone = document.getElementById('dropzone-file');
        var main = document.getElementById('main');
        dropzone.addEventListener('change', handleFileSelect);
        var dropzonemainContent;

        function handleFileSelect(event) {
            var files = event.target.files;

            if (files.length > 0) {
                var file = files[0];
                // ตรวจสอบประเภทของไฟล์
                var validExtensions = ['.jpg', '.png', '.jpeg', '.gif'];
                var fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();

                if (validExtensions.indexOf(fileExtension) !== -1) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        dropzonemainContent = main.innerHTML;
                        var preview = document.createElement('img');
                        preview.src = e.target.result;
                        preview.classList.add('w-full', 'object-cover', 'rounded-lg');

                        // ใช้ appendChild เพื่อเพิ่ม Element ลงใน dropzone
                        main.innerHTML = ''; // ลบ Element ที่อาจมีอยู่ใน dropzone ออก
                        main.appendChild(preview);
                        var mainDiv = document.getElementById('main');
                        mainDiv.classList.remove('pt-5', 'pb-6');
                    };

                    reader.readAsDataURL(file);
                } else {
                    // แสดง SweetAlert2 แทน alert
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สามารถอัปโหลดไฟล์',
                        text: 'กรุณาเลือกไฟล์รูปภาพเท่านั้น (.jpg, .jpeg .png, .gif)',
                    });

                    // ลบไฟล์ที่ไม่ถูกต้อง
                    dropzone.value = '';
                }
            }
        }




        var imageCategorySelect = document.getElementById("option-image-category");

        // ดึงอ้างอิงจาก div elements ที่ต้องการจะแสดง/ซ่อน
        var optionImage1 = document.getElementById("option-image-1");
        var optionImage2 = document.getElementById("option-image-2");

        // ตรวจสอบค่าเริ่มต้น
        if (imageCategorySelect.value === "PC") {
            optionImage1.style.display = "none";
            optionImage2.style.display = "block";
        } else {
            optionImage1.style.display = "block";
            optionImage2.style.display = "none";
        }

        // เพิ่ม Event Listener สำหรับการเปลี่ยนแปลงของ select element
        imageCategorySelect.addEventListener("change", function() {
            if (imageCategorySelect.value === "PC") {
                optionImage1.style.display = "none";
                optionImage2.style.display = "block";
            } else {
                optionImage1.style.display = "block";
                optionImage2.style.display = "none";
            }
        });


        const modal = document.getElementById('learning_media-create');
        const closeModalBtn = document.getElementById('learning_media-create-close');

        closeModalBtn.addEventListener('click', () => {
            // ดำเนินการล้างค่าหรือทำอย่างอื่นตามที่คุณต้องการ
            // ตัวอย่าง: ล้างค่า input fields
            const inputFields = document.querySelectorAll('.learning_media-create-body input');
            inputFields.forEach((input) => {
                input.value = '';
            });

            main.innerHTML = dropzonemainContent;
            main.classList.add('pt-5', 'pb-6');
            // ปิด Modal
            modal.classList.remove('open');
        });
    });


    document.getElementById('imageweb').addEventListener('input', function(e) {
        var imageUrl = this.value.trim();
        var imagewebZone = document.getElementById('imageweb-zone');


        if (imageUrl !== '') {

            var supportedExtensions = ['.jpg', '.jpeg', '.png', '.gif'];
            var extension = imageUrl.substring(imageUrl.lastIndexOf('.')).toLowerCase();

            if (supportedExtensions.includes(extension)) {

                imagewebZone.classList.remove('hidden');
                var preview = document.createElement('img');
                preview.src = imageUrl;
                preview.classList.add('w-full', 'object-cover', 'rounded-lg');

                imagewebZone.innerHTML = '';
                imagewebZone.appendChild(preview);
            } else {

                imagewebZone.classList.add('hidden');
            }
        } else {
            imagewebZone.classList.add('hidden');
        }
    });


    function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('animate__animated','animate__fadeIn','animate__faster','hidden');
    }
</script>