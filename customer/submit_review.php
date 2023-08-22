<?php
include_once "../shared/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted form data
  $product_id = $_POST['product_id'];
  $rating = $_POST['rating'];
  $review = $_POST['review'];

  // Validate the form data (you can add your own validation logic here)

  // Insert the review into the database
  $query = "insert into rating_reviews (product_id, rating, review)  values('$product_id', '$rating', '$review')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Review submitted successfully
    echo "Review submitted successfully.";
  } else {
    // Failed to submit the review
    echo "Failed to submit the review.";
  }
} else {
  // Invalid request method
  echo "Invalid request method.";
}
?>
