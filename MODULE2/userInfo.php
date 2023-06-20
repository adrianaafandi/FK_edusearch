<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

// Retrieve data from user table
$userQuery = "SELECT * FROM user WHERE user_id=1";
$userResult = mysqli_query($link, $userQuery);
$userData = mysqli_fetch_assoc($userResult);

// Initialize variables with retrieved values
$fullname = isset($userData['fullname']) ? $userData['fullname'] : "";
$email = isset($userData['email']) ? $userData['email'] : "";
$education_level = isset($userData['education_level']) ? $userData['education_level'] : "";
$current_academic_status = isset($userData['current_academic_status']) ? $userData['current_academic_status'] : "";
$research_type = isset($userData['research_type']) ? $userData['research_type'] : "";
$RA_desc = isset($userData['RA_desc']) ? $userData['RA_desc'] : "";
$socmed_name = isset($userData['socmed_name']) ? $userData['socmed_name'] : "";
$socmed_type = isset($userData['socmed_type']) ? $userData['socmed_type'] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $current_academic_status = $_POST["current_academic_status"];
    $research_type = $_POST["research_type"];
    $RA_desc = $_POST["RA_desc"];
    $socmed_name = $_POST["socmed_name"];
    $socmed_type = isset($_POST["socmed_type"]) ? $_POST["socmed_type"] : "";

    // Validate form fields
    if (empty($current_academic_status) || empty($research_type) || empty($RA_desc) || empty($socmed_name) || empty($socmed_type)) {
        echo '<script>alert("Please fill in all the fields!!");</script>';
    } else {
        // Prepare the UPDATE statement
        $insertQuery = "UPDATE user SET current_academic_status=?, research_type=?, RA_desc=?, socmed_name=?, socmed_type=? WHERE user_id=1";
        $stmt = mysqli_prepare($link, $insertQuery);

        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "sssss", $current_academic_status, $research_type, $RA_desc, $socmed_name, $socmed_type);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Record updated successfully.";
            header("Location: homepage.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_stmt_error($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
    <style>
    .container-with-shadow {
        background-color: #F8F8F8;
        padding: 20px;
        margin-top: 30px;
        margin-left: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>
    <?php include '../UserSideBar/User_sidebar.php'; ?>
    <div class="container">
        <div class="container-with-shadow">
            <form method="POST">
                <h5><b>PERSONAL INFORMATION</b></h5><br>
                <div class="mb-3 row">
                    <label for="fullname" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            value="<?php echo $fullname; ?>" aria-label="Disabled input example" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>"
                            aria-label="Disabled input example" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="education_level" class="col-sm-2 col-form-label">Education Level</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="education_level" name="education_level"
                            value="<?php echo $education_level; ?>" aria-label="Disabled input example" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="current_academic_status" class="col-sm-2 col-form-label">Current Academic Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="current_academic_status"
                            name="current_academic_status" value="<?php echo $current_academic_status; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="research_type" class="col-sm-2 col-form-label">Research Type</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="research_type" name="research_type"
                            value="<?php echo $research_type; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="RA_desc" class="col-sm-2 col-form-label">Research Area Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="RA_desc" name="RA_desc"
                            value="<?php echo $RA_desc; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="socmed_name" class="col-sm-2 col-form-label">Social Media</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="socmed_name" name="socmed_name"
                            value="<?php echo $socmed_name; ?>">
                    </div>
                    <br><br>
                    <div class="form-check" style="margin-left: 220px;">
                        <input class="form-check-input" type="radio" name="socmed_type" id="Facebook" value="Facebook"
                            <?php if ($socmed_type === 'Facebook') echo 'checked'; ?>>
                        <label class="form-check-label" for="Facebook">Facebook</label>
                    </div>
                    <div class="form-check" style="margin-left: 220px;">
                        <input class="form-check-input" type="radio" name="socmed_type" id="Instagram" value="Instagram"
                            <?php if ($socmed_type === 'Instagram') echo 'checked'; ?>>
                        <label class="form-check-label" for="Instagram">Instagram</label>
                    </div>
                    <div class="form-check" style="margin-left: 220px;">
                        <input class="form-check-input" type="radio" name="socmed_type" id="Twitter" value="Twitter"
                            <?php if ($socmed_type === 'Twitter') echo 'checked'; ?>>
                        <label class="form-check-label" for="Twitter">Twitter</label>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='homepage.php'">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-cs7eQe7NgfTZh4gsnyzJggprEM0MZJjZzMKw5R11onpqzCCd1M73e7fG4AgpE3pL" crossorigin="anonymous">
    </script>
</body>

</html>