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

    .user-report {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      width: 800px; /* Adjust the width as desired */
    }
  </style>
</head>

<body>
  <?php include '../AdminSideBar/Admin_sidebar.php'; ?>

  <div class="user-list" align='center'>
    <h2 align='center'>User Report</h2>

    <div class="user-report" align='center'>
      <?php
      $link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

      // Fetch user data from the database
      $email = $_GET['email'];

      // Query to retrieve user details and count total discussions, likes, and comments
      $query = "SELECT u.fullname, u.email, COUNT(d.discussion_id) AS total_discussions, SUM(d.discussion_like) AS total_likes, SUM(d.discussion_comment) AS total_comments
                FROM user u
                INNER JOIN discussion d ON u.user_id = d.user_id
                WHERE u.email = '$email'";

      $result = mysqli_query($link, $query);

      // Check if the user exists
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fullname = $row['fullname'];
        $email = $row['email'];
        $totalDiscussions = $row['total_discussions'];
        $totalLikes = $row['total_likes'];
        $totalComments = $row['total_comments'];

        echo "<h3>$fullname</h3>";

        echo "<table>";
        echo "<tr><th>Total Discussions:</th><td>$totalDiscussions</td></tr>";
        echo "<tr><th>Total Likes:</th><td>$totalLikes</td></tr>";
        echo "<tr><th>Total Comments:</th><td>$totalComments</td></tr>";

        // Calculate and display retention rate
        $retentionRate = (($totalLikes + $totalComments) / $totalDiscussions) * 100;
        echo "<tr><th>Retention Rate:</th><td>" . number_format($retentionRate, 2) . "%</td></tr>";

        echo "</table>";
      } else {
        echo "User not found.";
      }

      // Close the database connection
      mysqli_close($link);
      ?>
    </div>
  </div>
  <br>
  <div class="d-grid gap-2 col-3 mx-auto">
    <button class="btn btn-primary" type="button" onclick="window.location.href='userReportList.php'">Back</button>
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
