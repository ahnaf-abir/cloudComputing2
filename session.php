<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_userId'];
   
   $ses_sql = mysqli_query($db,"select userId from userInfo where userId = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['userId'];
   
   if(!isset($_SESSION['login_userId'])){
      header("location: login.php");
   }
?>