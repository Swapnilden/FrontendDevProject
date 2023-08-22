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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated user information from the form
    $userid = $_POST['userid'];
    $username = $_POST['username'];

    // Update the user in the database
    $sql = "UPDATE user2 SET username='$username' WHERE userid='$userid'";
    $result = $conn->query($sql);

    // Redirect to the user list page
    header('Location: index.php');
    exit();
} else {
    // Retrieve the user ID from the query parameter
    $userid = $_GET['userid'];

    // Fetch the user details from the database
    $sql = "SELECT * FROM user2 WHERE userid='$userid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo 'User not found';
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            margin: 20px auto;
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
        }

        button[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit User</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
