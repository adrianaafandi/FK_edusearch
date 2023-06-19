<!DOCTYPE html>
<html>

<head>
    <title>Expert Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include '../ExpertSideBar/Expert_sidebar.php'; ?>
    <?php
    // Connect to the database server.
    $link = mysqli_connect("localhost", "root", "", "fkedusearch", "8111") or die(mysqli_connect_error());

    // Select the database
    mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

    // Query to retrieve the total count of research and list of publications for a specific expert
    $query = "SELECT t.total_research, t.total_publication FROM total AS t WHERE t.id = 3";
    $result = mysqli_query($link, $query);

    // Initialize variables to store the total count of research and list of publications
    $totalResearch = 0;
    $totalPublication = 0;

    // Process the query result
    if ($row = mysqli_fetch_assoc($result)) {
        $totalResearch = $row['total_research'];
        $totalPublication = $row['total_publication'];
    }

    // Close the database connection
    mysqli_close($link);
    ?>

    <canvas id="chart"></canvas>

    <script>
        // Retrieve the data from PHP
        var totalResearch = <?php echo $totalResearch; ?>;
        var totalPublication = <?php echo $totalPublication; ?>;

        // Create a chart using Chart.js
        var ctx = document.getElementById('chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['', ''],
                datasets: [{
                        label: 'Research Area',
                        data: [totalResearch],
                        backgroundColor: 'rgba(54, 162, 235, 0.5)', // Blue color
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'List of Publications',
                        data: [totalPublication],
                        backgroundColor: 'rgba(255, 99, 132, 0.5)', // Pink color
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Research Area and List of Publications'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Expert Research Area and List of Publications',
                        padding: {
                            top: 100,
                            bottom: 30
                        }
                    },
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            color: 'black'
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>