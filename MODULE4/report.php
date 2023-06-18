<!DOCTYPE html>
<html>

<head>
  <style>
    .report-form {
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 30px;
      width: 400px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    select,
    textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-bottom: 10px;
    }

    textarea {
      height: 120px;
    }

    .button-container {
      text-align: center;
    }

    .submit-button,
    .cancel-button {
      padding: 8px 16px;
      background-color: #4CAF50;
      color: black;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-right: 10px;
    }

    .cancel-button {
      background-color: #ccc;

    }
  </style>
</head>

<body>
<?php include '../UserSideBar/User_sidebar.php'; ?>

  <?php
  // Connect to the database server.
  $link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $reporter_name = $_POST["reporter-name"];
    $datentime = $_POST["report-date"];
    $report_types = $_POST["report-type"];
    $reportDetails = $_POST["report-details"];

    // Construct INSERT query
    $insertQuery = "INSERT INTO report (reporter_name, datentime, report_types, reportDetails) VALUES ('$reporter_name', '$datentime', '$report_types', '$reportDetails')";

    // Execute INSERT query
    if (mysqli_query($link, $insertQuery)) {
      echo "Record inserted successfully.";
      header("Location: reportList.php");
      exit();
    } else {
      echo "Error inserting record: " . mysqli_error($link);
    }
  }

  // SQL query with INNER JOIN
  $query = "SELECT r.*, c.report_types FROM report r INNER JOIN report_types c ON r.report_types = c.report_types";
  $result = mysqli_query($link, $query);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
      $reporter_name = $_POST["reporter-name"];
      $datentime = $_POST["report-date"];
      $report_types = $_POST["report-type"];
      $reportDetails = $_POST["report-details"];
    }

  } else {
    // If no rows found, initialize variables with empty values
    $reporter_name = " ";
    $datentime = " ";
    $report_types = " ";
    $reportDetails = " ";
  }

  ?>

  <title>Report</title>

  <div class="report-form">
    <h1>Report Form</h1>

    <form action="submit_report.php" method="POST">
      <label for="reporter-name">Reporter's Name</label>
      <input type="text" id="reporter-name" name="reporter-name" required>

      <br>
      <label for="report-date">Date and Time</label>
      <input type="datetime-local" id="report-date" name="report-date" required>

      <br><br>
      <label for="report-type">Report Type</label>
      <select id="report-type" name="report-type" required>
        <option value="">Select Report Type</option>
        <?php


        $link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());
        // Fetch report types from the database
        $query = "SELECT * FROM report_types";
        $result = mysqli_query($link, $query);

        // Loop through each report type and generate an option in the select dropdown
        while ($row = mysqli_fetch_assoc($result)) {
          $type = $row['type'];
          echo "<option value='$type'>$type</option>";
        }

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        ?>
      </select>

      <label for="report-details">Report Details</label>
      <textarea id="report-details" name="report-details" required></textarea>

      <div class="button-container">
        <button type="submit" class="submit-button">Submit</button>
        <button type="button" class="cancel-button" onclick="cancelReport()">Cancel</button>
      </div>
    </form>
  </div>

 <script>
    function cancelReport() {
      // Redirect to the previous page or perform any desired action
      window.history.back();
    }
  </script>
</body>

</html>