<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <title>FK_EDUSEARCH</title>
                <style>
                    .list-item {
                        margin-bottom: 20px;
                    }
                    .list-item button {
                        margin-left: 20px;
                    }
                </style>
    </head>

    <body>
        <div class="content" style="margin-top: 10px; margin-left: 10px;">
            <button type="button" class="btn btn-primary" onclick="window.location.href = 'create.php';">+ NEW POST</button>
        </div>

        <br><br>

        <div class="row" style="margin-left: 10px;">
            <?php
                // Sample post data (replace with your own data source)
                $posts = [
                    ["Post 1", "Author 1", "2023-06-01"],
                    ["Post 2", "Author 2", "2023-06-02"],
                    ["Post 3", "Author 3", "2023-06-03"],
                    ["Post 4", "Author 4", "2023-06-04"],
                ];

                // Render the post titles and buttons
                foreach ($posts as $post) {
                    $title = $post[0];
                    $postId = str_replace(' ', '_', strtolower($title)); // Generate a unique ID for each post
                    echo "<div class='col-sm-3'>";
                    echo "<h4>$title</h4>";
                    echo "<button class='btn btn-danger' onclick='deletePost(\"$postId\")'><i class='fas fa-trash'></i></button>";
                    echo "<button class='btn btn-primary' onclick='editPost(\"$postId\")'><i class='fas fa-edit'></i></button>";
                    echo "</div>";
                }
            ?>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>

            <script>
                function deletePost(postId) {
                    // Perform delete operation for the specified post
                    console.log("Delete post with ID: " + postId);
                }

                function editPost(postId) {
                    // Perform edit operation for the specified post
                    console.log("Edit post with ID: " + postId);
                }
            </script>
    </body>
</html>
