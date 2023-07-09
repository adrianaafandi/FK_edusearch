





<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database.
mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

$id = isset($_POST["id"]) ? $_POST["id"] : '';

$query = "DELETE FROM complaint WHERE complaint_id = '$id'";
$result = mysqli_query($link, $query);

mysqli_close($link);

if ($result) {
    header("Location: ComplaintAdmin.php"); // Redirect to the homepage or any other page you want after deletion.
    exit();
}
?>

