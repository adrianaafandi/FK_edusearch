<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
</head>
<body>
    <?php
        // Connect to the database server.
        $link = mysqli_connect("localhost", "root", "", "fk-edusearch", "3307") or die(mysqli_connect_error());

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $category_type = $_POST["category_type"];
            $title = $_POST["title"];
            $content = $_POST["content"];
            $tags = $_POST["tags"];

            // Construct INSERT query
            $insertQuery = "INSERT INTO discussion (category_type, title, content, tags) VALUES ('$category_type', '$title', '$content', '$tags')";

            // Execute INSERT query
            if (mysqli_query($link, $insertQuery)) {
                echo "Record inserted successfully.";
                header("Location: view.php"); // Redirect to view.php
                exit();
            } else {
                echo "Error inserting record: " . mysqli_error($link);
            }
        }

        // SQL query with INNER JOIN
        $query = "SELECT d.*, c.category_type FROM discussion d INNER JOIN category c ON d.category_type = c.category_type";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $category_type = $row["category_type"];
                $title = $row["title"];
                $content = $row["content"];
                $tags = $row["tags"];
            }
        } else {
            // If no rows found, initialize variables with empty values
            $category_type = "";
            $title = "";
            $content = "";
            $tags = "";
        }
    ?>

    <div class="content">
        <div style="margin-top: 30px; margin-left: 10px;">
            <form class="row g-3" method="POST" action="">
                <h6 align="left"><b>CREATE NEW POST</b></h6><br><br>
                <div class="mb-3 row" style="margin-top: 10px;">
                    <label for="category_type" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="category_type" name="category_type" aria-label="Default select example">
                            <option selected>Select category</option>
                            <?php
                            // Fetch the categories from the database
                            $categoryQuery = "SELECT * FROM category";
                            $categoryResult = mysqli_query($link, $categoryQuery);

                            // Loop through the categories and generate the options
                            while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                                $category_id = $categoryRow['category_id'];
                                $category_type = $categoryRow['category_type'];
                            ?>
                                <option value="<?php echo $category_id; ?>"><?php echo $category_type; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br><br>
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                    </div>
                </div>
                <br><br>
                <div class="mb-3 row">
                    <label for="content" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="content" name="content" rows="3"><?php echo $content; ?></textarea>
                    </div>
                </div>
                <br><br><br><br>
                <div class="mb-3 row">
                    <label for="tags" class="col-sm-2 col-form-label">Tags</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tags" name="tags" value="<?php echo $tags; ?>">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">CREATE</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" onclick="window.location.href = 'view.php';">CANCEL</button>
                </div> 
            </form>
        </div>
    </div>
</body>
</html>


































<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "YES", "lab9questionthree", "3307") or die(mysql_connect_error());

//Select the database.
mysqli_select_db($link, "lab9questionthree") or die(mysqli_error($link));

$idURL= $_GET['id'];

//SQL query
$query = "SELECT * FROM person WHERE Person_ID = '$idURL'"
  or die(mysqli_connect_error());
  
//Execute the query (the recordset $rs contains the result)
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);

  $pNama = $row["Person_name"];
  $pTel = $row["Person_telephone"];
  $pAdd = $row["Person_address"];
?>

<!DOCTYPE html>
<html>
<body>
<form method="post" action="insert.php">
Nama:
<input type ="text" name="nama" size="40" value="<?php echo $pNama; ?>">
<br>
Umur:
<input type ="text" name="umur" size="10" value="<?php echo $pTel; ?>">
<br>
Emel: <input type="text" name = "emel" value="<?php echo $pAdd; ?>">
<br>
<input type ="hidden" name="id2" value="<?php echo $idURL; ?>">
<input type ="submit" value="Ubah">
<input type ="reset" value="Batal">
<br>
</form>
<hr>