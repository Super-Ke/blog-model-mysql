<?php

date_default_timezone_set("Asia/Shanghai");
//error_reporting(E_ALL || ~E_NOTICE);
//error_reporting(E_ALL ^ E_NOTICE);

$login = false;
session_start();

if ($_SESSION['user']=='admin') {
  $login = true;
}
$table_array = $_SESSION['table_array'];

$host = 'localhost';
$user_name = 'root';
$password = '123456';

$conn = mysqli_connect($host,$user_name,$password);
if (!$conn) {
  # code...
  die('connect error:'.mysqli_error($conn));
}

mysqli_select_db($conn,'blog');


  $table = $_GET['ym'];

  $sql = "select * from `$table`";
  $result = mysqli_query($conn,$sql) or die("error1:".mysqli_error($conn));

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>BLOG</title>
     <link rel="stylesheet" href="style.css" media="screen" title="no title">
   </head>
   <body>
     <div class="containor">
       <div class="header">
         <h1><a href='index.php'>网坛荣耀</a></h1>
       </div>
       <div class="title">
         ----Tennis is fantastic！...
       </div>
       <div class="left">

         <?php
           while ($row = mysqli_fetch_array($result)) {
             # code...
             $entry = $table.$row['id'];
          ?>
         <div class="blog_entry">
           <div class="blog_title">
             <?php echo '<a href="post.php?entry='.$entry.'">'.$row['title'].'</a>'; ?>
           </div>
           <div class="blog_body">
             <div class="blog_date">
               <?php echo '创建时间：'.$row['startdate']; ?>
             </div>
             <?php echo $row['content'] ?>
             <?php echo "<br/>最后修改时间：".$row['changedate']; ?>
           </div>
           <div class="">
             <?php
               if ($login) {
                 # code...
                 echo "<a href='edit.php?entry=".$entry."'>编辑</a>&nbsp;
                 <a href = 'delete.php?entry=".$entry."'>删除</a>";
               }
              ?>
           </div>
         </div>
         <?php } ?>
       </div>
       <div class="right">
         <div class="sidebar">
           <div class="menu_title">
             关于我
           </div>
           <div class="menu_body">
             网球爱好者
             <br/>
             <?php
               if($login){
                 echo "<a href='logout.php'>退出</a>";
               }else {
                 echo "<a href='login.php'>登录</a>";
               }
              ?>
           </div>
         </div>
         <div class="sidebar">
           <div class="menu_title">
             日志归档
           </div>
           <?php
           foreach ($table_array as $each_month) {
            // $str = substr($folder,0,6);//.'-'.substr($folder,4,2);
             echo "<div class='menu_body'><a href= 'archives.php?ym=".$each_month."'>".$each_month."</a></div>";
           }
            ?>
         </div>
       </div>
       <div class="footer">
         CopyRight 2016
       </div>
     </div>
   </body>
 </html>
