<?php
include_once "../shared/customer-authguard.php";
include "../shared/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .order-details {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .order-details h2 {
            margin-bottom: 20px;
        }

        .order-details p {
            margin-bottom: 10px;
        }

        .order-details img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .order-details .status {
            margin-top: 20px;
            font-weight: bold;
        }

        .order-details .status .shipped {
            color: green;
        }

        .order-details .status .in-progress {
            color: orange;
        }

        .order-details .tracking-info {
            margin-top: 20px;
            font-weight: bold;
        }

        .order-details .tracking-info p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <?php
    // Get the order ID from the query parameter
    if (isset($_GET['orderid'])) {
        $orderid = $_GET['orderid'];

        // Retrieve order details from the "orders" table
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE cartid = $orderid");

        if (mysqli_num_rows($result) > 0) {
            // Fetch the order details
            $order = mysqli_fetch_assoc($result);

            echo "<div class='order-details'>";
            echo "<h2>Order Details</h2>";
            echo "<p><strong>Order ID:</strong> " . $order['cartid'] . "</p>";
            echo "<p><strong>Name:</strong> " . $order['name'] . "</p>";
            echo "<p><strong>Price:</strong> " . $order['price'] . "</p>";
            echo "<p><strong>Detail:</strong> " . $order['detail'] . "</p>";
            echo "<img src='" . $order['imgpath'] . "' alt='Product Image'>";
            echo "<p><strong>Uploaded By:</strong> " . $order['uploaded_by'] . "</p>";

            // Additional tracking functionality
            echo "<div class='status'>";
            echo "<p>Status: ";

            if ($order['shipped'] == 1) {
                echo "<span class='shipped'>Shipped</span></p>";
                echo "<div class='tracking-info'>";
                echo "<p>Tracking Number: " . $order['tracking_number'] . "</p>";
                echo "</div>";
            } else {
                echo "<span class='in-progress'>In progress</span></p>";
                echo "<div class='tracking-info'>";
                echo "<p>Estimated Delivery Date: " . $order['estimated_delivery_date'] . "</p>";

                // Simulating order shipping and updating tracking information
                $trackingNumber = "XYZ123"; // Assign a tracking number here
                $estimatedDeliveryDate = "2023-06-30"; // Assign an estimated delivery date here

                // Update the "orders" table with the tracking information
                $updateQuery = "UPDATE orders SET shipped = 1, tracking_number = '$trackingNumber', estimated_delivery_date = '$estimatedDeliveryDate' WHERE cartid = $orderid";
                mysqli_query($conn, $updateQuery);

                echo "<p>Order has been shipped. Tracking information will be available soon.</p>";
                echo "</div>";
            }

            echo "</div>"; // Close status div
            echo "</div>"; // Close order-details div
        } else {
            echo "Order not found.";
        }
    } else {
        echo "Invalid order ID.";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
