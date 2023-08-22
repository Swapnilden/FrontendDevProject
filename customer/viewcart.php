<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <style>
        .card-container
        {
            display:flex;
            flex-wrap:wrap;
            justify-content:flex-start;
            gap:1rem;
        }

        .card {
            width: 19rem;
            margin-right: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
            display:flex;
               }
    

        .card-img-top {
            width: 100%;
            height: 16rem;
            object-fit: cover;
        }

        .card-title {
            margin-bottom: 0.5rem;
        }

        .card-text {
            height: 6rem;
            overflow: hidden;
        }

        .card-body {
            padding: 1rem;
        }

         .AddtoCart-button {
            background-color: #dc3545;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .AddtoCart-button:hover {
            background-color: red;
        }
     </style>
</head>
<body>
    
</body>
</html>
<?php
include_once "../shared/customer-authguard.php";
include "menu.html";
include "../shared/connection.php";
$userid=$_SESSION['userid'];
$total=0;
$result=mysqli_query($conn,"select * from cart join product on cart.pid=product.pid where userid=$userid");
 

    echo "<div class='card-container'>";
while($row=mysqli_fetch_assoc($result))
{   
    $cartid=$row['cartid'];
    $name = $row['name'];
    $price = $row['price'];
    $detail = $row['detail'];
    $imgpath = $row['imgpath'];
     $pid = $row['pid'];
     
     $total=$total+$price;
    echo "<div class='card'>
    <img src='$imgpath' class='card-img-top' alt='...'>
    <div class='card-body'>
      <h5 class='card-title'>$name</h5>
      <h5 class='card-title text-danger'>$price Rs</h5>
      <p class='card-text'>$detail</p>
      <a href='deletecart.php?cartid=$cartid' class='btn AddtoCart-button'>Remove from Cart</a>
    </div>
  </div>";
}
echo "<div>
    <div>Rs $total</div>
    <a href='placeorder.php'>
    <button class='btn btn-success'>Place Order</button>         
     </a>
</div>";
echo "</div>";


?>
