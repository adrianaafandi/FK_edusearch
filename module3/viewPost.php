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

        .post h5 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .post p {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .post button {
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <?php include '../ExpertSideBar/Expert_sidebar.php' ?>
    <br>
    <h3><b>&nbsp;&nbsp;POST</b></h3>
    <br>

    <?php
    // Establish a database connection
    $link = mysqli_connect("localhost", "root", "", "fkedusearch", "8111") or die(mysqli_connect_error());
    mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $discussion_id = $_POST["discussion_id"];
        $answer = $_POST["answer_content"];

        // Store the answer in the database
        $answerQuery = "INSERT INTO answer (discussion_id, answer_content) VALUES ('$discussion_id', '$answer')";
        mysqli_query($link, $answerQuery); // Insert the new answer
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

            // Display the discussion title and content in a post container
            echo "<div class='post-container'>";
            echo "<div class='post'>";
            echo "<h5>$content</h5>";
            echo "<button class='btn btn-primary btn-sm' onclick='toggleCommentForm($discussion_id)'>ANSWER</button>";
            echo "<div id='commentFormContainer$discussion_id' style='display: none;'>";
            echo "<form id='commentForm$discussion_id' onsubmit='submitComment(event, $discussion_id)'>";
            echo "<textarea class='form-control' id='commentTextarea$discussion_id' rows='3' placeholder='Enter your comment'></textarea>";
            echo "<button type='submit' class='btn btn-success btn-sm'>Submit</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";

            // Fetch and display the answers for the discussion
            $answersQuery = "SELECT * FROM answer WHERE discussion_id = '$discussion_id'";
            $answersResult = mysqli_query($link, $answersQuery);
            while ($answerRow = mysqli_fetch_assoc($answersResult)) {
                $answerContent = $answerRow['answer_content'];
                echo "<div class='post'>";
                echo "<p>$answerContent</p>";
                echo "</div>";
            }

            echo "</div>";
        }
    }
    ?>
    </div><br><br>
    <div class="content" style="margin-top: 10px; margin-left: 10px;">
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" onclick="window.location.href = 'post.php';">BACK</button>
        </div>
    </div>
    <br><br>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function toggleCommentForm(discussion_id) {
            var commentFormContainer = document.getElementById('commentFormContainer' + discussion_id);
            commentFormContainer.style.display = commentFormContainer.style.display === 'none' ? 'block' : 'none';
        }

        function submitComment(event, discussion_id) {
            event.preventDefault();
            var commentTextarea = document.getElementById('commentTextarea' + discussion_id);
            var answer = commentTextarea.value;

            // Make an AJAX request to store the answer in the database
            $.ajax({
                type: 'POST',
                url: 'submitAnswer.php',
                data: {
                    discussion_id: discussion_id,
                    answer_content: answer
                },
                success: function() {
                    // Add the answer to the post container
                    var answerContainer = document.createElement('div');
                    answerContainer.classList.add('post');
                    answerContainer.innerHTML = '<p>' + answer + '</p>';
                    var postContainer = document.querySelector('.post-container');
                    postContainer.appendChild(answerContainer);

                    // Clear the comment textarea
                    commentTextarea.value = '';

                    // Hide the comment form
                    toggleCommentForm(discussion_id);
                }
            });
        }
    </script>

</html>