<?php
//to make a connection with database
$conn = mysqli_connect ("localhost","root","") or die (mysqli_connect_error()) ;

//to select the targeted database 
mysqli_select_db ($conn,"userprofile") or die (mysqli_error($conn)) ;

//to create a query to be executed in sql
$query = "SELECT * FROM user ";

//to run sql query in database
$result = mysqli_query ($conn,$query) or die (mysqli_error());

//to create a query to be executed in sql
$query1 = "SELECT * FROM user WHERE usertype='Admin' ";

//to run sql query in database
$result1 = mysqli_query ($conn,$query1) or die (mysqli_error());

//to create a query to be executed in sql
$query2 = "SELECT * FROM user WHERE usertype='Student & Staff'";

//to run sql query in database
$result2 = mysqli_query ($conn,$query2) or die (mysqli_error());

//to create a query to be executed in sql
$query3 = "SELECT * FROM user WHERE usertype='Expert'";

//to run sql query in database
$result3 = mysqli_query ($conn,$query3) or die (mysqli_error());


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

    <b>Total User Admin: </b>

    <?php
        $last_id1 = mysqli_num_rows($result1);
    ?>
    
    <input type="text" name="totalUser" value="<?php echo $last_id1 ?>" class="totalbox" style="text-align: center;"readonly>

    <b style="padding-left: 100px;">Total User Student & Staff: </b>

    <?php
        $last_id2 = mysqli_num_rows($result2);
    ?>
    
    <input type="text" name="totalUser" value="<?php echo $last_id2 ?>" class="totalbox" style="text-align: center;"readonly>
    
    <b style="padding-left: 100px;">Total User Expert: </b>

    <?php
        $last_id3 = mysqli_num_rows($result3);
    ?>
    
    <input type="text" name="totalUser" value="<?php echo $last_id3 ?>" class="totalbox" style="text-align: center;" readonly>

    <a style="padding-left: 100px;" href="UserProfile.php"><input type="submit" class="button1" value="Create New User"></a><br>
    
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