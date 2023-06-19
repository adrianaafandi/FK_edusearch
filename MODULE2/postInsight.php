<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

// Fetch the posts count by month from the database
$query = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(*) AS count FROM discussion GROUP BY month";
$result = mysqli_query($link, $query);

// Prepare the data for the chart
$months = [];
$postCounts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $month = $row['month'];
    $count = $row['count'];
    $months[] = $month;
    $postCounts[] = $count;
}

// Convert the PHP arrays to JSON format for JavaScript usage
$monthsJSON = json_encode($months);
$postCountsJSON = json_encode($postCounts);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <title>FK_EDUSEARCH</title>
</head>

<body>
    <?php include '../UserSideBar/User_sidebar.php' ?>

    <div class="content" style="margin-top: 10px; margin-left: 10px;">
        <h2><b>POST INSIGHTS</b></h2><br>
        <canvas id="myChart"></canvas>
    </div>

    <script>
        var months = <?php echo $monthsJSON; ?>;
        var postCounts = <?php echo $postCountsJSON; ?>;

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: months,
                datasets: [{
                    label: "Total Posts",
                    data: postCounts,
                    backgroundColor: "rgba(54, 162, 235, 0.6)"
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Month"
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Total Posts"
                        },
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>