<?php
include_once "../shared/customer-authguard.php";
include "../shared/connection.php";

$result=mysqli_query($conn,"select * from cart join product on cart.pid=product.pid where userid=$userid");
while($row=mysqli_fetch_assoc($result))
{   
    $cartid=$row['cartid'];
    $name = $row['name'];
    $price = $row['price'];
    $detail = $row['detail'];
    $imgpath = $row['imgpath'];
    $pid = $row['pid'];
    $uploaded_by=$row['uploaded_by'];

     $status=mysqli_query($conn,"insert into orders(cartid,userid,pid,name,price,detail,imgpath,uploaded_by) values($cartid,$userid,$pid,'$name',$price,'$detail','$imgpath',$uploaded_by)");
    if($status)
{
    header("location:vieworders.php");
}
}
?>