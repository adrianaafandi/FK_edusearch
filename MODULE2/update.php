<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "", "fkedusearch_module2") or die(mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $discussion_id = $_POST["discussion_id"];
    $category_id = $_POST["category_id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $tags = $_POST["tags"];
    $date = $_POST["date"];

    // Construct UPDATE query
    $updateQuery = "UPDATE discussion SET category_id='$category_id', title='$title', content='$content', tags='$tags', date='$date' WHERE discussion_id=$discussion_id";

    // Execute UPDATE query
    if (mysqli_query($link, $updateQuery)) {
        echo "Record updated successfully.";
        header("Location: view.php"); // Redirect to view.php
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($link);
    }
} else {
    echo "Invalid request";
}

// Close the database connection
mysqli_close($link);
?>
