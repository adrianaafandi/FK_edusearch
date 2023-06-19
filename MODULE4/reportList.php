<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    .update-btn,
    .delete-btn {
      padding: 4px 8px;
      border: none;
      cursor: pointer;
      font-size: 14px;
    }

    .update-btn {
      background-color: #4CAF50;
      color: white;
    }

    .delete-btn {
      background-color: #f44336;
      color: white;
    }

  </style>
</head>

<body>
  <?php include '../AdminSideBar/Admin_sidebar.php'; ?>


  <?php 
$link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

$query = "SELECT r.report_id, r.reporter_name, r.datentime, r.type_id, t.type_type, r.reportDetails, r.status
          FROM report r
          INNER JOIN type t ON r.type_id = t.type_id";

            // Execute the query
            $result = mysqli_query($link, $query);
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                  echo '
                  <table border="1" class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Name of Reporter</th>
                    <th>Date</th>
                    <th>Report Type</th>
                    <th>Report Detail</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>';

                  // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $report_id = $row["report_id"];
                        $reporter_name = $row["reporter_name"];
                        $datentime = $row["datentime"];
                        $type_id = $row["type_id"];
                        $type_type = $row["type_type"];
                        $reportDetails = $row["reportDetails"];
                        $status = $row["status"];

                        echo "<tr>
                    <td>$report_id</td>
                    <td>$reporter_name</td>
                    <td>$datentime</td>
                    <td>$type_type  </td>
                    <td>$reportDetails</td>
                    <td>$status</td>
                    <td>
                    <div class='dropdown'>
                      <button class='btn btn-primary dropdown-toggle' type='button' data-bs-toggle='dropdown'
                        aria-expanded='false'>
                        Update Status
                      </button>
                      <ul class='dropdown-menu'>
                        <li><a class='dropdown-item' href='updateStatus.php?report_id=$report_id&status=RESOLVED'>Resolved</a></li>
                        <li><a class='dropdown-item' href='updateStatus.php?report_id=$report_id&status=ON HOLD'>On Hold</a></li>
                        <li><a class='dropdown-item' href='updateStatus.php?report_id=$report_id&status=IN INVESTIGATION'>In Investigation</a></li>
                      </ul>
                    </div>
                    <a href='deleteReport.php?id=$report_id'><img src='../public/delete.png' alt='Edit Icon' style='height: 20px; width: 20px;'></a>                        
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-pzj7d/SvHLRN+RASnxlZ+p9bZI2n6sR9SNL9YI7g9uIhFxS1qBBtA3pQUijvIya/"
  crossorigin="anonymous"></script>

</body>

</html>
