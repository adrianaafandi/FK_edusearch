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
    $link = mysqli_connect("localhost", "root", "", "fkedusearch");
    if (!$link) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Check if the form is submitted.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the values from the form.
        $complaint_name = $_POST["complaint_name"];
        $complaint_datetime = $_POST["complaint_datetime"];
        $complainttype_name = $_POST["complainttype_name"];
        $complaint_desc = $_POST["complaint_desc"];

        // Prepare the insert statement
        $insertQuery = "INSERT INTO complaint (complaint_name, complaint_datetime, complaint_types, complaint_desc) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $insertQuery);
        if (!$stmt) {
            die("Insert statement preparation failed: " . mysqli_error($link));
        }

        // Bind the parameters and set their values
        mysqli_stmt_bind_param($stmt, "ssss", $complaint_name, $complaint_datetime, $complainttype_name, $complaint_desc);

        // Execute the prepared statement
        $executeResult = mysqli_stmt_execute($stmt);
        if (!$executeResult) {
            die("Insert statement execution failed: " . mysqli_stmt_error($stmt));
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        // Redirect to the submitted complaint page with the inserted data as URL parameters
        $redirectURL = "viewComplaint.php?complaint_name=" . urlencode($complaint_name) . "&complaint_datetime=" . urlencode($complaint_datetime) . "&complainttype_name=" . urlencode($complainttype_name) . "&complaint_desc=" . urlencode($complaint_desc);
        header("Location: " . $redirectURL);
        exit();
    }

    // Fetch the complaint types from the database
    $complainttypeQuery = "SELECT * FROM complainttype";
    $complainttypeResult = mysqli_query($link, $complainttypeQuery);
    if (!$complainttypeResult) {
        die("Complaint type retrieval failed: " . mysqli_error($link));
    }
    ?>

    <div id="mySidebar" class="sidebar">
        <img src="/fkedusearch/img/picture9.png" style="height:100px; width:100%; style=" margin-top:100px; ">

        <a href=" #user" align="left">
        <img src="/fkedusearch/img/picture4.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span
            style="vertical-align: middle;">&nbsp&nbsp
            User</span>
        </a>

        <a href="#discussion" align="left">
            <img src="/fkedusearch/img/picture6.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span
                style="vertical-align: middle;">&nbsp&nbsp
                Discussion</span>
        </a>

        <a href="#expert" align="left">
            <img src="/fkedusearch/img/picture7.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span
                style="vertical-align: middle;">&nbsp&nbsp
                Expert</span>
        </a>

        <a href="#report" align="left">
            <img src="/fkedusearch/img/picture8.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span
                style="vertical-align: middle;">&nbsp&nbsp
                Report</span>
        </a>

        <a class="active" href="#complaint" align="left">
            <img src="/fkedusearch/img/picture10.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span
                style="vertical-align: middle;">&nbsp&nbsp
                Complaint</span>
        </a>
    </div>



    <div id="main">
        <img src="/fkedusearch/banner.png" style="height:200px" width="100%">
        <button class="openbtn" onclick="toggleNav()">☰</button>
        <div class="content" style="
        padding-top: 50px;
        padding-right: 100px;
        padding-bottom: 50px;
        padding-left: 100px;">
            <div class="w3-container custom-container"
                style="background-color: #F2F2F2; padding-top: 20px; padding-bottom: 20px;">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h2 align="left"><b>COMPLAINT</b></h2>
                    <p style="margin-top: 5px;">We are here to assist you!</p>
                    <div align="right">
                        <button type="button" class="btn btn-primary"
                            style="background-color: #62A0D4; border: none;" onclick="redirectToPage()">VIEW COMPLAINT</button>
                    </div>

                    <div class="mb-3 row" style="margin-top: 10px;">
                        <label for="c_name" class="col-sm-2 col-form-label">Complainant's Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="complaint_name" name="complaint_name"
                                placeholder="Write your name" required>
                        </div>
                        <br><br>

                        <label for="complaint_datetime" class="col-sm-2 col-form-label">Date and Time:</label>
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
                                    <option value="<?php echo $complainttype_name; ?>"><?php echo $complainttype_name; ?>
                                    </option>
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
                        <button type="submit" class="btn btn-primary"
                            style="background-color: #62A0D4; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">SUBMIT</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-secondary" style="background-color: #BFBFBF; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" onclick="goBack()">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function redirectToPage() {
                window.location.href = "viewComplaint.php";
            }
        </script>

        <script>
            function goBack() {
                window.history.back();
            } 
        </script>

        <script>
            // Get the current date and time
            var now = new Date();

            // Get the local date and time components
            var year = now.getFullYear();
            var month = ('0' + (now.getMonth() + 1)).slice(-2);  // Month is zero-based
            var day = ('0' + now.getDate()).slice(-2);
            var hours = ('0' + now.getHours()).slice(-2);
            var minutes = ('0' + now.getMinutes()).slice(-2);

            // Format the date and time in the required format (YYYY-MM-DDTHH:mm)
            var formattedDateTime = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;

            // Set the value of the input field to the formatted date and time
            document.getElementById("complaint_datetime").value = formattedDateTime;

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
    </div>
    
</body>

</html>