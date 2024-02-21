<?php require_once("component/layout/include/sidebar.php") ?>
<?php 
require_once('config.php');
$dbConnection = new DbConnection();
$connection = $dbConnection->getConnection();

if(isset($_GET['article_id'])) {
    $ArticleId = $_GET['article_id'];
    // Sanitize and validate the input
    $ArticleId = mysqli_real_escape_string($connection, $ArticleId);

    $sql = "SELECT * FROM `article` WHERE `article_id` = $ArticleId ";
    $result = $connection->query($sql);
    if($result) {
        $row = $result->fetch_assoc();
        if($row) {
            $articleTitle = $row['article_title'];
            $articleImg = $row['img_location'];
            $articleContent = $row['editor_text'];
            $articleOwn = $row['article_own'];

        } else {
            echo "Article not found";
        }
    } else {
        echo "Error in SQL query: " . $connection->error;
    }
} else {
    echo "Article ID is not set";
}


?>

<style>
    body{
        height: 100vh !important;
    }
</style>

<div id="imageModal" class="z-50 fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center " onclick="closeModal()">
    <div class="modal-content rounded-lg animate__animated animate__fadeIn" style="max-width:1500px;" onclick="event.stopPropagation()">
        <!-- <span class="absolute top-0 right-0 m-4 text-2xl cursor-pointer" onclick="closeModal()">&times;</span> -->
        <img class="w-full" id="modalImage" alt="" />
    </div>
</div>



<div class="flex justify-center h-100 w-100 p-4 sm:ml-64 items-center">
    <div class="p-4  mt-14">
        <div class="w-[800px] h-[525px] relative">
            <div class="top-0 text-black text-[30px] font-medium"><?php echo $articleTitle; ?></div>
            <div class="text-s mb-3">โดย <?php echo  $articleOwn; ?></div>
            <img class="h-auto max-w-full rounded-lg" src="<?php echo$articleImg?>" alt="image description">

            <div class="text-black text-[20px] mt-5 font-medium font-['Kanit']"><?php echo $articleContent; ?></div>
            

            <div class="flex flex-wrap mb-[200px] mt-2">
                <?php
                    $ArticleId = $_GET['article_id'];
                    // Sanitize and validate the input
                    $ArticleId = mysqli_real_escape_string($connection, $ArticleId);
                
                    $sql = "SELECT * FROM `article` WHERE `article_id` = $ArticleId ";
                    $result = $connection->query($sql);
                    if($result) {
                        $row = $result->fetch_assoc();
                        if($row) {
                            $event_img_json = $row['event_img'];
                            $event_images = json_decode($event_img_json, true);
                            $articleTitle = $row['article_title'];
                            // Loop through each image and extract image_dir
                            foreach ($event_images as $image) {
                                $image_dir = $image['image_dir'];
                                echo '<img src="' . $image_dir . '" alt="' . $articleTitle . '" class="max-w-[165px] max-h-[165px] object-cover m-2" onclick="openModal(\'' . $image_dir . '\')"> ';

                            }
                        }
                    }
                
                
                
                ?>
                <!-- <img src="" alt="Image 1" class="max-w-[165px] m-2"> -->
            </div>
            <div class=""> &nbsp;</div>

        </div>
    </div>
</div>


<script>

function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('animate__animated','animate__fadeIn','animate__faster','hidden');
    }

</script>