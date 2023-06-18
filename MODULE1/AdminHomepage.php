<?php
/*
Filename: login-successful. php
Purpose: To display protected web page if user is valid.
Note: If you enter directly to this page, you will be checked by the authenticator, and then redirect to login-failed.htmL.
*/

include("Authenticator.php");
$_SESSION['SESS_FIRST_NAME'].$_SESSION['SESS_LAST_NAME'].$_SESSION ['SESS_USER_NAME'];

?>
<?php 
//Connect to the database server.
$conn = mysqli_connect("localhost", "root","") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($conn, "userprofile") or die(mysqli_error($conn));

$username = $_SESSION ['SESS_USER_NAME'];

//SQL query
$query = " select * from user where username ='".$username."'";

//Execute the query (the recordset $rs contains the result)
$result = mysqli_query($conn, $query);

            while($row=mysqli_fetch_assoc($result))
                {
                    $typeuser = $row['usertype'];
                    $first_name = $row['firstname'];
                    $last_name = $row['lastname'];
                    $user_name = $row['username'];
                    $pass_word = $row['password'];
                    $e_email = $row['email'];
                    
                    
                }
?>
<html>
    <style>
        nav {
                float: left;
                width: 10%;
                height: 490px;
                background: #a9a8a8;
                padding: 20px;
                border-radius: 25px;
            }
            
        div{
                background: #d5d5d5;
                padding-left: 210px;
                padding-top: 20px;
                border-radius: 25px;
                height: 510px;
        }
        .input{
                border-radius: 5px;
                padding: 20px; 
                width: 340px;
                height: 5px; 
                color: black;
        }
    </style>
<head>
    <title>LoginSuccessful</title>
    <link rel="stylesheet" type="text/css" href="">
	<script src=".js"></script>
    </head>
    <body>
    <header>
        <img src="Assets/img.png" style="height:200px" width="1520px">
    </header>
    <nav>
        <a href="LoginSuccessful.php">Home</a><br>
        <a href="ManageUserProfile.php">Manage User Profile</a><br>
        <a href="Logout.php">Logout Here</a>
    </nav>
    <div class="section2">
    Welcome Admin!!<br>

    <table>
        <tr>
            <td><img src="Assets/user.png" style="height:30px; width=30px;"></td>
            <td><?php echo $_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME']?></td>
        </tr>
    </table>
    
    
    
        <form action="ManageUserProfile.php" method="post">
            <table>
                <tr>
                <tr>
                    <td>Select type of user :</td>
                    <td><select class="" name="typeuser">
                            <option disabled selected><?php echo $typeuser?></option>
                        </select>
                    </td>
                </tr>
                </tr>
                <tr>
                    <br><td>Firstname :</td>
                    <td><input type="name" class="input" name="input1" value="<?php echo $first_name?>" readonly></td>
                </tr>
                <tr>
                    <td>Lastname :</td>
                    <td><input type="name" class="input" name="input2" value="<?php echo $last_name?>" readonly></td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td><input type="name" class="input" name="input3" value="<?php echo $user_name?>" readonly></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type="password" class="input" name="input4" value="<?php echo $pass_word?>" readonly></td>
                </tr>
                
                <tr>
                    <td>Email :</td>
                    <td><input type="name" class="input" name="input5" value="<?php echo $e_email?>" readonly></td>
                </tr>
            </table>  

        </form>         

    
</body>
</html>