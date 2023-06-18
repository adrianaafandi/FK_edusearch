<!DOCTYPE html>
<html>
<head>
<img src="img.png" style="height:200px" width="1520px">
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
          
          // Get form data
          $reporter_name = $_POST["reporter_name"];
          $datentime = $_POST["datentime"];
          $report_types = $_POST["report_types"];
          $reportDetails = $_POST["reportDetails"];
          
          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname, 3307);
          
          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          
          // Prepare and bind the SQL statement
          $stmt = $conn->prepare("INSERT INTO report (reporter_name, datentime, report_types, reportDetails) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("ssss", $reporter_name, $datentime, $report_types, $reportDetails);
          
          // Execute the statement
          if ($stmt->execute()) {
              echo "Report submitted successfully";
          } else {
              echo "Error submitting report: " . $stmt->error;
          }
          
          // Close the statement and connection
          $stmt->close();
          $conn->close();

          // Close the database connection
          mysqli_close($link);
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
