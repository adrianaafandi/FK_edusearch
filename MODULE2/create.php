<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category_id = $_POST["category_id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $tags = $_POST["tags"];
    $date = $_POST["date"];

    // Validate form fields
    if (empty($category_id) || empty($title) || empty($content) || empty($tags) || empty($date)) {
        echo '<script>alert("Please fill in all the fields!!");</script>';
    } else {
        // Prepare the INSERT statement
        $insertQuery = "INSERT INTO discussion (category_id, title, content, tags, date) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $insertQuery);

        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "issss", $category_id, $title, $content, $tags, $date);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Record inserted successfully.";
            header("Location: view.php"); // Redirect to view.php
            exit();
        } else {
            echo "Error inserting record: " . mysqli_stmt_error($stmt);
        }
    }
}

// Fetch the distinct category_type values using an inner join between category and discussion tables
$categoryQuery = "SELECT DISTINCT c.category_id, c.category_type FROM category AS c INNER JOIN discussion AS d ON c.category_id = d.category_id";
$categoryResult = mysqli_query($link, $categoryQuery);

// Initialize variables with empty values
$category_id = "";
$title = "";
$content = "";
$tags = "";
$date = "";
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
    <style>
        .container-with-shadow {
            background-color: #F8F8F8;
            padding: 20px;
            margin-top: 30px;
            margin-left: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .content {
            margin-top: 30px;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <?php include '../UserSideBar/User_sidebar.php'; ?>
    <div class="container-with-shadow">
        <div class="content">
            <form class="row g-3" method="POST" action="" onsubmit="return validateForm();">
                <h6 align="left"><b>CREATE NEW POST</b></h6><br><br>
                <div class="mb-3 row" style="margin-top: 10px;">
                    <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
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
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" onclick="window.location.href = 'view.php'">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
    <br><br><br>
    <script>
        function validateForm() {
            var category = document.getElementById("category_id").value;
            var title = document.getElementById("title").value;
            var content = document.getElementById("content").value;
            var tags = document.getElementById("tags").value;
            var date = document.getElementById("date").value;

            if (category === "" || title === "" || content === "" || tags === "" || date === "") {
                alert("Please fill in all the fields!!");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>