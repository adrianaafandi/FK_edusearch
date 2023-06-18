<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/bootstrap-icons.min.css" rel="stylesheet">
    <title>FK_EDUSEARCH</title>
    <img src="img.png" class="img-fluid">
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

        .post h3 {
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
    <?php
    // Connect to the database server.
    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

    // Select the database.
    mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

    // Handle the like button click
    if (isset($_POST['like'])) {
        $discussion_id = $_POST['discussion_id'];

        // Update the like count in the database
        $updateQuery = "UPDATE discussion SET discussion_like = discussion_like + 1 WHERE discussion_id = '$discussion_id'";
        mysqli_query($link, $updateQuery);

        // Fetch the updated like count from the database
        $likeCountQuery = "SELECT discussion_like FROM discussion WHERE discussion_id = '$discussion_id'";
        $likeCountResult = mysqli_query($link, $likeCountQuery);
        $likeCountRow = mysqli_fetch_assoc($likeCountResult);
        $likeCount = $likeCountRow['discussion_like'];

        // Return the updated like count as a response
        echo $likeCount;
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $discussion_id = $_POST["discussion_id"];
        $comment = $_POST["comment_content"];

        // Store the comment in the database
        $insertQuery = "UPDATE discussion SET discussion_comment = discussion_comment + 1 WHERE discussion_id = '$discussion_id'";
        mysqli_query($link, $insertQuery); // Increment the comment count

        $commentQuery = "INSERT INTO comment (discussion_id, comment_content) VALUES ('$discussion_id', '$comment')";
        mysqli_query($link, $commentQuery); // Insert the new comment
    }

    // Fetch the categories from the database
    $categoryQuery = "SELECT * FROM category";
    $categoryResult = mysqli_query($link, $categoryQuery);

    // Fetch the posts from the database
    $postQuery = "SELECT * FROM discussion";
    $postResult = mysqli_query($link, $postQuery);
    ?>

    <div class="content">
        <div style="margin-top: 30px; margin-left: 10px;">
            <form class="row g-3" method="POST" action="">
                <h2><b>YOUR POST</b></h2><br><br><br><br>
                <div class="mb-3 row" style="margin-top: 10px;">
                    <label for="category_id" class="col-sm-2 col-form-label" style="font-size: 24px;"><b>CATEGORY</b></label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-lg mb-3" id="category_id" name="category_id" aria-label="Default select example">
                            <option value="">Select category</option>
                            <?php
                            // Loop through the categories and generate the options
                            while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                                $category_id = $categoryRow['category_id'];
                                $category_type = $categoryRow['category_type'];
                                echo "<option value='$category_id'>$category_type</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
            <?php
            // Display the posts
            while ($row = mysqli_fetch_assoc($postResult)) {
                $discussion_id = $row['discussion_id'];
                $title = $row['title'];
                $content = $row['content'];
                $commentCount = $row['discussion_comment'];

                echo "<div class='post-container'>";
                echo "<div class='post'>";
                echo "<h3>$title</h3>";
                echo "<p>$content</p>";
                echo "<p>Likes: <span id='likeCount$discussion_id'>{$row['discussion_like']}</span></p>";
                echo "<p>Comments: <span id='commentCount$discussion_id'>$commentCount</span></p>";
                echo "<button class='btn btn-danger' onclick='likePost($discussion_id)'>🤍</button>";
                echo "<button class='btn btn-primary' onclick='toggleCommentForm($discussion_id)'>COMMENT</button>";
                echo "<div id='commentFormContainer$discussion_id' style='display: none;'>";
                echo "<form id='commentForm$discussion_id' onsubmit='submitComment(event, $discussion_id)'>";
                echo "<textarea class='form-control' id='commentTextarea$discussion_id' rows='3' placeholder='Enter your comment'></textarea>";
                echo "<button type='submit' class='btn btn-primary'>Submit</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>

        <div class="comment-grid">
            <?php
            // Display the comments grid
            mysqli_data_seek($postResult, 0); // Reset the result pointer
            while ($row = mysqli_fetch_assoc($postResult)) {
                $discussion_id = $row['discussion_id'];
                $title = $row['title'];

                echo "<div class='comment-container'>";
                echo "<h4>$title</h4>";
                echo "<div class='comment-list' id='commentList$discussion_id'>";
                $commentQuery = "SELECT * FROM comment WHERE discussion_id = '$discussion_id'";
                $commentResult = mysqli_query($link, $commentQuery);
                $commentNumber = 1;
                while ($commentRow = mysqli_fetch_assoc($commentResult)) {
                    $commentContent = $commentRow['comment_content'];
                    echo "<p class='comment'>$commentNumber. $commentContent</p>";
                    $commentNumber++;
                }
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div><br>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function toggleCommentForm(discussion_id) {
            const commentFormContainer = document.getElementById(`commentFormContainer${discussion_id}`);
            if (commentFormContainer.style.display === 'none') {
                commentFormContainer.style.display = 'block';
            } else {
                commentFormContainer.style.display = 'none';
            }
        }

        function submitComment(event, discussion_id) {
            event.preventDefault();
            const commentTextarea = document.getElementById(`commentTextarea${discussion_id}`);
            const commentContent = commentTextarea.value.trim();

            if (commentContent !== '') {
                const commentList = document.getElementById(`commentList${discussion_id}`);
                const commentNumber = commentList.childElementCount + 1;
                const newComment = document.createElement('p');
                newComment.className = 'comment';
                newComment.textContent = `${commentNumber}. ${commentContent}`;
                commentList.appendChild(newComment);

                // Clear the comment textarea
                commentTextarea.value = '';

                // Send an AJAX request to store the comment in the database
                $.ajax({
                    type: 'POST',
                    url: 'submitComment.php', // Updated PHP file
                    data: {
                        discussion_id: discussion_id,
                        comment_content: commentContent
                    }
                }).done(function(response) {
                    // Increment the comment count in the post
                    const commentCountSpan = document.getElementById(`commentCount${discussion_id}`);
                    const currentCommentCount = parseInt(commentCountSpan.textContent);
                    commentCountSpan.textContent = currentCommentCount + 1;
                }).fail(function() {
                    alert('An error occurred while submitting the comment.');
                });
            }
        }

        // Update the like button click handler
        function likePost(discussion_id) {
            // Send an AJAX request to handle the like button click
            $.ajax({
                type: 'POST',
                url: 'totalLikes.php',
                data: {
                    discussion_id: discussion_id,
                    like: true
                }
            }).done(function(response) {
                // Update the like count display
                const likeCountSpan = document.getElementById(`likeCount${discussion_id}`);
                likeCountSpan.textContent = response;
            }).fail(function() {
                alert('An error occurred while processing the like.');
            });
        }
    </script>
</body>

</html>