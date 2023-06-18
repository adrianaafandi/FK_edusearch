<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysql_connect_error());

//Select the database.
mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

$complaint_name = $_POST["complaint_name"];
$complaint_datetime = $_POST["complaint_datetime"];
$complaint_types = $_POST["complaint_types"];
$complaint_desc = $_POST["complaint_desc"];
$pid2 = $_POST["id2"];

$query = "UPDATE complaint SET complaint_name = '$complaint_name', complaint_datetime = '$complaint_datetime', complaint_types = '$complaint_types', complaint_desc = '$complaint_desc' WHERE complaint_id = '$pid2'";

$result = mysqli_query($link, $query) or die("Could not execute query in updateComplaint.php");
if ($result) {
    echo "<script type = 'text/javascript'> window.location='ComplaintAdmin.php' </script>";
}
?>