<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
</head>

<body>

    <img src="/fkedusearch/banner.png" style="height:200px" width="100%">

    <div class="content">
        <div style="margin-top: 30px; margin-left: 10px;">
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
                if (mysqli_num_rows($result) > 0) {
                    echo '
                    <table border="1" class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Complaint Name</th>
                    <th>Date and Time</th>
                    <th>Complaint Type</th>
                    <th>Complaint Detail</th>
                    <th>Actions</th>
                </tr>';

                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $complaint_id = $row["complaint_id"];
                        $complaint_name = $row["complaint_name"];
                        $complaint_datetime = $row["complaint_datetime"];
                        $complaint_types = $row["complaint_types"];
                        $complaint_desc = $row["complaint_desc"];

                        echo "<tr>
                    <td>$complaint_id</td>
                    <td>$complaint_name</td>
                    <td>$complaint_datetime</td>
                    <td>$complaint_types</td>
                    <td>$complaint_desc</td>
                    <td>
                    <a href='updateComplaint.php?id=$complaint_id'><img src='edit.png' alt='Edit Icon' style='height: 20px; width: 20px;'></a>
                    &nbsp;&nbsp;
                    <a href='deleteComplaint.php?id=$complaint_id'><img src='delete.png' alt='Edit Icon' style='height: 20px; width: 20px;'></a>                        
                    </td>
                </tr>";
                    }

                    echo '</table>';
                } else {
                    echo "0 results";
                }
            } else {
                echo "Error executing the query: " . mysqli_error($link);
            }

            // Close the database connection
            mysqli_close($link);
            ?>
        </div>
    </div>

</body>

</html>