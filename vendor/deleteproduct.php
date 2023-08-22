<?php
 
 $pid=$_GET['pid'];

 include_once "../shared/connection.php";

 $status=mysqli_query($conn,"delete from product where pid=$pid");

 if($status)
 {
    echo "Product deleted Successfully!!";
    header("location:view.php");
 }
 else
 {
    echo "Delete Failed";
    echo mysqli_error($conn);
 }
 ?>