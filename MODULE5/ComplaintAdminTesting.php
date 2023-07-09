<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
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
    </style>
</head>

<body>

    <div id="mySidebar" class="sidebar">
        <img src="/fkedusearch/img/picture9.png" style="height:100px; width:100%; style=" margin-top:10px;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="#">Home</a>
        <a href="#">Browse</a>
        <a href="#">Search</a>
        <a href="#">Contact</a>
        <a href="#">About</a>
    </div>

    <div id="main">
        <button class="openbtn" onclick="openNav()">☰ Open Sidebar</button>
        <table id="complaint-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2022-06-15</td>
                    <td>Open</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2022-06-16</td>
                    <td>Resolved</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2022-06-17</td>
                    <td>Open</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>2022-06-18</td>
                    <td>Open</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>2022-06-19</td>
                    <td>Resolved</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#complaint-table').DataTable();

            $('#complaint-status-filter').on('change', function () {
                var status = $(this).val();
                $('#complaint-table').DataTable().columns(2).search(status).draw();
            });
        });

        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</body>
</html>
