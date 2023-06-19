<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch_module2") or die(mysqli_error($link));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $education_level = $_POST["education_level"];
    $current_academic_status = $_POST["current_academic_status"];
    $research_type = $_POST["research_type"];
    $RA_desc = $_POST["RA_desc"];
    $socmed_name = $_POST["socmed_name"];
    $socmed_type = isset($_POST["socmed_type"]) ? $_POST["socmed_type"] : "";

    // Validate form fields
    if (empty($fullname) || empty($email) || empty($education_level) || empty($current_academic_status) || empty($research_type) || empty($RA_desc) || empty($socmed_name) || empty($socmed_type)) {
        echo '<script>alert("Please fill in all the fields!!");</script>';
    } else {
        // Prepare the INSERT statement
        $insertQuery = "INSERT INTO user (fullname, email, education_level, current_academic_status, research_type, RA_desc, socmed_name, socmed_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $insertQuery);

        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "ssssssss", $fullname, $email, $education_level, $current_academic_status, $research_type, $RA_desc, $socmed_name, $socmed_type);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Record inserted successfully.";
            header("Location: homepage.php");
            exit();
        } else {
            echo "Error inserting record: " . mysqli_stmt_error($stmt);
        }
    }
}

// Initialize variables with empty values
$fullname = "";
$email = "";
$education_level = "";
$current_academic_status = "";
$research_type = "";
$RA_desc = "";
$socmed_name = "";
$socmed_type = "";
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
                <h5><b>PERSONAL INFORMATION</b></h5><br><br><br>
                <div class="mb-3 row">
                    <label for="fullname" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $fullname; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="education_level" class="col-sm-2 col-form-label">Education Level</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="education_level" name="education_level" value="<?php echo $education_level; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="current_academic_status" class="col-sm-2 col-form-label">Current Academic Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="current_academic_status" name="current_academic_status" value="<?php echo $current_academic_status; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="research_type" class="col-sm-2 col-form-label">Research Type</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="research_type" name="research_type" value="<?php echo $research_type; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="RA_desc" class="col-sm-2 col-form-label">Research Area Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="RA_desc" name="RA_desc" value="<?php echo $RA_desc; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="socmed_name" class="col-sm-2 col-form-label">Social Media</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="socmed_name" name="socmed_name" value="<?php echo $socmed_name; ?>">
                    </div>
                    <br><br>
                    <div class="form-check" style="margin-left: 220px;">
                        <input class="form-check-input" type="radio" name="socmed_type" id="Facebook" value="Facebook">
                        <label class="form-check-label" for="Facebook">Facebook</label>
                    </div>
                    <div class="form-check" style="margin-left: 220px;">
                        <input class="form-check-input" type="radio" name="socmed_type" id="Instagram" value="Instagram">
                        <label class="form-check-label" for="Instagram">Instagram</label>
                    </div>
                    <div class="form-check" style="margin-left: 220px;">
                        <input class="form-check-input" type="radio" name="socmed_type" id="Twitter" value="Twitter">
                        <label class="form-check-label" for="Twitter">Twitter</label>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" onclick="window.location.href = 'homepage.php'">CANCEL</button>
                </div>
            </form>
        </div>
        <br><br>
    </div>
    <br><br><br>

    <script>
        function validateForm() {
            var fullname = document.getElementById("fullname").value;
            var email = document.getElementById("email").value;
            var education_level = document.getElementById("education_level").value;
            var current_academic_status = document.getElementById("current_academic_status").value;
            var research_type = document.getElementById("research_type").value;
            var RA_desc = document.getElementById("RA_desc").value;
            var socmed_name = document.getElementById("socmed_name").value;
            var socmed_type = document.querySelector('input[name="socmed_type"]:checked');

            if (fullname === "" || email === "" || education_level === "" || current_academic_status === "" || research_type === "" || RA_desc === "" || socmed_name === "" || socmed_type === null) {
                alert("Please fill in all the fields!!");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>