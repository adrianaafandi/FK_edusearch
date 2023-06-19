<!DOCTYPE html>
<html>

<head>
    <title>FK_EDUSEARCH</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="filter">Filter by Time Period:</label>
            <select name="filter" onchange="this.form.submit()">
                <option value="">All</option>
                <option value="day" <?php if ($filter === "day") echo "selected"; ?>>Last 24 Hours</option>
                <option value="week" <?php if ($filter === "week") echo "selected"; ?>>Last 7 Days</option>
                <option value="month" <?php if ($filter === "month") echo "selected"; ?>>Last 30 Days</option>
            </select>
        </form>
    </div>

    <canvas id="complaintChart" style="width:50%;max-width:700px"></canvas>

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
