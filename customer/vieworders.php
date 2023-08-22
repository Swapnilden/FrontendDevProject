<?php
include_once "../shared/customer-authguard.php";
include "../shared/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        
        .order-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 1rem;
        }

        .order-card {
            width: 300px;
            background-color: #f5f5f5;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            
           
        }

        .order-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .order-card h4 {
            margin: 10px 0;
        }

        .order-card p {
            margin-bottom: 5px;
        }

        .track-order-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .track-order-button:hover {
            background-color: #c82333;
        }

        .no-orders {
            text-align: center;
            margin-top: 20px;
        }

        .order-card .full-detail {
        display: none;
        margin-top: 10px;
    }

    .order-card .see-more-button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .order-card .see-more-button:hover {
        background-color: #0056b3;
    }
    </style>
</head>
<body>
<script>
    function toggleOrderDetail(button) {
        var orderCard = button.parentNode;
        var orderDetail = orderCard.querySelector('.order-detail');

        if (orderDetail.style.display === 'none' || orderDetail.style.display === '') {
            orderDetail.style.display = 'inline';
            button.textContent = 'See Less';
        } else {
            orderDetail.style.display = 'none';
            button.textContent = 'See More';
        }
    }
</script>
   
    
    
    

    <div class="order-container">
        <?php
        
        // Retrieve orders for the user
        $result = mysqli_query($conn, "SELECT * FROM cart JOIN product ON cart.pid = product.pid WHERE userid = $userid");

        // Check if any orders were found
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cartid = $row['cartid'];
                $name = $row['name'];
                $price = $row['price'];
                $detail = $row['detail'];
                $imgpath = $row['imgpath'];
                $pid = $row['pid'];
                $uploaded_by = $row['uploaded_by'];

                // Insert the order into the "orders" table
                $status = mysqli_query($conn, "insert into orders(cartid,userid, pid, name, price, detail, imgpath, uploaded_by) values($cartid,$userid, $pid, '$name', $price, '$detail', '$imgpath', $uploaded_by)");

                if ($status) {
                   echo "<div class='d-flex flex-wrap'>";
                    echo "<div class='order-card'>";
                    echo "<img src='$imgpath' alt='Product Image'>";
                    echo "<h4>$name</h4>";
                    echo "<p><strong>Price:</strong> $price Rs</p>";
                    echo "<p><strong>Detail:</strong><span class='order-detail'>$detail</span></p>";
                    echo "<p><strong>Uploaded By:</strong> $uploaded_by</p>";
                    echo "<button class='see-more-button btn' onclick='toggleOrderDetail(this)'>See Less</button>";
                    echo "<a href='track_order.php?orderid=$cartid' class='track-order-button'>Track Order</a>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "Error adding $name to Orders.";
                }
            }
        } else {
            echo "<div class='no-orders'>No orders found.</div>";
        }

        
        ?>
        </div>
    </body>
    </html>
       