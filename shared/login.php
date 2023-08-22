<?php
session_start();
$_SESSION['login_status']=false;
$uname=$_POST['username'];
$upass=$_POST['password'];

$login_cipher_text=md5($upass);

include_once "../shared/connection.php";
$result=mysqli_query($conn,"select * from user2 where username='$uname' and password='$login_cipher_text'");
$row_count=mysqli_num_rows($result);

if($row_count==0)
{
    echo "Invalid Credenials";
}
else
{
  $_SESSION['login_status']=true;
  $row=mysqli_fetch_assoc($result);

  $_SESSION['username']=$row['username'];
  $_SESSION['userid']=$row['userid'];
  $_SESSION['usertype']=$row['usertype'];
  if($row['usertype']=="vendor"){
  header("location:../vendor/view.php");
  }
  else if($row['usertype']=="customer"){
    header("location:../customer/home.php");
    }
  
}
?>