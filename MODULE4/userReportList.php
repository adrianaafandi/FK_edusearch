<!DOCTYPE html>
<html>
<head>
<title>User Report List</title>

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
      width: 1px;
      height: 1px;
      background-image: url(../public/search.png);
      background-repeat: no-repeat;
      background-size: 10px;
      background-position: center;
      cursor: pointer;
    }

  
  </style>
</head>
<body>
<?php include '../AdminSideBar/Admin_sidebar.php'; ?>

  <div>
    <h2>User Report List</h2>

    <table>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>&nbsp;&nbsp;Action</th>
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
          echo "<td>"."<div class='view-icon' onclick='redirectToUserDetails(\"$email\")'></div></td>";
          echo "</tr>";
        }
        
        // Close the database connection
        mysqli_close($link);
      ?>
    </table>
  </div>

  <script>
    function redirectToUserDetails(email) {
      // Redirect to a new page to view user details using the provided email
      window.location.href = 'userReport.php?email=' + email;
    }
  </script>
</body>
</html>
