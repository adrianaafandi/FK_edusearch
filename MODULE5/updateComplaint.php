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
        $complaint_id = $_POST["complaint_id"];
        $complainttype_name = $_POST["complainttype_name"];
        $complaint_name = $_POST["complaint_name"];
        $complaint_datetime = $_POST["complaint_datetime"];
        $complaint_desc = $_POST["complaint_desc"];

        // Prepare the update statement
        $updateQuery = "UPDATE complaint SET complaint_types = ?, complaint_name = ?, complaint_datetime = ?, complaint_desc = ? WHERE complaint_id = ?";
        $stmt = mysqli_prepare($link, $updateQuery) or die(mysqli_error($link));

        // Bind the parameters and set their values
        mysqli_stmt_bind_param($stmt, "sssss", $complainttype_name, $complaint_name, $complaint_datetime, $complaint_desc, $complaint_id);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);

        // Close the database connection
        mysqli_close($link);

        // Redirect to the admin complaint page or perform any other actions.
        header("Location: complaintAdmin.php");
        exit(); // Terminate the current script.
    }

    // Check if the complaint ID is provided in the URL
    if (isset($_GET["id"])) {
        // Get the complaint ID from the URL
        $complaint_id = $_GET["id"];

        // Fetch the complaint details from the database
        $complaintQuery = "SELECT * FROM complaint WHERE complaint_id = $complaint_id";
        $complaintResult = mysqli_query($link, $complaintQuery);
        $complaintRow = mysqli_fetch_assoc($complaintResult);

        // Fetch the complaint types from the database
        $complainttypeQuery = "SELECT * FROM complainttype";
        $complainttypeResult = mysqli_query($link, $complainttypeQuery) or die(mysqli_error($link));
    } else {
        // If no complaint ID is provided, redirect to the admin complaint page or perform any other actions.
        header("Location: complaintAdmin.php");
        exit(); // Terminate the current script.
    }
    ?>

    <img src="/fkedusearch/banner.png" style="height:200px" width="100%">

    <div class="content">
        <div style="margin-top: 30px; margin-left: 10px;">
            <form action="updateComplaint.php" method="post" class="row g-3">
                <h2 align="left"><b>EDIT COMPLAINT</b></h2>
                <div class="mb-3 row" style="margin-top: 10px;">
                    <input type="hidden" name="complaint_id" value="<?php echo $complaintRow['complaint_id']; ?>">
                    <label for="complaint_name" class="col-sm-2 col-form-label">Complainant's Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="complaint_name" name="complaint_name"
                            placeholder="Write your name" value="<?php echo $complaintRow['complaint_name']; ?>">
                    </div>
                    <br><br>

                    <label for="complaint_datetime" class="col-sm-2 col-form-label">Date and Time:</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" id="complaint_datetime"
                            name="complaint_datetime" placeholder="Select Date and Time"
                            value="<?php echo date('Y-m-d\TH:i', strtotime($complaintRow['complaint_datetime'])); ?>">
                    </div>
                    <br><br>

                    <label for="complainttype_name" class="col-sm-2 col-form-label">Complaint Type:</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="complainttype_name" name="complainttype_name"
                            aria-label="Default select example">
                            <?php
                            // Loop through the complaint types and generate the options
                            while ($complainttypeRow = mysqli_fetch_assoc($complainttypeResult)) {
                                $complainttype_id = $complainttypeRow['complainttype_id'];
                                $complainttype_name = $complainttypeRow['complainttype_name'];
                                $selected = ($complainttype_name == $complaintRow['complaint_types']) ? "selected" : "";
                                ?>
                                <option value="<?php echo $complainttype_name; ?>" <?php echo $selected; ?>><?php echo $complainttype_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <br><br>

                    <label for="complaint_desc" class="col-sm-2 col-form-label">Complaint Details:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="complaint_desc" name="complaint_desc" rows="3"
                            placeholder="Describe your complaint details"><?php echo $complaintRow['complaint_desc']; ?></textarea>
                    </div>
                    <br><br><br><br>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">UPDATE</button>
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
