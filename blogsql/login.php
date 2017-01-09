<?php
  include 'config/auth.php';
  session_start();
  $login = 'right';

  if(isset($_POST['user'])&&isset($_POST['password'])){
    $user = $_POST['user'];
    $passwd = md5($_POST['password']);

    if ( !($AUTH['user']==$user) || !($AUTH['passwd']==$passwd) ) {
      # code...
      $login = 'wrong';
      $msg = '<strong><span style="color:red;">用户名或密码输入错误！</span></strong>';
    }else {
      $_SESSION['user'] = $user;
      header('location:index.php');
    }
  }
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
            用户登录
          </div>
          <div class="blog_body">
            <table>
              <form class="" action="login.php" method="post">
                <?php
                  if ($login == 'wrong') {
                    echo "$msg";
                  }
                 ?>
                <tr>
                  <td>用户名称：</td><td><input type="text" name="user" value="" autofocus="autofocus"></td>
                </tr>
                <tr>
                  <td>用户密码：</td><td><input type="password" name="password" value=""></td>
                </tr>
                <tr>
                  <td><input type="submit" name="" value="登陆"></td>
                </tr>
              </form>
            </table>
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
