<?php
//Connect to the database server.
$conn = mysqli_connect ("localhost","root","") or die (mysqli_connect_error()) ;

//to select the targeted database 
mysqli_select_db ($conn,"userprofile") or die (mysqli_error($conn)) ;

    if(isset($_POST['update']))
    {
        $usertype = $_POST["typeuser"];
        $firstname = $_POST["input1"];
        $lastname = $_POST["input2"];
        $username = $_POST["input3"];
        $password = $_POST["input4"];
        $email = $_POST["input5"];

        $query = "UPDATE user SET usertype='".$usertype."', firstname='".$firstname."',
        lastname='".$lastname."', username='".$username."', password='".$password."',email='".$email."' where username='".$username."'";

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