<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
</head>

<body>
    <?php
    // Connect to the database server.
    $link = mysqli_connect("localhost", "root", "", "fkedusearch") or die(mysqli_connect_error());

    // Check if the form is submitted.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the values from the form.
        $complaint_name = $_POST["complaint_name"];
        $complaint_datetime = $_POST["complaint_datetime"];
        $complainttype_name = $_POST["complainttype_name"];
        $complaint_desc = $_POST["complaint_desc"];

        // Insert the data into the database.
        $insertQuery = "INSERT INTO complaint (complaint_name, complaint_datetime, complaint_types, complaint_desc) VALUES ('$complaint_name', '$complaint_datetime', '$complainttype_name', '$complaint_desc')";
        mysqli_query($link, $insertQuery);

        // Retrieve the maximum complaint_id value.
        $maxQuery = "SELECT MAX(complaint_id) AS max_id FROM complaint";
        $result = mysqli_query($link, $maxQuery);
        $row = mysqli_fetch_assoc($result);
        $maxId = $row['max_id'];

        // Reset the auto-increment value.
        $resetQuery = "ALTER TABLE complaint AUTO_INCREMENT = " . ($maxId + 1);
        mysqli_query($link, $resetQuery);

        // Close the database connection.
        mysqli_close($link);

        // Redirect to a success page or perform any other actions.
        header("Location: submittedComplaint.php");
        exit(); // Terminate the current script.
    }

    // Fetch the complaint types from the database
    $complainttypeQuery = "SELECT * FROM complainttype";
    $complainttypeResult = mysqli_query($link, $complainttypeQuery);
    ?>

    <img src="/fkedusearch/banner.png" style="height:200px" width="100%">

    <div class="content">
        <div style="margin-top: 30px; margin-left: 10px;">
            <form action="addComplaint.php" method="post" class="row g-3">
                <h2 align="left"><b>COMPLAINT</b></h2>
                <p><b>We are here to assist you!</b></p>
                <div class="mb-3 row" style="margin-top: 10px;">
                    <label for="c_name" class="col-sm-2 col-form-label">Complainant's Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="complaint_name" name="complaint_name"
                            placeholder="Write your name" required>
                    </div>
                    <br><br>

                    <label for="c_datetime" class="col-sm-2 col-form-label">Date and Time:</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" id="complaint_datetime"
                            name="complaint_datetime" placeholder="Select Date and Time" required>
                    </div>
                    <br><br>

                    <label for="c_types" class="col-sm-2 col-form-label">Complaint Type:</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="complainttype_name" name="complainttype_name"
                            aria-label="Default select example">
                            <option selected>Choose your complaint type</option>
                            <?php
                            // Loop through the complaint types and generate the options
                            while ($complainttypeRow = mysqli_fetch_assoc($complainttypeResult)) {
                                $complainttype_id = $complainttypeRow['complainttype_id'];
                                $complainttype_name = $complainttypeRow['complainttype_name'];
                                ?>
                                <option value="<?php echo $complainttype_name; ?>"><?php echo $complainttype_name; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <br><br>

                    <label for="c_desc" class="col-sm-2 col-form-label">Complaint Details:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="complaint_desc" name="complaint_desc" rows="3"
                            placeholder="Describe your complaint details"></textarea>
                    </div>
                    <br><br><br><br>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-secondary" onclick="goBack()">CANCEL</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
