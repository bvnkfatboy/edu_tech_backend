
<?php include_once("component/layout/include/sidebar.php") ?>
<style>
    .yorna {
        text-indent: 40px;
    }
</style>

<div class="flex justify-center h-100 w-100 p-4 sm:ml-64 items-center">
    <div class="p-4  mt-14">
        <div class="w-[370px] h-[525px] relative">
            <div class="left-[119px] top-0 absolute text-center text-black text-[40px] font-medium font-['Kanit']">เกี่ยวกับ</div>
            <div class="left-[14px] top-[195px] absolute text-center text-black text-[40px] font-medium font-['Kanit']">หลักการเขียนเว็บไซต์</div>
            <div class="w-[370px] left-0 top-[60px] absolute text-black text-xl font-normal font-['Kanit'] yorna">เว็บไซต์นี้เป็นเว็บไซต์หลังบ้านของเว็บไซต์ <br/>OAR สำนักวิทยบริการ (หอสมุดกลาง) มหาวิทยาลัยอุบลราชธานี ของ ฝ่ายเทคโนโลยี<br/>ทางการศึกษา</div>
            <div class="w-[370px] left-0 top-[255px] absolute text-black text-xl font-normal font-['Kanit'] yorna">เขียนด้วยภาษา PHP แบบ “Single Page Application (SPA)” หรือ หน้าเว็บเดียว โดยใช้ index.php เป็นหน้าหลัก และใช้ switch case หรือ if-else เพื่อตรวจสอบค่า GET parameter เพื่อให้แสดงหน้าที่ถูกต้องโดยใช้ include_once เพื่อเรียกไฟล์ component<br/><br/>โดยส่วนเสริม (framework) ใช้ tailwind css,flowbite (tailwind custom),Ajax</div>
        </div>
    </div>
</div>
