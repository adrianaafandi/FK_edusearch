<!DOCTYPE html>
<html>

<head>
    <!-- CSS and JavaScript libraries -->
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
            background-color: #69C9C4;
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
            background-color: #3FBBB7;
            color: white;
            border-radius: 0 10px 10px 0;
        }

        .sidebar a:hover:not(.active) {
            background-color: #BBE7E5;
            color: #262261;
            border-radius: 0 10px 10px 0;
        }

        .sidebar a:hover {
            color: #D5E0FF;
            background-color: #ADE1DF;
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
            background-color: #69C9C4;
            color: white;
            padding: 10px 15px;
            border: none;
            width: 100%;
            text-align: left;
        }

        .openbtn:hover {
            background-color: #9FDDDA;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
            background-color: ;
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

        /* Pagination */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 5px;
            margin-left: 5px;
            display: inline-block;
            border: ;
            background-color: ;
            cursor: pointer;
            text-decoration: none;
            color: #A6A6A6;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: ;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #9FDDDA;
            color: black;
        }

        /* Show entries dropdown */
        .dataTables_wrapper .dataTables_length {
            margin-top: 10px;
            text-align: right;
            /* Align to the right */
        }

        .dataTables_wrapper .dataTables_length .custom-select {
            display: inline-block;
            vertical-align: middle;
            margin-left: 5px;
            width: auto;
        }

        /* Search input */
        #search-input {
            width: 200px;
            margin-left: 5px;
        }

        .dataTables_wrapper .dataTables_filter label {
            display: inline-block;
            vertical-align: middle;
            margin-left: 5px;
        }

        .dataTables_wrapper .dataTables_filter input[type="search"] {
            display: inline-block;
            vertical-align: middle;
            margin-left: 5px;
            width: auto;
        }

        /* Show entries dropdown */
        .dataTables_wrapper .dataTables_length {
            margin-top: 10px;
            text-align: right;
            /* Align to the right */
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }


        /* Extra styles for the cancel button */
        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        /* Center the image and position the close button */
        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
            position: relative;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
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
    </style>
</head>

