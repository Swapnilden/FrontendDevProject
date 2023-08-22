<?php
 $cartid=$_GET['cartid'];
 include "../shared/connection.php";

 $status=mysqli_query($conn,"delete from cart where cartid=$cartid");
 if($status)
 {
    echo "Item removed from cart Successfully!!";
    header("location:viewcart.php");
 }
 else
 {
    echo "Error in removing the cart item!!";
    echo mysqli_error($conn);
 }
?>