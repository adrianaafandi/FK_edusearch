<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "", "fkedusearch", "8111",) or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

// Check if a discussion ID is provided
if (isset($_GET['discussion_id'])) {
    $discussion_id = $_GET['discussion_id'];

    // Fetch the discussion post
    $discussionQuery = "SELECT * FROM discussion WHERE discussion_id = $discussion_id";
    $discussionResult = mysqli_query($link, $discussionQuery);
    $discussionRow = mysqli_fetch_assoc($discussionResult);

    if ($discussionRow) {
        $title = $discussionRow['title'];

        // Fetch the answers for the discussion post
        $answerQuery = "SELECT * FROM answer WHERE discussion_id = $discussion_id";
        $answerResult = mysqli_query($link, $answerQuery);
        $numAnswers = mysqli_num_rows($answerResult);
    } else {
        // Discussion post not found, redirect to the main page or show an error message
        header("Location: post.php");
        exit;
    }
} else {
    // Discussion ID not provided, redirect to the main page or show an error message
    header("Location: post.php");
    exit;
}

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
        <h4><?php echo $title; ?></h4>
        <br>

        <?php
        // Display the answers
        if ($numAnswers > 0) {
            while ($answerRow = mysqli_fetch_assoc($answerResult)) {
                $answer_id = $answerRow['answer_id'];
                $answer_content = $answerRow['answer_content'];
        ?>
                <div class="answer">
                    <p><?php echo $answer_content; ?></p>
                    <div class="answer-actions">
                        <button class="btn btn-primary" onclick="editAnswer(<?php echo $answer_id; ?>)"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="deleteAnswer(<?php echo $answer_id; ?>)"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
        <?php
            }
        } else {
            // No answers found
            echo "<p>No answers found.</p>";
        }
        ?>

        <br>
        <h5>Answer:</h5>
        <form method="post" action="submitAnswer.php">
            <textarea name="answer_content" rows="3" required></textarea><br>
            <input type="hidden" name="discussion_id" value="<?php echo $discussion_id; ?>">
            <button type="submit" class="btn btn-primary">Submit Answer</button>
        </form>
    </div>
    <br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>

    <script>
        function editAnswer(answer_id) {
            // Implement the edit answer logic
        }

        function deleteAnswer(answer_id) {
            // Implement the delete answer logic
        }
    </script>
</body>

</html>
