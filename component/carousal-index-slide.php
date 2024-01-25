<?php 


$sql = "SELECT * FROM `carousel-img-slide`";
$result = $conn->query($sql);


?>


<?php include_once("component/layout/sidebar.php") ?>

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg light:border-gray-700 mt-14">
        <div class="flex flex-wrap p-3">
            
            <?php while($row = $result->fetch_assoc()) { ?>
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="<?php $row['img_resource'] ?>" alt="" />
                </a>
                <div class="p-5 ">
                    <div class="mb-3 flex flex-wrap justify-between">
                        <p class=" text-xs text-gray-700 dark:text-gray-400">วันที่อัพโหลด: <?php $row['img_regdate'] ?></p>
                        <p class=" text-xs text-gray-700 dark:text-gray-400">แก้ไขเมื่อ: <?php $row['img_update'] ?></p>

                    </div>
                    
                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            ดูรูปเพิ่มเติม
                            <div class="pl-1">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                    <defs>
                                        <image  width="20" height="20" id="img1" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAAXNSR0IB2cksfwAAAMxQTFRF////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////QQSP0wAAAER0Uk5TADmZwuyYNwaK/f/8hgTJoE8WGFGkg+VBReiAMzu/Qy+ex0dMwQ8a6ecZt0lLtYeuuCD59h93REb7Ax3YF4mS2cPr1s0pdDGZAAAAwElEQVR4nJXQ1xKCMBAF0EgRuYoCih3sir33rv//T4bEGGd8ch+ymzOTye4SQiOmqJqm6nEiw0iYYJFMGcKsNJCxHTebA9LWGz3kC7wqllDmVcVElSbfp0cAs8awDiVKAL/oDBtoSmyhzVBDh/j8d5900WMYwpXYR8hwgKF8PsKY4QRTiTN4DOcLBKIlG8sVb3SNcMOr7U40T/Z0zJztHKIxcTyJhZzFQi5XqXR1N+0ere50/NJP/KMu1R8k7uP5AsufEdYdGtErAAAAAElFTkSuQmCC"/>
                                    </defs>
                                    <g id="Interface / Magnifying_Glass_Plus">
                                        <use id="Vector" href="#img1" x="2" y="2"/>
                                    </g>
                                </svg>
                            </div>
                    </a>


                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                        แก้ไข
                        <div class="pl-1">
                            <svg class="w-5 h-5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.3 6.2H5a2 2 0 0 0-2 2V19a2 2 0 0 0 2 2h11c1.1 0 2-1 2-2.1V11l-4 4.2c-.3.3-.7.6-1.2.7l-2.7.6c-1.7.3-3.3-1.3-3-3.1l.6-2.9c.1-.5.4-1 .7-1.3l3-3.1Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M19.8 4.3a2.1 2.1 0 0 0-1-1.1 2 2 0 0 0-2.2.4l-.6.6 2.9 3 .5-.6a2.1 2.1 0 0 0 .6-1.5c0-.2 0-.5-.2-.8Zm-2.4 4.4-2.8-3-4.8 5-.1.3-.7 3c0 .3.3.7.6.6l2.7-.6.3-.1 4.7-5Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </a>

                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        ลบ
                        <div class="pl-1">
                        <svg class="w-5 h-5  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8.6 2.6A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4c0-.5.2-1 .6-1.4ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                        </svg>

                        </div>
                    </a>

                </div>
            </div>
            <?php } ?>
        </div>
   </div>
</div>


