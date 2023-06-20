<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "", "fkedusearch", "8111") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

// // Fetch the categories from the database
// $categoryQuery = "SELECT * FROM category";
// $categoryResult = mysqli_query($link, $categoryQuery);

// // Fetch the posts from the database based on the selected category
// $category_id = $_POST['category_id'] ?? ''; // Get the selected category ID from the form

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
    <?php include '../ExpertSideBar/Expert_sidebar.php' ?>

    <div class="content" style="margin-top: 10px; margin-left: 10px;">
        <h2><b>ASSIGNED POST</b></h2><br>
    </div>
    <br>
    <div class="row" style="margin-left: 10px;">
        <?php
        if ($numPosts > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>No</th><th>Title</th><th>Action</th></tr></thead>";
            echo "<tbody>";

            $rowNumber = 1;

            while ($row = mysqli_fetch_assoc($postResult)) {
                $discussion_id = $row['discussion_id'];
                $title = $row['title'];

                echo "<tr>";
                echo "<td>$rowNumber</td>";
                echo "<td>$title</td>";
                echo "<td>";
                echo "<button class='btn btn-primary' onclick='editPost($discussion_id)'><i class='fas fa-edit'></i></button>&nbsp;&nbsp;&nbsp;";
                echo "<button class='btn btn-danger' onclick='deletePost($discussion_id)'><i class='fas fa-trash'></i></button>";
                echo "</td>";
                echo "</tr>";

                $rowNumber++;
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No discussion posts found.</p>";
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
                    url: "deleteQuestion.php",
                    data: {
                        discussion_id: discussion_id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.includes('success')) {
                            location.reload(); // Refresh the page after successful deletion
                        } else {
                            alert("Error deleting post: " + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred while deleting the post: " + error);
                    }
                });
            }
        }

        function editPost(discussion_id) {
            window.location.href = "viewPost.php?discussion_id=" + discussion_id;
        }
    </script>
</body>

</html>
