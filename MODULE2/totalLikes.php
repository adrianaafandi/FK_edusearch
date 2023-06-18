<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['like']) && isset($_POST['discussion_id'])) {
    // Connect to the database server.
    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

    // Select the database.
    mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

    $discussion_id = $_POST['discussion_id'];

    // Update the like count in the database
    $updateQuery = "UPDATE discussion SET discussion_like = discussion_like + 1 WHERE discussion_id = '$discussion_id'";
    mysqli_query($link, $updateQuery);

    // Fetch the updated like count from the database
    $likeCountQuery = "SELECT discussion_like FROM discussion WHERE discussion_id = '$discussion_id'";
    $likeCountResult = mysqli_query($link, $likeCountQuery);
    $likeCountRow = mysqli_fetch_assoc($likeCountResult);
    $likeCount = $likeCountRow['discussion_like'];

    // Return the updated like count as a response
    echo $likeCount;
}
?>
