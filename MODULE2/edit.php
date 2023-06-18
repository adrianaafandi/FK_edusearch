<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "", "fkedusearch_module2") or die(mysqli_connect_error());

// Check if the discussion_id is provided via GET
if (isset($_GET['discussion_id'])) {
    $discussion_id = $_GET['discussion_id'];

    // Fetch the post data from the database
    $query = "SELECT * FROM discussion WHERE discussion_id = $discussion_id";
    $result = mysqli_query($link, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $category_id = $row['category_id'];
        $title = $row['title'];
        $content = $row['content'];
        $tags = $row['tags'];
        $date = $row['date'];

        // Fetch the categories from the database
        $categoryQuery = "SELECT * FROM category";
        $categoryResult = mysqli_query($link, $categoryQuery);

        // Display the edit form
?>
        <!DOCTYPE html>
        <html>

        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <title>FK_EDUSEARCH</title>
            <img src="img.png" class="img-fluid">
        </head>

        <body>
            <div class="content">
                <div style="margin-top: 30px; margin-left: 10px;">
                    <form class="row g-3" method="POST" action="update.php">
                        <h6 align="left"><b>EDIT POST</b></h6><br><br>
                        <div class="mb-3 row" style="margin-top: 10px;">
                            <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
                                    <?php
                                    // Loop through the categories and generate the options
                                    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                                        $categoryId = $categoryRow['category_id'];
                                        $categoryType = $categoryRow['category_type'];
                                        if ($categoryId == $category_id) {
                                            echo "<option value='$categoryId' selected>$categoryType</option>";
                                        } else {
                                            echo "<option value='$categoryId'>$categoryType</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="content" class="col-sm-2 col-form-label">Content</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="content" name="content" rows="5"><?php echo $content; ?></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="content" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="date" name="date" value="<?php echo $date; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tags" class="col-sm-2 col-form-label">Tags</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tags" name="tags" value="<?php echo $tags; ?>">
                            </div>
                        </div>
                        <input type="hidden" name="discussion_id" value="<?php echo $discussion_id; ?>">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">EDIT</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger" onclick="window.location.href = 'view.php'">CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "Post not found";
    }
} else {
    echo "Invalid request";
}

// Close the database connection
mysqli_close($link);
?>