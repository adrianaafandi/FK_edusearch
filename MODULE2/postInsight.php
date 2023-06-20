<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

// Set the default filter option to month
$filterOption = 'month';
$selectedDate = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the filter option is set
    if (isset($_POST['filter_option'])) {
        $filterOption = $_POST['filter_option'];
    }

    // Check if the selected date is set
    if (isset($_POST['selected_date'])) {
        $selectedDate = $_POST['selected_date'];
    }
}

// Fetch the posts count based on the filter option
$query = '';
if ($filterOption === 'day') {
    // Filter by day
    if (!empty($selectedDate)) {
        $selectedDate = date('Y-m-d', strtotime($selectedDate));
        $query = "SELECT DATE_FORMAT(date, '%Y-%m-%d') AS date, COUNT(*) AS count FROM discussion WHERE DATE(date) = '$selectedDate' GROUP BY date";
    }
} elseif ($filterOption === 'week') {
    // Filter by week
    if (!empty($selectedDate)) {
        $selectedDate = date('Y-m-d', strtotime($selectedDate));
        $weekStart = date('Y-m-d', strtotime('last Sunday', strtotime($selectedDate)));
        $weekEnd = date('Y-m-d', strtotime('next Saturday', strtotime($selectedDate)));
        $query = "SELECT DATE_FORMAT(date, '%Y-%m-%d') AS date, COUNT(*) AS count FROM discussion WHERE DATE(date) BETWEEN '$weekStart' AND '$weekEnd' GROUP BY date";
    }
} else {
    // Filter by month
    $query = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(*) AS count FROM discussion GROUP BY month";
}

$result = mysqli_query($link, $query);

// Prepare the data for the chart
$labels = [];
$postCounts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $label = $row['date'] ?? $row['month'];
    $count = $row['count'];
    $labels[] = $label;
    $postCounts[] = $count;
}

// Convert the PHP arrays to JSON format for JavaScript usage
$labelsJSON = json_encode($labels);
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

        <form method="POST" action="">
            <div class="form-group">
                <label for="selected_date">Choose a Date:</label>
                <input type="date" class="form-control" id="selected_date" name="selected_date" value="<?php echo htmlentities($selectedDate); ?>" required>
            </div>
            <div class="form-group">
                <label for="filter_option">Filter Option:</label>
                <select class="form-control" id="filter_option" name="filter_option">
                    <option value="day" <?php if ($filterOption === 'day') echo 'selected'; ?>>Day</option>
                    <option value="week" <?php if ($filterOption === 'week') echo 'selected'; ?>>Week</option>
                    <option value="month" <?php if ($filterOption === 'month') echo 'selected'; ?>>Month</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <br>

        <canvas id="myChart"></canvas>
    </div>

    <script>
        var labels = <?php echo $labelsJSON; ?>;
        var postCounts = <?php echo $postCountsJSON; ?>;

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: labels,
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
                            text: "Date"
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