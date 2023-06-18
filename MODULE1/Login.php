<?php
/*
Filename : Login.php
Propose : Login interface
*/
//Start session
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="Stylesheet.css">
    </head>
    <header>
        <img src="Assets/img.png" style="height:200px" width="1520px">
    </header>
    <style>
        .section1{
                background: #d5d5d5;
                padding-left: 20px;
                padding-top: 10px;
                border-radius: 25px;
                height: 400px;
                width: 450px;   
                margin: auto;
        }
    
        .input{
                border-radius: 5px;
                padding: 20px; 
                width: 340px;
                height: 5px; 
                color: black;
        }
        
        .button1{
                border-radius: 1px;
                width: 200px;
                height: 30px;
                background: #286291;
                color: white;
                
        }
    </style>
    <body>
        <?php
        if (isset($_SESSION['ERRMSG_ARR']))
        {
            echo "<h1 style='color:red'>Error found: ";
            for ($i=0; $i<count($_SESSION['ERRMSG_ARR']); $I++){
                echo $_SESSION['ERRMSG_ARR'][$i]."! ";
            }
            echo "</h1>";
            unset ($_SESSION['ERRMSG_ARR']);
        }
        ?>
        <br><section class="section1">
        <form method="post" action="SessionHandler.php">
        <br><h1>Login</h1>
        Enter your username <br>
        <input type="name" class="input" name="uname" require><br><br>
        Enter your password<br>
        <input type="password" class="input" name="pword" require><br><br>
        Select type of user :
            <select class="" name="typeuser" required onchange="addPrefix()">
                <option value="" disabled selected> Select</option>
                <option value="Student & Staff">Student & Staff</option>
                <option value="Admin">Admin</option>
                <option value="Expert">Expert</option>
            </select>
    
        <br><br><input type="submit" class="button1" name="submit" value="Submit"><br><br>  
        
        </form> 
        </section>
        
    </body> 
</html>