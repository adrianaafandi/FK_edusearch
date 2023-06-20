<?php
ob_start(); // Start output buffering
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../public/logoump.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>FK_EDUSEARCH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>

<body>
    <div id="mySidebar" class="sidebar">
        <img src="../public/picture9.png" style="height:100px; width:100%; margin-top:100px;">

        <a href="../MODULE2/userInfo.php" align="left">
            <img src="../public/picture4.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span style="vertical-align: middle;">&nbsp&nbsp
                User</span>
        </a>

        <a href="../MODULE2/view.php" align="left">
            <img src="../public/picture6.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span style="vertical-align: middle;">&nbsp&nbsp
                Discussion</span>
        </a>

        <a href="postInsight.php" align="left">
            <i class="fas fa-chart-bar" style="vertical-align: middle;"></i>
            <span style="vertical-align: middle;">&nbsp;&nbsp;&nbsp;&nbsp;Insights</span>
        </a>


        <a href="report.php" align="left" >
        <img src="../public/picture8.png"
                style="vertical-align: middle; height: 30px; width: 30px;"> <span style="vertical-align: middle;">&nbsp&nbsp

                Report</span>
        </a>

        <a href="../MODULE5/addComplaint.php" align="left">
            <img src="../public/picture10.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span style="vertical-align: middle;">&nbsp&nbsp
                Complaint</span>
        </a>

        <a href="userFeedback.php" align="left">
            <img src="../public/picture10.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span style="vertical-align: middle;">&nbsp&nbsp
                Logout</span>
        </a>

    </div>

    <div id="main">
        <img src="../public/banner.png" style="height:200px" width="100%">

        <button class="openbtn" onclick="toggleNav()">☰</button>
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

</body>

</html>