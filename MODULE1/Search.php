<?php

$search = $_POST['search'];

//to make a connection with database
$conn = mysqli_connect ("localhost","root","") or die (mysqli_connect_error()) ;

//to select the targeted database 
mysqli_select_db ($conn,"userprofile") or die (mysqli_error($conn)) ;

//to create a query to be executed in sql
$query = "SELECT * FROM user WHERE username='".$search."'";

//to run sql query in database
$result = mysqli_query ($conn,$query) or die (mysqli_error());
?>

<html>
    <style>

        table{
                columns: 1580px;
        }
  
       th {
                columns: 300px;
                background: #286291;
        }

        td{
            columns: 300px;
        }

        tr:nth-child(even) {background-color: #f2f2f2;}

        .totalbox{
                border-radius: 5px;
                width: 80px;
                height: 30px;
                margin: center;
        }

        .button1{
                border-radius: 1px;
                width: 200px;
                height: 30px;
                background: #286291;
                color: white;
        }
        </style>
<head>
    <title>LoginSuccessful</title>
    <link rel="stylesheet" type="text/css" href="">
	<script src=".js"></script>
    </head>
    <body>
    <?php include '../AdminSidebar/Admin_sidebar.php';?>
    <div style="padding-left: 35px;">

    
    <br><form action="Search.php" method="post">
      <input type="text" placeholder="Search" name="search">
      <button type="submit">Submit</button>
    </form><br>
    
    <table style="text-align: center;">

            <tr>
                <th>Username</th>
                <th>User Type</th>
            </tr>

            <?php 
                while($row=mysqli_fetch_assoc($result))
                {
                    $nama = $row['username'];
                    $jenispengguna =  $row['usertype'];
            ?>
            <tr>
                    <td><?php echo $nama ?></td>
                    <td><?php echo $jenispengguna ?></td>
                    <td><a href="ViewUserProfile.php?GetID=<?php echo $nama ?>">View</a></td>
                    <td><a href="EditUserProfile.php?GetID=<?php echo $nama ?>">Edit</a></td>
                    <td><a href="DeleteUserProfile.php?Del=<?php echo $nama ?>">Delete</a></td>
            </tr>

            <?php 
                }
            ?>

        </table>
            </div>
</body>
</html>
