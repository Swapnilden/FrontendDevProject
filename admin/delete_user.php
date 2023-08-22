<?php include 'db_connect.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve the user ID from the query parameter
    $userid = $_GET['userid'];

    // Delete the user from the database
    $sql = "DELETE FROM user2 WHERE userid='$userid'";
    $result = $conn->query($sql);

    // Redirect to the user list page
    header('location: index.php');
    exit();
} else {
    echo 'Invalid request';
    exit();
}
?>

<?php $conn->close(); ?>
