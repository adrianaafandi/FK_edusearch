<?php
// Retrieve the report ID from the URL parameter
$report_id = $_GET['id'];

// Connect to the database
$link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

// Retrieve the existing data before deleting the record
$query = "SELECT r.report_id, r.reporter_name, r.datentime, r.type_id, t.type_type, r.reportDetails, r.status
          FROM report r
          INNER JOIN type t ON r.type_id = t.type_id
          ORDER BY r.report_id ASC";

// Execute the select query
$result = mysqli_query($link, $query);

// Check if the select operation was successful
if ($result) {
    // Update the report IDs to refresh sequentially
    $updateQuery = "SET @count = 0";
    mysqli_query($link, $updateQuery);
    $updateQuery = "UPDATE report SET report_id = @count:= @count + 1";
    mysqli_query($link, $updateQuery);

    // Create the delete query
    $deleteQuery = "DELETE FROM report WHERE report_id = $report_id";

    // Execute the delete query
    $deleteResult = mysqli_query($link, $deleteQuery);

    // Check if the delete operation was successful
    if ($deleteResult) {
        // Redirect the user to a success page or display a success message
        header("Location: reportList.php");
        exit;
    } else {
        // Display an error message
        echo "Error deleting the report: " . mysqli_error($link);
    }
} else {
    // Display an error message
    echo "Error retrieving data: " . mysqli_error($link);
}

// Close the database connection
mysqli_close($link);
?>