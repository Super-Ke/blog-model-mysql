<?php
  date_default_timezone_set("Asia/Shanghai");
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

  /*$sql = "CREATE TABLE if not exists `201111` ( `title` VARCHAR(10) NOT NULL ,
   `content` VARCHAR(30) NOT NULL ,
   `startdate` DATETIME NOT NULL ,
    `changedate` DATETIME NOT NULL ,
     `id` INT NOT NULL )";
  mysqli_query($conn,$sql);*/

  /*$result = mysqli_query($conn,"select * from `201111`")
  $rows = mysqli_fetch_array($result);
  echo "<pre>";
  print_r($rows);
  if ($row) {
    # code...
    echo "exsit";
  }else {
    echo "no";
  }*/


  if (isset($_POST['title'])&&isset($_POST['content'])) {
    $title = $_POST['title'];                    #blog标题
    $content = $_POST['content'];               #blog内容
    $date = date('Y-m-d H:i:s',time());                              #创建时间
    //$date_edit = date('Y-m-d H:i:s',time());                         #最后修改时间
    $date_edit = $date;
    //$blog_str = $title."|".$date."|".$content."|".$date_edit;

  $table = date('Ym',time());

  $sql = "CREATE TABLE if not exists `$table` ( `title` VARCHAR(10) NOT NULL ,
   `content` VARCHAR(30) NOT NULL ,
   `startdate` DATETIME NOT NULL ,
    `changedate` DATETIME NOT NULL ,
     `id` INT NOT NULL auto_increment,
     KEY(id))";
  mysqli_query($conn,$sql) or die("error1:".mysqli_error($conn));

  $sql = "INSERT INTO `$table` (`title`, `content`, `startdate`, `changedate`) VALUES ('$title', '$content', '$date','$date_edit')";
  $result = mysqli_query($conn,$sql) or die("error2:".mysqli_error($conn));

  $sql = "select id from `$table` order by id desc limit 0,1";
  $result = mysqli_query($conn,$sql) or die('error3'.mysqli_error($conn));
  $row = mysqli_fetch_array($result);
  $id = $row['id'];
  //$result = mysqli_query($conn,$sql) or die('error3'.mysqli_error($conn));
  $entry = $table.$id;

  if ($result) {
    # code...
    $ok = true;
    $msg = '日志添加成功，<a href="post.php?entry='.$entry.'">查看该日志</a>';
  }
/*
  $folder = 'contents/'.$ym;
  $file = $d.'-'.$time.'.txt';
  $filename = $folder.'/'.$file;
  $entry = $ym.'-'.$d.'-'.$time;

  if (!file_exists($folder)) {
    if (!mkdir($folder)) {
      $ok = true;
      $msg = '<font color="red">创建目录异常，添加日志失败！</font>';
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
    $ok = true;
    $msg = '日志添加成功，<a href="post.php?entry='.$entry.'">查看该日志</a>';
    //echo "$msg";
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
          <?php
            if ($ok == true) {
              # code...
              echo "$msg";
              echo "<!--";
            }
           ?>
          <div class="blog_title">
            添加一篇新的日志
          </div>
          <div class="blog_body">
            <div class="blog_date">
              <?php echo date('Y-m-d H:i:s'); ?>
            </div>

            <table>
              <form class="" action="add.php" method="post">
                <tr>
                  <td>
                    日志标题
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="text" name="title" value="">
                  </td>
                </tr>
                <tr>
                  <td>
                    日志内容：
                  </td>
                </tr>
                <tr>
                  <td>
                    <textarea name="content" rows="8" cols="40"></textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="submit" name="" value="提交">
                  </td>
                </tr>
              </form>
            </table>
          </div>
          <?php
            if ($ok == true) {
              # code...
              echo "-->";
            }
           ?>
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
