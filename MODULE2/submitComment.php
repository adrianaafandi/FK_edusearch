<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $discussion_id = $_POST["discussion_id"];
    $comment = $_POST["comment_content"];

    // Store the comment in the database
    $insertQuery = "UPDATE discussion SET discussion_comment = discussion_comment + 1 WHERE discussion_id = '$discussion_id'";
    mysqli_query($link, $insertQuery); // Increment the comment count

    $commentQuery = "INSERT INTO comment (discussion_id, comment_content) VALUES ('$discussion_id', '$comment')";
    mysqli_query($link, $commentQuery); // Insert the new comment

    // Close the database connection
    mysqli_close($link);

    // Send a response back to the client
    echo "Comment stored in the database.";
}
?>