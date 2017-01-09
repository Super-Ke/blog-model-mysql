<?php
  session_start();

  if (isset($_SESSION['user'])) {
    # code...
    $_SESSION['user'] = '';
    header('location:index.php');
  }else {
    # code...
  }
 ?>
