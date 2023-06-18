<!DOCTYPE html>
<html>

<head>
  <style>
    .user-details {
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 10px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    .view-icon {
      width: 24px;
      height: 24px;
      background-image: url(view-icon.png);
      /* Replace with the path to your view icon */
      background-repeat: no-repeat;
      background-size: cover;
      cursor: pointer;
    }

    
  </style>
</head>

<body>
<?php include '../AdminSideBar/Admin_sidebar.php'; ?>

<div class="user-list">
        <h2>User Report</h2>

        <div class="user-report">
            <?php

            $link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

            // Fetch user data from the database
            $email = $_GET['email'];

            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($link, $query);

            // Check if the user exists
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $name = $row['name'];
                $email = $row['email'];
                $totalPosts = $row['total_posts'];
                $totalLikes = $row['total_likes'];
                $totalComments = $row['total_comments'];

                echo "<h3>$name</h3>";

                echo "<table>";
                echo "<tr><th>Total Posts:</th><td>$totalPosts</td></tr>";
                echo "<tr><th>Total Likes:</th><td>$totalLikes</td></tr>";
                echo "<tr><th>Total Comments:</th><td>$totalComments</td></tr>";
                echo "</table>";
            } else {
                echo "User not found.";
            }

            // Close the database connection
            mysqli_close($link);
            ?>
        </div>
    </div>

    <script>
        function viewUserDetails(email) {
            // Perform action to view user details using the provided email
            alert('Viewing details for user with email: ' + email);
            // You can redirect to a new page or display the details dynamically in the same page
        }
    </script>
</body>

</html>
