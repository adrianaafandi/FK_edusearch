<?php
// Start the session
session_start();

// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database.
mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

// Assuming the user's ID is stored in the session variable 'complaint_id'.
if (isset($_SESSION['complaint_id'])) {
    $complaint_id = $_SESSION['complaint_id'];

    // SQL query with a WHERE clause to filter results by complaint_id
    $query = "SELECT * FROM complaint WHERE complaint_id = '" . mysqli_real_escape_string($link, $complaint_id) . "'";

    // Execute the query
    $result = mysqli_query($link, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $complaint_name = $row["complaint_name"];
                $complaint_datetime = $row["complaint_datetime"];
                $complaint_types = $row["complaint_types"];
                $complaint_desc = $row["complaint_desc"];
                ?>
                <table>
                    <tr>
                        <td>Complaint's Name: <?php echo $complaint_name; ?></td><br>
                    </tr>
                    <tr>
                        <td>Date and Time: <?php echo $complaint_datetime; ?></td><br>
                    </tr>
                    <tr>
                        <td>Complaint Type: <?php echo $complaint_types; ?></td><br>
                    </tr>
                    <tr>
                        <td>Complaint Details: <?php echo $complaint_desc; ?></td><br>
                    </tr>
                    <tr>
                        <td>
                            <a href="edit.php?id=<?php echo $complaint_id; ?>">Ubah</a> ||
                            <a href="delete.php?id=<?php echo $complaint_id; ?>">Padam</a>
                        </td>
                    </tr>
                </table>
                <?php
            }
        } else {
            echo "0 results";
        }
    } else {
        echo "Error executing the query: " . mysqli_error($link);
    }
} else {
    echo "User ID not set in session.";
}

// Close the database connection
mysqli_close($link);
?>