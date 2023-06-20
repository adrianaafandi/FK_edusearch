<?php
/*
Filename: UserProfile. php
Purpose: To view user frofile
*/
?>

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
            

    <div class="">
        <form action="Insert.php" method="post">
            <table>
                <tr>
                    <td>Select type of user :</td>
                    <td><select class="" name="typeuser" required onchange="addPrefix()">
                        <option value="" disabled selected> Select</option>
                        <option value="Student & Staff">Student & Staff</option>
                        <option value="Admin">Admin</option>
                        <option value="Expert">Expert</option>
                    </select></td>
                </tr>
                <tr>
                    <br><td>Firstname :</td>
                    <td><input type="name" class="input" name="input1"></td>
                </tr>
                <tr>
                    <td>Lastname :</td>
                    <td><input type="name" class="input" name="input2"></td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td><input type="name" class="input" name="input3"></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type="name" class="input" name="input4"></td>
                </tr>
                
                <tr>
                    <td>Email :</td>
                    <td><input type="name" class="input" name="input5"></td>
                </tr>
                
            </table>  
            <input type="submit" class="button" value="Submit">
        </form>         
    </div>
    
    
</body>
</html>

