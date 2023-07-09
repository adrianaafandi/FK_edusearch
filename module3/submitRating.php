<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "", "fkedusearch", "8111") or die(mysqli_connect_error());

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the answer ID and rating from the request
    $answer_id = $_POST['answer_id'];
    $rating_id = $_POST['rating_id'];

    // Perform any necessary validation on the data

    // Insert the rating into the database
    $insertRatingQuery = "INSERT INTO rating (rating_id, answer_id, discussion_id, total_rating) VALUES ('$answer_id', (SELECT discussion_id FROM answer WHERE answer_id = '$answer_id'), '$rating_id')";
    $insertRatingResult = mysqli_query($link, $insertRatingQuery);

    // Check if the rating insertion was successful
    if ($insertRatingResult) {
        // Rating inserted successfully
        echo "Rating submitted successfully!";
    } else {
        // Rating insertion failed
        echo "Failed to submit rating. Please try again.";
    }
}

// Close the database connection
mysqli_close($link);
?>