<body>
    <!-- Side Navigation -->
    <div id="mySidebar" class="sidebar">
        <img src="/fkedusearch/img/picture9.png" style="height:100px; width:100%; style=" margin-top:100px; ">


        <a class=" active" href="#user" align="left">
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

        <a href="#complaint" align="left">
            <img src="/fkedusearch/img/picture10.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span
                style="vertical-align: middle;">&nbsp&nbsp
                Complaint</span>
        </a>
    </div>

    <body>
        <div id="main">
            <img src="/fkedusearch/banner.png" style="height:200px" width="100%">
            <button class="openbtn" onclick="toggleNav()">☰</button>
            <div class="content">
                <div style="margin-top: 30px; margin-left: 10px;">
                    <h2 align="center"><b>COMPLAINT</b></h2>
                    <p align="center"><b>Admin Page</b></p>

                    <div class="content" style="
                    padding-top: 10px;
                    padding-right: 100px;
                    padding-bottom: 50px;
                    padding-left: 100px;">
                        <div class="w3-container custom-container"
                            style="background-color: #F2F2F2; padding-top: 20px; padding-bottom: 20px;">
                            <!-- Filter -->
                            <div style="margin-bottom: 10px; margin-top: 10px">
                                <label for="filter">Filter by Complaint Type:</label>

                                <select name="complaint_types" onchange="filterTable()" id="filter-complaint-types"
                                    class="form-control">
                                    <option value="all">All</option>
                                    <option value="Unsatisfied Expert's Feedback">Unsatisfied Feedback</option>
                                    <option value="Wrongly Assigned Research Area">Wrong Research Area</option>
                                    <option value="Others">Others</option>
                                </select>


                            </div>

                            <!-- Sort -->
                            <div style="margin-bottom: 10px;">
                                <label for="sort">Sort by:</label>
                                <select name="sort" onchange="sortTable()" id="sort-complaint-date"
                                    class="form-control">
                                    <option value="default">Default</option>
                                    <option value="day">Particular Day</option>
                                    <option value="week">Week</option>
                                    <option value="month">Month</option>
                                </select>
                            </div>

                            <?php
                            // Connect to the database server.
                            $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

                            // Select the database.
                            mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

                            // Check if the form is submitted
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Get the complaint ID and status from the form
                                $complaint_id = $_POST["complaint_id"];
                                $complaint_status = $_POST["complaint_status"];

                                // Update the status in the database
                                $update_query = "UPDATE complaint SET complaint_status='$complaint_status' WHERE complaint_id='$complaint_id'";
                                $update_result = mysqli_query($link, $update_query);

                                if ($update_result) {
                                    echo '<script>alert("Status updated successfully.")</script>';
                                } else {
                                    echo "Error updating status: " . mysqli_error($link);
                                }
                            }

                            // SQL query
                            $query = "SELECT * FROM complaint";

                            // Execute the query
                            $result = mysqli_query($link, $query);

                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    echo '
                            <table border="1" class="table table-bordered" id="complaint-table">  </br>
                                <thead>
                                    <tr align="center">
                                        <th>No.</th>
                                        <th>Complaint Name</th>
                                        <th>Date and Time</th>
                                        <th>Complaint Type</th>
                                        <th>Complaint Detail</th>
                                        <th>Actions</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>';

                                    $count = 1;

                                    // Output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $complaint_id = $row["complaint_id"];
                                        $complaint_name = $row["complaint_name"];
                                        $complaint_datetime = $row["complaint_datetime"];
                                        $complaint_types = $row["complaint_types"];
                                        $complaint_desc = $row["complaint_desc"];
                                        $complaint_status = $row["complaint_status"];

                                        echo '
                                <tr>
                                <td>' . $count . '</td>
                                <td>' . $complaint_name . '</td>
                                <td>' . $complaint_datetime . '</td>
                                <td class="complaint-types" id="complaint-type-' . $complaint_id . '">' . $complaint_types . '</td>
                                <td>' . $complaint_desc . '</td>
                                    <td> 
                                        <a href="updateComplaint.php?id=' . $complaint_id . '"><img src="edit.png" alt="Edit Icon" style="height: 20px; width: 20px;"></a>
                                        &nbsp;&nbsp;
                                        <a href="deleteComplaint.php?id=' . $complaint_id . '"><img src="delete.png" alt="Edit Icon" style="height: 20px; width: 20px;"></a>                        
                                    </td>
                                    <td class="complaint-status">
                                        <form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
                                            <input type="hidden" name="complaint_id" value="' . $complaint_id . '">
                                            <select name="complaint_status">
                                                <option value="Investigation" ' . ($complaint_status == "Investigation" ? "selected" : "") . '>Investigation</option>
                                                <option value="On Hold" ' . ($complaint_status == "On Hold" ? "selected" : "") . '>On Hold</option>
                                                <option value="Resolved" ' . ($complaint_status == "Resolved" ? "selected" : "") . '>Resolved</option>
                                            </select>
                                            <input type="submit" class="btn btn-primary" style="background-color: #69C9C4; border: none;" value="Update">
                                        </form>
                                    </td>
                                </tr>';

                                        $count++;
                                    }

                                    echo '
                                </tbody>
                            </table>';

                                    // Initialize DataTable
                                    echo '<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $("#complaint-table").DataTable();
                            });
                        </script>';
                                } else {
                                    echo "0 results";
                                }
                            } else {
                                echo "Error executing the query: " . mysqli_error($link);
                            }

                            // Close the database connection
                            mysqli_close($link);
                            ?>
                            <div align="right">

                                <button type="submit" class="btn btn-primary"
                                    style="background-color: #69C9C4; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);"
                                    onclick="document.getElementById('id01').style.display='block'"
                                    style="width:auto;">REPORT BY COMPLAINT TYPES
                                </button>

                                <div id="id01" class="modal">

                                    <form class="modal-content animate" action="/action_page.php" method="post">
                                        <div class="imgcontainer">
                                            <span onclick="document.getElementById('id01').style.display='none'"
                                                class="close" title="Close Modal">&times;</span>
                                        </div>

                                        <div class="container">
                                            <canvas id="complaintChart" style="width:50%;max-width:1000px"></canvas>

                                            <?php
                                            // Connect to the database server.
                                            $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

                                            // Select the database.
                                            mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

                                            // SQL query
                                            $query = "SELECT * FROM complaint";

                                            // Execute the query
                                            $result = mysqli_query($link, $query);

                                            if ($result) {
                                                // Initialize an empty array to store the complaint type counts
                                                $complaintTypeCounts = array();

                                                // Iterate over the result set and count the occurrences of each complaint type
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $complaintType = $row["complaint_types"];

                                                    if (isset($complaintTypeCounts[$complaintType])) {
                                                        $complaintTypeCounts[$complaintType]++;
                                                    } else {
                                                        $complaintTypeCounts[$complaintType] = 1;
                                                    }
                                                }

                                                // Extract the complaint types and counts as separate arrays
                                                $complaintTypes = array_keys($complaintTypeCounts);
                                                $complaintCounts = array_values($complaintTypeCounts);
                                            }
                                            ?>

                                            <script>
                                                // Retrieve the complaint types and counts from PHP
                                                var complaintTypes = <?php echo isset($complaintTypes) ? json_encode($complaintTypes) : '[]'; ?>;
                                                var complaintCounts = <?php echo isset($complaintCounts) ? json_encode($complaintCounts) : '[]'; ?>;

                                                // Define an array of colors for differentiating complaint types
                                                var colors = ['rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(153, 102, 255, 0.6)'];

                                                // Create an array to store dataset objects
                                                var datasets = [];

                                                // Iterate over the complaint types and counts to create dataset objects
                                                for (var i = 0; i < complaintTypes.length; i++) {
                                                    var dataset = {
                                                        label: complaintTypes[i],
                                                        data: [complaintCounts[i]],
                                                        backgroundColor: colors[i % colors.length], // Assign a color from the array based on index
                                                        borderColor: 'rgba(255, 255, 255, 1)',
                                                        borderWidth: 1,
                                                    };

                                                    datasets.push(dataset);
                                                }

                                                // Get the canvas element
                                                var ctx = document.getElementById('complaintChart').getContext('2d');

                                                // Create the chart using Chart.js
                                                new Chart(ctx, {
                                                    type: 'bar',
                                                    data: {
                                                        labels: ['Complaint Types'],
                                                        datasets: datasets
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true,
                                                                stepSize: 1
                                                            }
                                                        }
                                                    }
                                                });
                                            </script>
                                        </div>


                                    </form>
                                </div>

                                <button type="submit" class="btn btn-primary"
                                    style="background-color:  #69C9C4; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);"
                                    onclick="window.location.href = 'testing.php';">REPORT BY TIME
                                    PERIOD</button>



                            </div>


                        </div>
                    </div>
                </div>

            </div>
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

            <script>
                function filterTable() {
                    var filter = document.getElementById("filter-complaint-types").value;  // Get the selected complaint type filter
                    var table = document.getElementById("complaint-table");  // Get the table element

                    for (var i = 1; i < table.rows.length; i++) {
                        var complaintTypeCell = table.rows[i].querySelector(".complaint-types");  // Get the cell containing the complaint type
                        var complaintTypeId = complaintTypeCell.getAttribute("id").replace("complaint-type-", "");  // Extract the complaint ID

                        if (filter === "all" || complaintTypeCell.textContent === filter) {
                            table.rows[i].style.display = "";  // Show the row
                        } else {
                            table.rows[i].style.display = "none";  // Hide the row
                        }
                    }
                }

                // Get the modal
                var modal = document.getElementById('id01');

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function (event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }

                // Get the modal
                var modal = document.getElementById('id02');

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function (event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>

        </div>

        
        </div>
    </body>

</html>