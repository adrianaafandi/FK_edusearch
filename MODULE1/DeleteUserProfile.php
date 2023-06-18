<?php
//Connect to the database server.
$conn = mysqli_connect("localhost", "root","") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($conn, "userprofile") or die(mysqli_error($conn));

    if(isset($_GET['Del']))
    {
        $username = $_GET['Del'];
        $query = "delete from user where username = '".$username."'";

        //Execute the query (the recordset $rs contains the result)
        $result = mysqli_query($conn, $query);

        if($result)
        {
            header("location:ManageUserProfile.php");
        }
        else
        {
            echo 'Please check your query';
        }
    }
    else
    {
        header("location:ManageUserProfile.php");
    }

?>