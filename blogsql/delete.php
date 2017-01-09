<?php
  $ok = false;

  $host = 'localhost';
  $user_name = 'root';
  $password = '123456';

  $conn = mysqli_connect($host,$user_name,$password);
  if (!$conn) {
    # code...
    die('connect error:'.mysqli_error($conn));
  }

  mysqli_select_db($conn,'blog');


 if (!isset($_GET['entry'])) {
   # code...
   $str = $_POST['id'];

   $table = substr($str,0,6);
   $data_id = substr($str,6);

   $sql = "delete from `$table` where id=$data_id";

   if(mysqli_query($conn,$sql)){
     $ok = true;
   }else {
     echo "找不见文件";
   }
 }

   /*$file_name = 'contents/'.substr($str,0,6).'/'.substr($str,7,9).'.txt';

   if (file_exists($file_name)) {
     if (unlink($file_name)) {
       $ok = true;
     }
   }else {
     echo "找不到文件";
   }
 }else {
   //$msg = "<input type="hidden" name="id" value="$_GET['entry']">"
 }*/
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
         <div class="blog_entry">
           <div class="blog_title">
             删除blog
           </div>
           <div class="blog_body">
             <?php if($ok === false){ ?>
               <form class="" action="delete.php" method="post">
                 <p style="color:red;">删除的blog无法恢复，您确定要删除此blog吗？</p>
                 <input type="submit" name="" value="删除">
                 <input type="hidden" name="id" value="<?php echo $_GET['entry'] ?>">
               </form>

             <?php } ?>
             <?php if ($ok === true) {
               echo "<p>您已成功删除该文件。</p>";
             } ?>
           </div>
         </div>
       </div>
       <div class="right">
         <div class="sidebar">
           <div class="menu_title">
             关于我
           </div>
           <div class="menu_body">
             网球爱好者
           </div>
         </div>
       </div>
       <div class="footer">
         CopyRight 2016
       </div>
     </div>
   </body>
 </html>
