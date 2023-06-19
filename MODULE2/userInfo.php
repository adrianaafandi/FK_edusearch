<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
</head>

<body>
    <?php include '../UserSideBar/User_sidebar.php'?>
    <?php
    // Connect to the database server.
    $link = mysqli_connect("localhost", "root", "", "fkedusearch_module2", "user") or die(mysqli_connect_error());

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $current_academic_status = $_POST["current_academic_status"];
        $research_type = $_POST["research_type"];
        $RA_desc = $_POST["RA_desc"];
        $socmed_name = $_POST["socmed_name"];
        $socmed_type = $_POST["socmed_type"];

        // Validate form fields
        if (empty($current_academic_status) || empty($research_type) || empty($socmed_name) || empty($socmed_type)) {
            echo '<script>alert("Please fill in all the fields!!");</script>';
        } else {
            // Start a transaction
            mysqli_begin_transaction($link);

            try {
                // Prepare and execute INSERT queries using prepared statements

                // Prepare statement for inserting into 'user' table
                $insertUserQuery = "INSERT INTO user (current_academic_status) VALUES (?)";
                $insertUserStmt = mysqli_prepare($link, $insertUserQuery);
                mysqli_stmt_bind_param($insertUserStmt, "s", $current_academic_status);
                mysqli_stmt_execute($insertUserStmt);

                // Retrieve the generated 'user_id'
                $user_id = mysqli_insert_id($link);

                // Prepare statement for inserting into 'research_area' table
                $insertResearchAreaQuery = "INSERT INTO research_area (RA_desc) VALUES (?)";
                $insertResearchAreaStmt = mysqli_prepare($link, $insertResearchAreaQuery);
                mysqli_stmt_bind_param($insertResearchAreaStmt, "s", $RA_desc);
                mysqli_stmt_execute($insertResearchAreaStmt);

                // Retrieve the generated 'researchArea_id'
                $researchArea_id = mysqli_insert_id($link);

                // Prepare statement for inserting into 'research' table
                $insertResearchQuery = "INSERT INTO research (user_id, research_type, researchArea_id) VALUES (?, ?, ?)";
                $insertResearchStmt = mysqli_prepare($link, $insertResearchQuery);
                mysqli_stmt_bind_param($insertResearchStmt, "iss", $user_id, $research_type, $researchArea_id);
                mysqli_stmt_execute($insertResearchStmt);

                // Prepare statement for inserting into 'social_media' table
                $insertSocialMediaQuery = "INSERT INTO social_media (user_id, socmed_name, socmed_type) VALUES (?, ?, ?)";
                $insertSocialMediaStmt = mysqli_prepare($link, $insertSocialMediaQuery);
                mysqli_stmt_bind_param($insertSocialMediaStmt, "iss", $user_id, $socmed_name, $socmed_type);
                mysqli_stmt_execute($insertSocialMediaStmt);

                // Commit the transaction
                mysqli_commit($link);

                echo "Record inserted successfully.";
                exit();
            } catch (Exception $e) {
                // An error occurred, rollback the transaction
                mysqli_rollback($link);

                echo "Error inserting record: " . $e->getMessage();
            }

            // Close the prepared statements
            mysqli_stmt_close($insertUserStmt);
            mysqli_stmt_close($insertResearchAreaStmt);
            mysqli_stmt_close($insertResearchStmt);
            mysqli_stmt_close($insertSocialMediaStmt);
        }
    }

    // Retrieve user data from the database
    $userQuery = "SELECT * FROM user WHERE user_id = ''"; // Replace with the actual user ID
    $userResult = mysqli_query($link, $userQuery);
    $user = mysqli_fetch_assoc($userResult);

    // Close the database connection
    mysqli_close($link);
    ?>

    <div class="content">
        <div style="margin-top: 30px; margin-left: 10px;">
            <form class="row g-3" method="POST" action="" onsubmit="return validateForm();">
                <h6><b>PERSONAL INFORMATION</b></h6><br><br>
                <div class="mb-3 row">
                    <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="education_level" class="col-sm-2 col-form-label">Education Level</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="education_level" name="education_level" value="<?php echo $user['education_level']; ?>" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="research_type" class="col-sm-2 col-form-label">Current Academic Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="current_academic_status" name="current_academic_status" value="<?php echo $user['current_academic_status']; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="research_type" class="col-sm-2 col-form-label">Research Type</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="research_type" name="research_type" value="<?php echo isset($research_type) ? $research_type : ''; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="RA_desc" class="col-sm-2 col-form-label">Research Area Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="RA_desc" name="RA_desc" value="<?php echo isset($RA_desc) ? $RA_desc : ''; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="socmed_name" class="col-sm-2 col-form-label">Social Media</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="socmed_name" name="socmed_name" value="<?php echo isset($socmed_name) ? $socmed_name : ''; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="socmed_type" id="facebook" value="Facebook">
                            <label class="form-check-label" for="facebook">Facebook</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="socmed_type" id="instagram" value="Instagram">
                            <label class="form-check-label" for="instagram">Instagram</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="socmed_type" id="twitter" value="Twitter">
                            <label class="form-check-label" for="twitter">Twitter</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" onclick="window.location.href = 'view.php'">CANCEL</button>
                </div>
            </form>
        </div>
    </div><br><br>
    </div>

    <script>
        function validateForm() {
            var current_academic_status = document.getElementById("current_academic_status").value;
            var research_type = document.getElementById("research_type").value;
            var socmed_name = document.getElementById("socmed_name").value;
            var socmed_type = document.querySelector('input[name="socmed_type"]:checked');

            if (current_academic_status === "" || research_type === "" || socmed_name === "" || socmed_type === null) {
                alert("Please fill in all the fields!!");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
