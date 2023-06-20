<!DOCTYPE html>
<html>

<head>
  <title>User Report List</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <style>
    h2 {
      text-align: center;
    }

    table {
      border-collapse: collapse;
      width: 90%;
      margin: 0 auto;
      border: 1px solid #ddd;
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
      width: 16px;
      height: 16px;
      background-image: url(../public/search.png);
      background-repeat: no-repeat;
      background-size: cover;
      cursor: pointer;
    }

    /* The Modal (background) */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/ opacity */
      padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
      background-color: #fefefe;
      margin: 5% auto 15% auto;
      /* 5% from the top, 15% from the bottom and centered */
      border: 1px solid #888;
      width: 80%;
      /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
      position: absolute;
      right: 25px;
      top: 0;
      color: #000;
      font-size: 35px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: red;
      cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
      -webkit-animation: animatezoom 0.6s;
      animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
      from {
        -webkit-transform: scale(0)
      }

      to {
        -webkit-transform: scale(1)
      }
    }

    @keyframes animatezoom {
      from {
        transform: scale(0)
      }

      to {
        transform: scale(1)
      }
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }

      .cancelbtn {
        width: 100%;
      }
    }

    canvas {
      width: 600px;
      height: 800px;
    }
  </style>
</head>

<body>
  <?php include '../AdminSideBar/Admin_sidebar.php'; ?>

  <div>
    <h2>User Report List</h2>

    <table>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
      <?php

      $link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
      }

      // Fetch user data from the database
      $query = "SELECT * FROM user";
      $result = mysqli_query($link, $query);

      $rowNumber = 1;

      // Loop through each user and generate a row in the table
      while ($row = mysqli_fetch_assoc($result)) {

        $fullname = $row['fullname'];
        $email = $row['email'];
        echo "<tr>";
        echo "<td>$rowNumber</td>";
        echo "<td>$fullname</td>";
        echo "<td>$email</td>";
        echo "<td><div class='view-icon' onclick='redirectToUserDetails(\"$email\")'></div></td>";
        echo "</tr>";

        $rowNumber++;
      }

      // Close the database connection
      mysqli_close($link);
      ?>
    </table>

    <div align="center">
      <br><br><br>
      <button type="submit" class="btn btn-primary"
        style="background-color: #69C9C4; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);"
        onclick="document.getElementById('id01').style.display='block'" style="width:auto;">USER SATISFACTION REPORT
      </button><br><br><br>
    </div>

    <div id="id01" class="modal">

<form class="modal-content animate" action="/action_page.php" method="post">
  <div class="imgcontainer">
    <span onclick="document.getElementById('id01').style.display='none'" class="close"
      title="Close Modal">&times;</span>
  </div>

    <div class="container">
      <canvas id="reportChart" style=" align:center; max-height: 1000px; max-width: 600px; "></canvas>

      <?php
      // Connect to the database server.
      $link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

      // SQL query
      $query = "SELECT satisfaction, COUNT(*) AS satisfaction_count FROM satisfaction GROUP BY satisfaction";

      // Execute the query
      $result = mysqli_query($link, $query);

      if ($result) {
        // Initialize an empty array to store the satisfaction counts
        $satisfactionCounts = array();

        // Iterate over the result set and store the satisfaction counts
        while ($row = mysqli_fetch_assoc($result)) {
          $satisfaction = $row["satisfaction"];
          $satisfaction_count = $row["satisfaction_count"];

          $satisfactionCounts[$satisfaction] = $satisfaction_count;
        }

        // Extract the satisfaction levels and counts as separate arrays
        $satisfactionLevels = array_keys($satisfactionCounts);
        $satisfactionCounts = array_values($satisfactionCounts);
      }
      ?>

      <script>
        // Retrieve the satisfaction levels and counts from PHP
        var satisfactionLevels = <?php echo isset($satisfactionLevels) ? json_encode($satisfactionLevels) : '[]'; ?>;
        var satisfactionCounts = <?php echo isset($satisfactionCounts) ? json_encode($satisfactionCounts) : '[]'; ?>;

        // Define an array of colors for differentiating satisfaction levels
        var colors = ['rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(153, 102, 255, 0.6)'];

        // Get the canvas element
        var ctx = document.getElementById('reportChart').getContext('2d');

        // Create the chart using Chart.js
        new Chart(ctx, {
          type: 'bar', // Change chart type to bar
          data: {
            labels: satisfactionLevels,
            datasets: [{
              data: satisfactionCounts,
              backgroundColor: colors,
              borderColor: 'rgba(255, 255, 255, 1)',
              borderWidth: 1,
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: true, // Start y-axis from zero
                stepSize: 1 // Define the step size for y-axis
              }
            },
            plugins: {
              legend: {
                display: false // Hide the legend
              },
              tooltip: {
                bodyFont: {
                  size: 10 // Adjust font size of tooltip text
                }
              }
            }
          }
        });
      </script>
    </div>
    </form>
  </div>



  <script>
    function redirectToUserDetails(email) {
      // Redirect to a new page to view user details using the provided email
      window.location.href = 'userReport.php?email=' + email;
    }
  </script>
</body>

</html>