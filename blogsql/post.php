<?php
date_default_timezone_set("Asia/Shanghai");
  #$file_name = 'contents/201601/31-163038.txt';

  if (!isset($_GET['entry'])) {
    # code...
    echo "请求参数错误";
  }
  $table = substr($_GET['entry'],0,6);
  $data_id = substr($_GET['entry'],6);

  $host = 'localhost';
  $user_name = 'root';
  $password = '123456';

  $conn = mysqli_connect($host,$user_name,$password);
  if (!$conn) {
    # code...
    die('connect error:'.mysqli_error($conn));
  }

  mysqli_select_db($conn,'blog');

  $sql = "select * from `$table` where id=$data_id";
  $result = mysqli_query($conn,$sql) or die('error:'.mysqli_error($conn));

  $data = mysqli_fetch_array($result);

  /*echo "<pre>";
  print_r($data);
  echo $data_id;*/


  /*echo "<h1>冠军荣耀</h1>";
  echo '<b>日志标题：</b>'.$content_array[0].'<br />';
  echo "<b>发布时间:</b>".date('Y-m-d H:i:s',$content_array[1]);
  echo "<hr>";
  echo $content_array[2];*/
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>BLOG</title>
     <link rel="stylesheet" href="style.css">
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
             <?php echo $data['title']; ?>
           </div>
           <div class="blog_body">
             <?php
              echo "创建时间：".$data['startdate']."<br/>";
              echo $data['content'];
              echo "<br/>";
              echo "最近修改时间：".$data['changedate'];
              ?>
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
