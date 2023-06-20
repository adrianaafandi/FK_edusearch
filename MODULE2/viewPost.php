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
    <?php include '../UserSideBar/User_sidebar.php' ?>
    <br>
    <h3><b>&nbsp;&nbsp;YOUR POST</b></h3>
    <br>

    <?php
    // Establish a database connection
    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
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

    // Check if the discussion_id is provided in the URL parameter
    if (isset($_GET['discussion_id'])) {
        $discussion_id = $_GET['discussion_id'];

        // Fetch the discussion details from the database
        $discussionQuery = "SELECT * FROM discussion WHERE discussion_id = '$discussion_id'";
        $discussionResult = mysqli_query($link, $discussionQuery);
        if ($discussionRow = mysqli_fetch_assoc($discussionResult)) {
            $title = $discussionRow['title'];
            $content = $discussionRow['content'];

            // Fetch the comment count for the discussion
            $commentCountQuery = "SELECT COUNT(*) AS comment_count FROM comment WHERE discussion_id = '$discussion_id'";
            $commentCountResult = mysqli_query($link, $commentCountQuery);
            $commentCountRow = mysqli_fetch_assoc($commentCountResult);
            $commentCount = $commentCountRow['comment_count'];

            // Display the discussion title and content in a post container
            echo "<div class='post-container'>";
            echo "<div class='post'>";
            echo "<h2>$title</h2>";
            echo "<p>$content</p>";
            echo "<p>Likes: <span id='likeCount$discussion_id'>{$discussionRow['discussion_like']}</span></p>";
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
    }
    ?>

    <div class="comment-grid">
        <div id="commentList<?php echo $discussion_id; ?>">
            <?php
            // Display the comments grid
            $commentQuery = "SELECT * FROM comment WHERE discussion_id = '$discussion_id'";
            $commentResult = mysqli_query($link, $commentQuery);
            $commentNumber = 1;
            while ($commentRow = mysqli_fetch_assoc($commentResult)) {
                $commentContent = $commentRow['comment_content'];
                echo "<div class='comment-container'>";
                echo "<h4>User $commentNumber</h4>";
                echo "<div class='comment-list'>";
                echo "<p class='comment'>$commentContent</p>";
                echo "</div>";
                echo "</div>";
                $commentNumber++;
            }
            ?>
        </div>
    </div><br><br>
    <div class="content" style="margin-top: 10px; margin-left: 10px;">
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary" onclick="window.location.href = 'view.php';">BACK</button>
        </div>
    </div>
    <br><br>

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
                const newCommentContainer = document.createElement('div');
                newCommentContainer.className = 'comment-container';
                newCommentContainer.innerHTML = `
                <h4>User ${commentNumber}</h4>
                <div class='comment-list'>
                    <p class='comment'>${commentContent}</p>
                </div>
            `;
                commentList.appendChild(newCommentContainer);

                // Clear the comment textarea
                commentTextarea.value = '';

                // Send an AJAX request to store the comment in the database
                $.ajax({
                    type: 'POST',
                    url: 'submitComment.php',
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