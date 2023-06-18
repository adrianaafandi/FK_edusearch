<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

// Fetch the posts count by month from the database
$query = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(*) AS count FROM discussion GROUP BY month";
$result = mysqli_query($link, $query);

// Prepare the data for the chart
$xValues = [];
$yValues = [];
$barColors = [];

while ($row = mysqli_fetch_assoc($result)) {
    $month = $row['month'];
    $count = $row['count'];
    $xValues[] = $month;
    $yValues[] = $count;
    // Generate random bar colors
    $barColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

// Convert the PHP arrays to JSON format for JavaScript usage
$xValuesJSON = json_encode($xValues);
$yValuesJSON = json_encode($yValues);
$barColorsJSON = json_encode($barColors);
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
        var xValues = <?php echo $xValuesJSON; ?>;
        var yValues = <?php echo $yValuesJSON; ?>;
        var barColors = <?php echo $barColorsJSON; ?>;

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        suggestedMax: Math.max(...yValues) + 5
                    }
                }
            }
        });
    </script>
</body>

</html>
