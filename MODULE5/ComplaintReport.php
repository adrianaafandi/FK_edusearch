<!DOCTYPE html>
<html>

<head>
    <title>Complaint Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <canvas id="complaintChart" style="width:50%;max-width:1000px"></canvas>

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

    <script>
        // Retrieve the complaint types and counts from PHP
        var complaintTypes = <?php echo isset($complaintTypes) ? json_encode($complaintTypes) : '[]'; ?>;
        var complaintCounts = <?php echo isset($complaintCounts) ? json_encode($complaintCounts) : '[]'; ?>;

        // Define an array of colors for differentiating complaint types
        var colors = ['rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(153, 102, 255, 0.6)'];

        // Create an array to store dataset objects
        var datasets = [];

        // Iterate over the complaint types and counts to create dataset objects
        for (var i = 0; i < complaintTypes.length; i++) {
            var dataset = {
                label: complaintTypes[i],
                data: [complaintCounts[i]],
                backgroundColor: colors[i % colors.length], // Assign a color from the array based on index
                borderColor: 'rgba(255, 255, 255, 1)',
                borderWidth: 1,
            };

            datasets.push(dataset);
        }

        // Get the canvas element
        var ctx = document.getElementById('complaintChart').getContext('2d');

        // Create the chart using Chart.js
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Complaint Types'],
                datasets: datasets
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>
</body>

</html>
