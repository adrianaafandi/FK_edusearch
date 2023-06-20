<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "", "fkedusearch", "8111") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

// Check if the discussion_id is provided via POST
if (!isset($_POST['discussion_id'])) {
    echo "Error: Discussion ID not provided";
    exit;
}

$discussion_id = $_POST['discussion_id'];

// Disable foreign key checks temporarily
mysqli_query($link, "SET FOREIGN_KEY_CHECKS = 0");

// Delete the post from the database
$query = "DELETE FROM discussion WHERE discussion_id = $discussion_id";
$result = mysqli_query($link, $query);

// Check if the deletion was successful
if ($result && mysqli_affected_rows($link) > 0) {
    echo "Post deleted successfully";
} else {
    echo "Error deleting post: " . mysqli_error($link);
}

// Enable foreign key checks again
mysqli_query($link, "SET FOREIGN_KEY_CHECKS = 1");

// Close the database connection
mysqli_close($link);
?>




