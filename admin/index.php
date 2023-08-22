<?php
include 'db_connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit();
}

// Fetch all users from the database
$sql = 'SELECT * FROM user2';
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            text-decoration: none;
        }

        .actions {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <h1>User Management</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
           
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['userid'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
               
                echo '<td class="actions">';
                echo '<a href="edit_user.php?userid=' . $row['userid'] . '">Edit</a> ';
                echo '<a href="delete_user.php?userid=' . $row['userid'] . '">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="4">No users found</td></tr>';
        }
        ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
