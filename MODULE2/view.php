<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

// Fetch the categories from the database
$categoryQuery = "SELECT * FROM category";
$categoryResult = mysqli_query($link, $categoryQuery);

// Fetch the posts from the database based on the selected category
$category_id = $_POST['category_id'] ?? ''; // Get the selected category ID from the form

// Construct the post query
$postQuery = "SELECT * FROM discussion";
if (!empty($category_id)) {
    $postQuery .= " WHERE category_id = $category_id";
}
$postResult = mysqli_query($link, $postQuery);

// Check if any posts are found
$numPosts = mysqli_num_rows($postResult);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>FK_EDUSEARCH</title>
</head>

<body>
    <?php include '../UserSideBar/User_sidebar.php'?>

    <div class="content" style="margin-top: 10px; margin-left: 10px;">
        <h2><b>YOUR POST</b></h2><br>
        <button type="button" class="btn btn-primary" onclick="window.location.href = 'create.php';">+ NEW POST</button>
        <br><br><br>
        <form class="row g-3" method="POST" action="">
            <div class="mb-3 row" style="margin-top: 10px;">
                <label for="category_id" class="col-sm-2 col-form-label" style="font-size: 24px;"><b>CATEGORY</b></label>
                <div class="col-sm-10">
                    <select class="form-select form-select-lg mb-3" id="category_id" name="category_id" aria-label="Default select example" onchange="this.form.submit()">
                        <option value="">All categories</option>
                        <?php
                        // Loop through the categories and generate the options
                        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                            $cat_id = $categoryRow['category_id'];
                            $cat_type = $categoryRow['category_type'];
                            $selected = ($cat_id == $category_id) ? 'selected' : '';
                            echo "<option value='$cat_id' $selected>$cat_type</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="row" style="margin-left: 10px;">
        <?php
        // Display the post titles with edit and delete buttons
        if ($numPosts > 0) {
            while ($row = mysqli_fetch_assoc($postResult)) {
                $discussion_id = $row['discussion_id'];
                $title = $row['title'];

                echo "<div class='col-sm-3'>";
                echo "<table class='table table-bordered'>";
                echo "<thead><tr><th colspan='3'>$title</th></tr></thead>";
                echo "<tbody>";
                echo "<tr><td><button class='btn btn-danger' onclick='deletePost($discussion_id)'><i class='fas fa-trash'></i></button></td>";
                echo "<td><button class='btn btn-primary' onclick='editPost($discussion_id)'><i class='fas fa-edit'></i></button></td>";
                echo "<td><button class='btn btn-success' onclick='viewPost($discussion_id)'><i class='fas fa-eye'></i></button></td></tr>";
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
        } else {
            echo "<p>No discussion post found.</p>";
        }

        // Close the database connection
        mysqli_close($link);
        ?>
    </div>
    <br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>

    <script>
        function deletePost(discussion_id) {
            var confirmation = confirm("Do you want to delete this post?");
            if (confirmation) {
                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data: {
                        discussion_id: discussion_id
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload(); // Refresh the page after successful deletion
                    }
                });
            }
        }

        function editPost(discussion_id) {
            window.location.href = "edit.php?discussion_id=" + discussion_id;
        }

        function viewPost(discussion_id) {
            window.location.href = "viewPost.php?discussion_id=" + discussion_id
        }
    </script>
</body>

</html>