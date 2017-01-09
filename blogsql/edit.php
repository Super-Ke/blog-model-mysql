<?php
  date_default_timezone_set("Asia/Shanghai");

  $host = 'localhost';
  $user_name = 'root';
  $password = '123456';

  $conn = mysqli_connect($host,$user_name,$password);
  if (!$conn) {
    # code...
    die('connect error:'.mysqli_error($conn));
  }

  mysqli_select_db($conn,'blog');


  if (!isset($_POST['title']) || !isset($_POST['content'])) {
    # code...
    $edit = 'origin';

    #读取原始的blog
    if (!isset($_GET['entry'])) {
      # code...
      echo "请求参数错误";
    }

    $table = substr($_GET['entry'],0,6);
    $data_id = substr($_GET['entry'],6);

    $sql = "select * from `$table` where id = $data_id";
    $result = mysqli_query($conn,$sql) or die("error1:".mysqli_error($conn));
    $row = mysqli_fetch_array($result);

  }else {
    # code...提交修改数据后，对源文件进行修改
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['origin_date'];
    $table_name = $_POST['table_name'];
    $data_id = $_POST['id'];
    $date_edit = date("Y-m-d H:i:s",time());
    $entry = $table_name.$data_id;

   $sql = "update `$table_name` set title='$title',content='$content',startdate='$date',changedate='$date_edit' where id=$data_id";

   if(mysqli_query($conn,$sql) or die('error edit:'.mysqli_error($conn))){
     $edit = 'edited';
     //$msg = '日志修改成功，<a href="post.php?entry='.$entry.'">查看该日志</a>';
     $url = "post.php?entry=$entry";
     //header("location:$url");
     header("location:post.php?entry=$entry");

   }

  /*$ym = date('Ym',$date);
  $d = date('d',$date);
  $time = date('His',$date);

  $folder = 'contents/'.$ym;
  $file = $d.'-'.$time.'.txt';
  $filename = $folder.'/'.$file;
  $entry = $ym.'-'.$d.'-'.$time;

  if (!file_exists($folder)) {
    if (!mkdir($folder)) {
      $ok = true;
      $msg = '<font color="red">目录异常，修改日志失败！</font>';
      exit;
    }
  }

  $fp = fopen($filename,'w');
  if ($fp) {
    flock($fp,LOCK_EX);
    $result = fwrite($fp,$blog_str);
    flock($fp,LOCK_UN);
    fclose($fp);
  }

  if (strlen($result)>0) {
    $edit = 'edited';
    //$msg = '日志修改成功，<a href="post.php?entry='.$entry.'">查看该日志</a>';
    $url = "post.php?entry=$entry";
    //header("location:$url");
    header("location:post.php?entry=$entry");
  }*/

  }




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
          <?php if ($edit == 'origin')
          {
            ?>
          <div class="blog_title">
            编辑博客
          </div>
          <div class="blog_body">
            <div class="blog_date">
              <?php echo $row['startdate']; ?>
            </div>

            <table>
              <form class="" action="edit.php" method="post">
                <tr>
                  <td>
                    日志标题
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="text" name="title" value="<?php echo $row['title'] ?>">
                  </td>
                </tr>
                <tr>
                  <td>
                    日志内容：
                  </td>
                </tr>
                <tr>
                  <td>
                    <textarea name="content" rows="8" cols="40"><?php echo $row['content'] ?></textarea>
                  </td>
                </tr>
                <input type="hidden" name="origin_date" value="<?php echo $row['startdate'] ?>">
                <input type="hidden" name="table_name" value="<?php echo $table ?>">
                <input type="hidden" name="id" value="<?php echo $data_id ?>">
                <tr>
                  <td>
                    <input type="submit" name="" value="修改">
                  </td>
                </tr>
              </form>
            </table>
          </div>
          <?php } ?>
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
