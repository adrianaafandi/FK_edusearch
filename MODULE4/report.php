<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
  <?php include '../UserSideBar/User_sidebar.php' ?>

  <?php
  // Connect to the database server.
  $link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $type_id = $_POST["type_id"];
    $reporter_name = $_POST["reporter_name"];
    $datentime = $_POST["datentime"];
    $reportDetails = $_POST["reportDetails"];

    if (empty($type_id) || empty($reporter_name) || empty($datentime) || empty($reportDetails)) {
      echo '<script>alert("Please fill in all the fields!!");</script>';
    } else {
      // Retrieve the maximum report ID from the database
      $maxReportIdQuery = "SELECT MAX(report_id) AS max_id FROM report";
      $maxReportIdResult = mysqli_query($link, $maxReportIdQuery);
      $maxReportIdRow = mysqli_fetch_assoc($maxReportIdResult);
      $maxReportId = $maxReportIdRow['max_id'];

      // Calculate the new report ID by adding 1 to the maximum ID
      $newReportId = $maxReportId + 1;

      // Construct INSERT query with the manually specified report ID
      $insertQuery = "INSERT INTO report (report_id, type_id, reporter_name, datentime, reportDetails) VALUES ('$newReportId', '$type_id', '$reporter_name', '$datentime', '$reportDetails')";

      // Execute INSERT query
      if (mysqli_query($link, $insertQuery)) {
        header("Location: homepage.php"); // Redirect to view.php
        exit();
      } else {
        echo "Error inserting record: " . mysqli_error($link);
      }
    }
  }

  // SQL query with INNER JOIN
  $typeQuery = "SELECT * FROM type";
  $typeResult = mysqli_query($link, $typeQuery);

  // If no rows found, initialize variables with empty values
  $type_id = "";
  $reporter_name = "";
  $datentime = "";
  $reportDetails = "";
  ?>

  <title>Report</title>

  <div class="report">
    <div style="margin-top: 30px; margin-left: 10px;">
      <form class="row g-3" method="POST" action="" onsubmit="return validateForm();">
        <h6 align="left"><b>MAKE A REPORT</b></h6><br><br>
        <div class="mb-3 row">
          <label for="reporter_name" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="reporter_name" name="reporter_name"
              value="<?php echo $reporter_name; ?>">
          </div>
        </div>

        <div class="mb-3 row" style="margin-top: 10px;">
          <label for="type_id" class="col-sm-2 col-form-label">Report Type</label>
          <div class="col-sm-10">
            <select class="form-select" id="type_id" name="type_id" aria-label="Default select example">
              <option value="">Select report type</option>
              <?php
              while ($typeRow = mysqli_fetch_assoc($typeResult)) {
                $type_id = $typeRow['type_id'];
                $type_type = $typeRow['type_type'];
                echo "<option value='$type_id'>$type_type</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="datentime" class="col-sm-2 col-form-label">Date</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="datentime" name="datentime" value="<?php echo $datentime; ?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="" class="col-sm-2 col-form-label">Report Detail</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="reportDetails" name="reportDetails"
              rows="5"><?php echo $reportDetails; ?></textarea>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">SUBMIT</button>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <button type="button" class="cancel-button" onclick="cancelReport()">Cancel</button>
        </div>
      </form>
      <br><br><br>
    </div>
  </div>
  </div>

  <script>
    function cancelReport() {
      // Redirect to the previous page or perform any desired action
      window.history.back();
    }

    function validateForm() {
      var type = document.getElementById("$type_id").value;
      var reporter_name = document.getElementById("reporter_name").value;
      var datentime = document.getElementById("datentime").value;
      var reportDetails = document.getElementById("reportDetails").value;

      if (type === "" || reporter_name === "" || datentime === "" || reportDetails === "") {
        alert("Please fill in all the fields!!");
        return false;
      }

      return true;
    }
  </script>
</body>

</html>