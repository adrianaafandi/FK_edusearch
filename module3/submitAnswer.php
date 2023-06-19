<?php
// Establish a database connection
$link = mysqli_connect("localhost", "root", "", "fkedusearch", "8111") or die(mysqli_connect_error());
mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $discussion_id = $_POST["discussion_id"];
    $answer = $_POST["answer_content"];

    // Store the answer in the database
    $answerQuery = "INSERT INTO answer (discussion_id, answer_content) VALUES ('$discussion_id', '$answer')";
    mysqli_query($link, $answerQuery); // Insert the new answer
}
?>