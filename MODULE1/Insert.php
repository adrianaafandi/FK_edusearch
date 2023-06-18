<!DOCTYPE html>
<html>
    <head>
        <title>Insert Data</title>
    </head>
    <body>
    <?php

        $usertype = $_POST["typeuser"];
        $firstname = $_POST["input1"];
        $lastname = $_POST["input2"];
        $username = $_POST["input3"];
        $password = $_POST["input4"];
        $email = $_POST["input5"];
        

        //Connect to the database server.
        $conn = mysqli_connect ("localhost","root","") or die (mysqli_connect_error()) ;

        //to select the targeted database 
        mysqli_select_db ($conn,"userprofile") or die (mysqli_error($conn)) ;

        //SQL query
        $query = "INSERT INTO user (id, usertype, firstname, lastname, username, password, email) VALUES
        ('','$usertype','$firstname','$lastname','$username','$password','$email')"
        or die(mysqli_connect_error());

        //to run sql query in database
        $result = mysqli_query($conn, $query);

        //Check whether the insert was successful or not
        if(isset($result))
        {
                header ("location: ManageUserProfile.php"); 
        }
        else 
        {  
            die("Insert failed");
        }

        //Close the database connection
        mysqli_close($conn);

    ?>
    </body>
</html>