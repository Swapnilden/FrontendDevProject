<!DOCTYPE html>
<html lang="en">
<head>
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

        .delete-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .delete-button:hover {
            background-color: #c82333;
        }
        .edit-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        transition: background-color 0.3s ease;
        cursor: pointer;
    }

    .edit-button:hover {
        background-color: #0056b3;
    }
    
    </style>
</head>
<body>
    <script>  
function confirmDelete(pid) {
   res = confirm("Are you sure you want to delete?");
   if (res) {
     window.location=`deleteproduct.php?pid=${pid}`;
   } 
}

function editProduct(pid) {
  // Redirect to the edit page with the specific product ID
  window.location = `editproduct.php?pid=${pid}`;
}
        </script>
        

</body>
</html>

<?php
include_once "../shared/vendor-authguard.php";
include "menu.html";

$userid = $_SESSION['userid'];
include_once "../shared/connection.php";

$result = mysqli_query($conn, "select * from product where uploaded_by=$userid");
echo "<div class='card-container'>";
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $price = $row['price'];
    $detail = $row['detail'];
    $imgpath = $row['imgpath'];
     $pid = $row['pid'];
    echo "<div class='card'>
    <img src='$imgpath' class='card-img-top' alt='...'>
    <div class='card-body'>
      <h5 class='card-title'>$name</h5>
      <h5 class='card-title text-danger'>$price Rs</h5>
      <p class='card-text'>$detail</p>
      <div onclick='confirmDelete($pid)' class='btn delete-button'>Delete</div>
      <div class='btn edit-button' onclick='editProduct($pid)'>Edit</div>
    </div>
  </div>";
}
echo "</div>";
?>
