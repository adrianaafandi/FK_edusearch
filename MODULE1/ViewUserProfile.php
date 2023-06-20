<?php 
//Connect to the database server.
$conn = mysqli_connect("localhost", "root","") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($conn, "userprofile") or die(mysqli_error($conn));

$username = $_GET['GetID'];

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

<!DOCTYPE html>
<html>
<style>

        .button{
                border-radius: 1px;
                width: 100px;
                height: 30px;
                background: #286291;
                color: white;
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
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="">
	<script src=".js"></script>
    </head>
    <body>
    <?php include '../AdminSidebar/Admin_sidebar.php';?>
    <div style="padding-left: 35px;">
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
            <input type="submit" class="button" value="Back">
        </form>         
    </div>
    
    
</body>
</html>
