<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "", "FKEduSearch", "3307") or die(mysqli_connect_error());

// Check if the discussion_id is provided via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the post data from the database
    $query = "SELECT * FROM expert WHERE id = $id";
    $result = mysqli_query($link, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phoneNum = $_POST["phoneNum"];
        $researchArea = $_POST["researchArea"];
        $listOfPublications = $_POST["listOfPublications"];
        $academicStatus = $_POST["academicStatus"];
        $CV = $_POST["CV"];
        $socialMedia = $_POST["socialMedia"];

        // Display the edit form
?>
        <!DOCTYPE html>
        <html>

        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

            <title>FK_EDUSEARCH</title>

        </head>

        <body>
            <?php include '../UserSideBar/User_sidebar.php' ?>
            <div class="content">
                <div style="margin-top: 30px; margin-left: 10px;">
                    <form class="row g-3" method="POST" action="update.php">
                        <h6 align="left"><b>PROFILE INFORMATION</b></h6><br><br>
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="phoneNum" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phoneNum" name="phoneNum" value="<?php echo $phoneNum; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="researchArea" class="col-sm-2 col-form-label">Research Area</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="researchArea" name="researchArea" value="<?php echo $researchArea; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="listOfPublications" class="col-sm-2 col-form-label">List of Publications</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="listOfPublications" name="listOfPublications" value="<?php echo $listOfPublications; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="academicStatus" class="col-sm-2 col-form-label">Academic Status</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="academicStatus" name="academicStatus" value="<?php echo $academicStatus; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="CV" class="form-label">CV</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="CV" name="CV" value="<?php echo $CV; ?>" multiple>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="socialMedia" class="col-sm-2 col-form-label">Social Media</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="socialMedia" name="socialMedia" value="<?php echo $socialMedia; ?>">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="d-flex justify-content-center">

                            <button type="submit" class="btn btn-success">EDIT</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" onclick="window.location.href = 'view.php'">EDIT</button>
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