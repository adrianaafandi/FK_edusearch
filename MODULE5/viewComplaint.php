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
        <!-- Content -->
        <div class="content" style="
        padding-top: 50px;
        padding-right: 200px;
        padding-bottom: 50px;
        padding-left: 200px;">
            <div class="w3-container custom-container"
                style="background-color: #F2F2F2; padding-top: 20px; padding-bottom: 20px;">
                <h2 align="left"><b>COMPLAINT</b></h2>
                <p style="margin-top: 5px;">We are here to assist you!</p>
                <hr>
                <div align="center">
                    <h3><span class="badge badge-danger" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);">Status:
                            Investigation</span></h3>
                </div>
                <?php
                // Retrieve the complaint data from the URL parameters
                $complaint_name = isset($_GET['complaint_name']) ? $_GET['complaint_name'] : '';
                $complaint_datetime = isset($_GET['complaint_datetime']) ? $_GET['complaint_datetime'] : '';
                $complainttype_name = isset($_GET['complainttype_name']) ? $_GET['complainttype_name'] : '';
                $complaint_desc = isset($_GET['complaint_desc']) ? $_GET['complaint_desc'] : '';

                // Display the complaint details
                echo "<p>Complainant's Name: $complaint_name</p>";
                echo "<p>Date and Time: $complaint_datetime</p>";
                echo "<p>Complaint Type: $complainttype_name</p>";
                echo "<p>Complaint Details: $complaint_desc</p>";
                ?>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" style="background-color: #286291; border: none;" onclick="redirectToPage()">HOME</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function redirectToPage() {
            window.location.href = "addComplaint.php";
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