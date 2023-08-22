
<?php

include "../shared/vendor-authguard.php";

 $userid=$_SESSION['userid'];
 $file_name=$_FILES['pdtimg']['name'];
 $file_path="../shared/images/".$file_name;

 move_uploaded_file($_FILES['pdtimg']['tmp_name'],$file_path);
 $name=$_POST['name'];
 $price=$_POST['price'];
 $detail=$_POST['detail'];

 include_once "../shared/connection.php";

 $status=mysqli_query($conn,"insert into product(name,price,detail,imgpath,uploaded_by) values('$name',$price,'$detail','$file_path',$userid)");

 if($status)
 {
    echo "<div class='uploaded'>Product uploaded Successfully!</div>";
    header("location:view.php");
 }
 else
 {
   echo "Failed to upload<br>";
   echo mysqli_error($conn);
 }
 ?>