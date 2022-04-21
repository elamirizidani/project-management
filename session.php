<?php
   include"connect.php";
   session_start();
   $user_check = $_SESSION['login_user'];
   $ses_sql= mysqli_query($con,"select uId,names,username,role from users where username ='$user_check'");
   while($row=mysqli_fetch_array($ses_sql))
   {
   $login_session=$row['username'];
   $login_id = $row['uId'];
   $login_role = $row['role'];
   }
   if(!isset($_SESSION['login_user'])){
      header("location:../index.php");
   }
?>