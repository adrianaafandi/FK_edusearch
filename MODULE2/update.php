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

    // Prepare the UPDATE statement
    $updateQuery = "UPDATE discussion SET category_id=?, title=?, content=?, tags=?, date=? WHERE discussion_id=?";
    $stmt = mysqli_prepare($link, $updateQuery);
    
    // Bind parameters to the statement
    mysqli_stmt_bind_param($stmt, "issssi", $category_id, $title, $content, $tags, $date, $discussion_id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Record updated successfully.";
        header("Location: view.php"); // Redirect to view.php
        exit();
    } else {
        echo "Error updating record: " . mysqli_stmt_error($stmt);
    }
} else {
    echo "Invalid request";
}

// Close the database connection
mysqli_close($link);
