<!DOCTYPE html>
<html>

<head>
    <title>FK_EDUSEARCH</title>
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
    <?php
    // Connect to the database server.
    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

    // Select the database.
    mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

    // Get the selected time period filter
    $filter = $_POST["filter"] ?? "";

    // Prepare the SQL query based on the selected filter
    $query = "SELECT complaint_datetime, complaint_types FROM complaint";
    if ($filter === "day") {
        $query .= " WHERE complaint_datetime >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
    } elseif ($filter === "week") {
        $query .= " WHERE complaint_datetime >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
    } elseif ($filter === "month") {
        $query .= " WHERE complaint_datetime >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
    }

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
    <img src="/fkedusearch/banner.png" style="height:200px" width="100%">
    <h2 align="center" style="margin-top: 50px;"><b>MANAGE COMPLAINT</b></h2>
    <p align="center"><b>Admin Page - Report By Time Period</b></p>
    <div class="content" style="padding-left: 500px; float: center;">


        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <label for="filter" style="padding-bottom: 10px;">Filter by Time Period:</label>
            <select name="filter" onchange="this.form.submit()">
                <option value="">All</option>
                <option value="day" <?php if ($filter === "day")
                    echo "selected"; ?>>Last 24 Hours</option>
                <option value="week" <?php if ($filter === "week")
                    echo "selected"; ?>>Last 7 Days</option>
                <option value="month" <?php if ($filter === "month")
                    echo "selected"; ?>>Last 30 Days</option>
            </select>
        </form>
        <canvas id="complaintChart" style="width:50%; max-width:700px;"></canvas>
        <div class="d-flex justify-content-center" style="padding-right:500px;">
            <button type="button" class="btn btn-danger"
                style="background-color:  #A6A6A6; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);"
                onclick="redirectToPage()">BACK</button>
        </div>
    </div>

    <script>
        function redirectToPage() {
                window.location.href = "ComplaintAdmin.php";
            }
    </script>

    <script>
        // Retrieve the complaint types and counts from PHP
        var complaintTypes = <?php echo isset($complaintTypes) ? json_encode($complaintTypes) : '[]'; ?>;
        var complaintCounts = <?php echo isset($complaintCounts) ? json_encode($complaintCounts) : '[]'; ?>;

        // Define an array of colors for differentiating complaint types
        var colors = ['rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(153, 102, 255, 0.6)'];

        // Create the chart
        var ctx = document.getElementById('complaintChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: complaintTypes,
                datasets: [{
                    label: 'Complaints',
                    data: complaintCounts,
                    backgroundColor: colors
                }]
            },
            options: {
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>

</html>