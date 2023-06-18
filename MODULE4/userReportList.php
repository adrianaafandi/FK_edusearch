<!DOCTYPE html>
<html>
<head>
<img src="img.png" style="height:200px" width="1520px">
  <style>
    
    
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    tr:hover {background-color: #f5f5f5;}
    
    .view-icon {
      width: 24px;
      height: 24px;
      background-image: url(search.png);
      background-repeat: no-repeat;
      background-size: cover;
      cursor: pointer;
    }

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
  </style>
</head>
<body>
     <nav>
        <a href="LoginSuccessful.php">Home</a><br>
        <a href="ManageUserProfile.php">Manage User Profile</a><br>
        <a href="UserReportList.php">Report</a><br>
        <a href="Logout.php">Logout Here</a>
    </nav>

    <div>
  
    <h2>User Report List</h2>

    <table>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
      <?php
        
        $link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $name = $_POST["name"];
            $email = $_POST["email"];
        
        }
        // Fetch user data from the database
        $query = "SELECT * FROM users";
        $result = mysqli_query($link, $query);
        
        // Loop through each user and generate a row in the table
        while ($row = mysqli_fetch_assoc($result)) {
          $name = $row['name'];
          $email = $row['email'];
          echo "<tr>";
          echo "<td>$name</td>";
          echo "<td>$email</td>";
          echo "<td>"."<div class='view-icon' onclick='viewUserDetails()'></div></td>";
          echo "</tr>";
        }
        
        // Close the database connection
        mysqli_close($link);
      ?>
    </table>

    </div>

  <script>
    function redirectToUserDetails() {
      // Redirect to a new page to view user details using the provided email
    //   window.location.href = 'userReport.php?email=' + email;
    <a href = "userReport.php"></a>
    }
  </script>
</body>
</html>
