<?php
include '../AdminSideBar/Admin_sidebar.php';

// Establish a database connection
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

// Check if the discussion_id is provided in the URL parameter
if (isset($_GET['discussion_id'])) {
    $discussion_id = $_GET['discussion_id'];

    // Fetch the discussion details from the database
    $discussionQuery = "SELECT * FROM discussion WHERE discussion_id = '$discussion_id'";
    $discussionResult = mysqli_query($link, $discussionQuery);
    if ($discussionRow = mysqli_fetch_assoc($discussionResult)) {
        $title = $discussionRow['title'];
        $content = $discussionRow['content'];

        // Display the discussion title and content in a post container
        echo "<div class='post-container'>";
        echo "<div class='post'>";
        echo "<h2>$title</h2>";
        echo "<p>$content</p>";
        echo "</div>";
        echo "</div>";
    }
}

// Fetch the expert details from the database
$expertQuery = "SELECT * FROM expert";
$expertResult = mysqli_query($link, $expertQuery);
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/bootstrap-icons.min.css" rel="stylesheet">
    <title>FK_EDUSEARCH</title>
    <style>
        .post-container {
            margin-bottom: 30px;
        }

        .post {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f7f7f7;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .post h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .post p {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .post button {
            margin-right: 20px;
        }

        .comment-grid {
            margin-top: 30px;
            margin-left: 10px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .comment-container {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f7f7f7;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 1240px;
            /* Adjust the width based on your preference */
            box-sizing: border-box;
        }

        .comment-container h4 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .comment-list {
            margin-top: 20px;
        }

        .comment {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <br>
    <h3><b>&nbsp;&nbsp;ASSIGNING DISCUSSION</b></h3>
    <br>

    <form class="row g-3" method="POST" action="">
        <div class="mb-3 row" style="margin-top: 10px; margin-left: 10px;">
            <label for="expert_id" class="col-sm-2 col-form-label">Expert Name</label>
            <div class="col-sm-10">
                <select class="form-select" id="expert_id" name="expert_id" aria-label="Default select example">
                    <option value="">Select expert name</option>
                    <?php
                    // Loop through the experts and generate the options
                    while ($expertRow = mysqli_fetch_assoc($expertResult)) {
                        $expert_id = $expertRow['expert_id'];
                        $expert_name = $expertRow['expert_name'];
                        echo "<option value='$expert_id'>$expert_name</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="content" style="margin-top: 10px; margin-left: 10px;">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">ASSIGN</button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-danger" onclick="window.location.href = 'viewAdmin.php';">CANCEL</button>
            </div>
        </div>
    </form>
    <br><br>

    <?php
    // Handle the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if expert_id is set
        if (isset($_POST['expert_id'])) {
            $expert_id = $_POST['expert_id'];

            // Update the discussion with the assigned expert in the database
            $updateQuery = "UPDATE discussion SET expert_id = '$expert_id' WHERE discussion_id = '$discussion_id'";
            $updateResult = mysqli_query($link, $updateQuery);

            if ($updateResult) {
                // Update successful, redirect to viewAdmin.php
                header("Location: viewAdmin.php");
                exit();
            } else {
                // Update failed, display error message
                echo "<div class='alert alert-danger' role='alert'>Error assigning discussion to expert. Please try again.</div>";
            }
        }
    }

    // Close the database connection
    mysqli_close($link);
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>