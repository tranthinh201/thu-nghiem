<?php
session_start();
if (isset($_SESSION['user'])) {
  // code...
  header('location:home.php');
}

if (isset($_POST['submit']) && $_POST['username'] != '' && $_POST['password'] != '') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  require_once '../config/sql_cn.php';
  $sql = "select * from useradmin where username='$username' and password='$password'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {

    $_SESSION['user'] = $username;
    header("location:home.php");
  } else {
    $_SESSION['thongbao'] = "sai ten dang nhap hoac mat khau!";
    header("location:login.php");
  }
  $conn->close();
} else {
  $_SESSION['thongbao'] = "vui long` nhap day du thong tin!";
  header("location:login.php");
}
