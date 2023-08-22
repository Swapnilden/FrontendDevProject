<!DOCTYPE html>
<html lang="en">
<head>
<style>
    .edit-form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 16px;
    }

    .product-image {
        width: 200px;
        display: block;
        margin-bottom: 10px;
    }

    .update-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .update-button:hover {
        background-color: #0056b3;
    }
</style>

</head>
<body>
    
</body>
</html>

<?php
include_once "../shared/vendor-authguard.php";
include "menu.html";

$userid = $_SESSION['userid'];
include_once "../shared/connection.php";

// Check if the product ID is provided in the URL
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    // Fetch the product details from the database
    $result = mysqli_query($conn, "SELECT * FROM product WHERE pid=$pid AND uploaded_by=$userid");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $price = $row['price'];
        $detail = $row['detail'];
        $imgpath = $row['imgpath'];

        // Display the edit form with the pre-filled product details
        echo "
        <h2>Edit Product</h2>
        <form class='edit-form' action='updateproduct.php' method='POST' enctype='multipart/form-data'>
            <input type='hidden' name='pid' value='$pid'>
            <div class='form-group'>
                <label for='name'>Name:</label>
                <input type='text' name='name' value='$name' required>
            </div>
            <div class='form-group'>
                <label for='price'>Price:</label>
                <input type='number' name='price' value='$price' required>
            </div>
            <div class='form-group'>
                <label for='detail'>Detail:</label>
                <textarea name='detail' required>$detail</textarea>
            </div>
            <div class='form-group'>
                <label for='image'>Image:</label>
                <input type='file' name='image'>
            </div>
            <div class='form-group'>
                <img src='$imgpath' alt='Product Image' class='product-image'>
            </div>
            <div class='form-group'>
                <input type='submit' value='Update Product' class='update-button'>
            </div>
        </form>
        ";
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product ID not provided.";
}
?>
