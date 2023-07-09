<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database.
mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

$idURL = isset($_GET['id']) ? $_GET['id'] : '';

// Fetch the record to display on the page
$query = "SELECT * FROM complaint WHERE complaint_id = '$idURL'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);

$complaint_name = isset($row["complaint_name"]) ? $row["complaint_name"] : '';
$complaint_datetime = isset($row["complaint_datetime"]) ? $row["complaint_datetime"] : '';
$complaint_types = isset($row["complaint_types"]) ? $row["complaint_types"] : '';
$complaint_desc = isset($row["complaint_desc"]) ? $row["complaint_desc"] : '';
$complaint_id = isset($row["complaint_id"]) ? $row["complaint_id"] : '';

mysqli_close($link);
?>

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

    <img src="/fkedusearch/banner.png" style="height:200px" width="100%">

    <div class="content">
        <div style="margin-top: 30px; margin-left: 10px;">
            <form action="deleteAction.php?id=<?php echo $complaint_id; ?>" method="post" class="row g-3">
                <h2 align="center"><b>MANAGE COMPLAINT</b></h2>
                <p align="center" style="margin-top: 0px;"><b>Admin Page - Delete Complaint</b></p>
                <div class="content" style="
                        padding-top: 10px;
                        padding-right: 100px;
                        padding-bottom: 50px;
                        padding-left: 100px;">
                    <div class="w3-container custom-container"
                        style="background-color: #F2F2F2; padding-top: 20px; padding-bottom: 20px;">
                        <div class="mb-3 row" style="margin-top: 10px;">
                            <label for="complaint_name" class="col-sm-2 col-form-label">Complainant's Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="complaint_name" name="complaint_name"
                                    value="<?php echo $complaint_name; ?>" readonly>
                            </div>
                            <br><br>

                            <label for="complaint_datetime" class="col-sm-2 col-form-label">Date and Time:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="complaint_datetime"
                                    name="complaint_datetime" value="<?php echo $complaint_datetime; ?>" readonly>
                            </div>
                            <br><br>

                            <label for="complaint_types" class="col-sm-2 col-form-label">Complaint Type:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="complaint_types" name="complaint_types"
                                    value="<?php echo $complaint_types; ?>" readonly>
                            </div>
                            <br><br>

                            <label for="complaint_desc" class="col-sm-2 col-form-label">Complaint Details:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="complaint_desc" name="complaint_desc" rows="3"
                                    readonly><?php echo $complaint_desc; ?></textarea>
                            </div>
                            <br><br><br><br>

                            <input type="hidden" name="id" value="<?php echo $complaint_id; ?>">

                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"
                                style="background-color:  #69C9C4; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">DELETE</button>

                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger" style="background-color:  #A6A6A6; border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" onclick="goBack()">CANCEL</button>
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