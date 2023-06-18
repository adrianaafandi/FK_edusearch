<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>FK_EDUSEARCH</title>
    <img src="img.png" class="img-fluid">
</head>

<body>
    <div class="content" style="margin-top: 10px; margin-left: 10px;">
        <button type="button" class="btn btn-primary" onclick="window.location.href = 'create.php';">+ NEW POST</button>
    </div>

    <br><br>

    <div class="row" style="margin-left: 10px;">
        <?php
        // Connect to the database server.
        $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

        // Select the database
        mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

        // Fetch the posts from the database
        $query = "SELECT discussion_id, title FROM discussion";
        $result = mysqli_query($link, $query);

        // Display the post titles with edit and delete buttons
        while ($row = mysqli_fetch_assoc($result)) {
            $discussion_id = $row['discussion_id'];
            $title = $row['title'];

            echo "<div class='col-sm-3'>";
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th colspan='2'>$title</th></tr></thead>";
            echo "<tbody>";
            echo "<tr><td><button class='btn btn-danger' onclick='deletePost($discussion_id)'><i class='fas fa-trash'></i></button></td>";
            echo "<td><button class='btn btn-primary' onclick='editPost($discussion_id)'><i class='fas fa-edit'></i></button></td></tr>";
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        }

        // Close the database connection
        mysqli_close($link);
        ?>
    </div>

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
    </script>
</body>

</html>