<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 1rem;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 1rem;
        }

        .card {
            width: 19rem;
            margin-right: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border-radius: 0.25rem;
        }

        .card-img-top {
            width: 100%;
            height: 16rem;
            object-fit: cover;
            border-radius: 0.25rem 0.25rem 0 0;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .card-text {
            height: 6rem;
            overflow: hidden;
            color: #555;
        }

        .ratings-reviews {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .ratings-reviews p {
            margin: 0.5rem 0;
            font-size: 0.9rem;
            color: #555;
        }

        .add-review {
            margin-top: 1rem;
        }

        .add-review h6 {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .form-group {
            margin-bottom: 0.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            font-size: 0.9rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
        }

        .form-control textarea {
            height: 6rem;
            resize: vertical;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    include_once "../shared/customer-authguard.php";
    include "menu.html";

    $userid = $_SESSION['userid'];
    include_once "../shared/connection.php";

    $result = mysqli_query($conn, "SELECT p.*, AVG(r.rating) AS avg_rating, COUNT(r.review) AS total_reviews FROM product p LEFT JOIN rating_reviews r ON p.pid = r.product_id GROUP BY p.pid");

    echo "<div class='card-container'>";
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $price = $row['price'];
        $detail = $row['detail'];
        $imgpath = $row['imgpath'];
        $pid = $row['pid'];
        $avgRating = $row['avg_rating'];
        $totalReviews = $row['total_reviews'];

        echo "<div class='card'>
          <img src='$imgpath' class='card-img-top' alt='...'>
          <div class='card-body'>
            <h5 class='card-title'>$name</h5>
            <h5 class='card-title text-danger'>$price Rs</h5>
            <p class='card-text'>$detail</p>
            <div class='ratings-reviews'>
              <p class='card-text'>Average Rating: $avgRating</p>
              <p class='card-text'>Total Reviews: $totalReviews</p>
            </div>
            <div class='add-review'>
              <h6>Add a Review:</h6>
              <form action='submit_review.php' method='POST'>
                <input type='hidden' name='product_id' value='$pid'>
                <div class='form-group'>
                  <label for='rating'>Rating:</label>
                  <select name='rating' id='rating' class='form-control'>
                    <option value='5'>5 stars</option>
                    <option value='4'>4 stars</option>
                    <option value='3'>3 stars</option>
                    <option value='2'>2 stars</option>
                    <option value='1'>1 star</option>
                  </select>
                </div>
                <div class='form-group'>
                  <label for='review'>Review:</label>
                  <textarea name='review' id='review' class='form-control' rows='3'></textarea>
                </div>
                <button type='submit' class='btn btn-primary'>Submit</button>
              </form>
            </div>
            <div class='all-reviews'>
              <h6>All Reviews:</h6>";
              $reviewsResult = mysqli_query($conn, "SELECT * FROM rating_reviews WHERE product_id = $pid");
              while ($reviewRow = mysqli_fetch_assoc($reviewsResult)) {
                $reviewRating = $reviewRow['rating'];
                $reviewText = $reviewRow['review'];
                echo "<div class='review'>
                        <p class='review-rating'>Rating: $reviewRating stars</p>
                        <p class='review-text'>$reviewText</p>
                      </div>";
              }
        echo "</div>
          </div>
        </div>";
    }
    echo "</div>";
    ?>
</body>
</html>
