<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "", "fkedusearch", "8111") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

// Check if the answer_id is provided via POST
if (!isset($_POST['answer_id'])) {
    echo "Error: Answer ID not provided";
    exit;
}

$answer_id = $_POST['answer_id'];

// Disable foreign key checks temporarily
mysqli_query($link, "SET FOREIGN_KEY_CHECKS = 0");

// Delete the answer from the database
$query = "DELETE FROM answer WHERE answer_id = $answer_id";
$result = mysqli_query($link, $query);

// Check if the deletion was successful
if ($result && mysqli_affected_rows($link) > 0) {
    echo "Answer deleted successfully";
} else {
    echo "Error deleting answer: " . mysqli_error($link);
}

// Enable foreign key checks again
mysqli_query($link, "SET FOREIGN_KEY_CHECKS = 1");

// Close the database connection
mysqli_close($link);
?>
