<?php
// Check if the report_id and status parameters are provided
if (isset($_GET['report_id']) && isset($_GET['status'])) {
    // Get the report_id and status from the URL parameters
    $report_id = $_GET['report_id'];
    $status = $_GET['status'];

    // Perform the necessary update logic based on the provided status
    // ...

    // Example: Update the status in the database
    $link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

    // Update the status in the report table
    $updateQuery = "UPDATE report SET status = '$status' WHERE report_id = $report_id";
    $updateResult = mysqli_query($link, $updateQuery);

    if ($updateResult) {
        // Status updated successfully
        echo "Status updated successfully.";
    } else {
        // Error updating status
        echo "Error updating status: " . mysqli_error($link);
    }

    // Close the database connection
    mysqli_close($link);
} else {
    // Invalid parameters provided
    echo "Invalid parameters.";
}
?>
