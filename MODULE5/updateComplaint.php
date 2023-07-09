<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>FK_EDUSEARCH</title>
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #286291;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            border-radius: 0 10px 10px 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);

        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #EFEFEF;
            display: block;
            transition: 0.3s;
            font-family: "Century Gothic", sans-serif;
        }

        .sidebar a.active {
            background-color: #54AFE6;
            color: white;
            border-radius: 0 10px 10px 0;
        }

        .sidebar a:hover:not(.active) {
            background-color: #99C2E3;
            color: #262261;
            border-radius: 0 10px 10px 0;
        }

        .sidebar a:hover {
            color: #D5E0FF;
            background-color: #54AFE6;
            color: #262261;
            border-radius: 0 15px 15px 0;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #62A0D4;
            color: white;
            padding: 10px 15px;
            border: none;
            width: 100%;
            text-align: left;
        }

        .openbtn:hover {
            background-color: #54AFE6;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidebar {
                padding-top: 15px;
            }

            .sidebar a {
                font-size: 18px;
            }
        }

        .custom-container {
            background-color: black;
            color: black;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
    </style>
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
                <h2 align="center"><b>MANAGE COMPLAINT</b></h2>
                <p align="center" style="margin-top: 0px;"><b>Admin Page - Edit Complaint</b></p>
                <div class="content" style="
                        padding-top: 10px;
                        padding-right: 100px;
                        padding-bottom: 50px;
                        padding-left: 100px;">
                    <div class="w3-container custom-container"
                        style="background-color: #F2F2F2; padding-top: 20px; padding-bottom: 20px;">
                        <div class="mb-3 row" style="margin-top: 10px;">
                            <input type="hidden" name="complaint_id"
                                value="<?php echo $complaintRow['complaint_id']; ?>">
                            <label for="complaint_name" class="col-sm-2 col-form-label">Complainant's Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="complaint_name" name="complaint_name"
                                    placeholder="Write your name"
                                    value="<?php echo $complaintRow['complaint_name']; ?>">
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
                            <button type="submit" class="btn btn-primary" style="background-color:  #69C9C4; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">UPDATE</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-secondary" style="background-color:  #A6A6A6; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" onclick="goBack()">CANCEL</button>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        } 
    </script>

    <script>
        function toggleNav() {
            var sidebar = document.getElementById("mySidebar");
            var main = document.getElementById("main");

            if (sidebar.style.width === "250px") {
                sidebar.style.width = "0";
                main.style.marginLeft = "0";
            } else {
                sidebar.style.width = "250px";
                main.style.marginLeft = "250px";
            }
        }
    </script>
</body>

</html>