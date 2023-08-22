<?php
include "../shared/vendor-authguard.php";
include "menu.html";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .upload-form {
            width: 25%;
            background-color: #ffc107;
            padding: 3rem;
            border-radius: 0.5rem;
        }

        .upload-form input[type="text"],
        .upload-form input[type="number"],
        .upload-form textarea {
            background-color: #fff;
            border: none;
            border-radius: 0.25rem;
            padding: 0.75rem;
            margin-top: 0.5rem;
        }

        .upload-form input[type="file"] {
            margin-top: 0.5rem;
            border: none;
            padding: 0.75rem;
            background-color: transparent;
        }

        .upload-form button {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <form enctype="multipart/form-data" method="post" action="upload.php" class="upload-form">
            <input required name="name" type="text" placeholder="Product Name" class="form-control">
            <input required name="price" type="number" placeholder="Product Price" class="form-control mt-2">
            <textarea required class="form-control mt-2" name="detail" cols="30" rows="5" placeholder="Product Details"></textarea>
            <input required name="pdtimg" type="file" class="form-control mt-2" accept=".jpg">
            <div class="text-center">
                <button class="btn btn-danger mt-3">Upload</button>
            </div>
        </form>
    </div>
</body>

</html>
