<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "fkedusearch_module3") or die(mysqli_error($link));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phoneNum = $_POST["phoneNum"];
    $researchArea = $_POST["researchArea"];
    $listOfPublications = $_POST["listOfPublications"];
    $academicStatus = $_POST["academicStatus"];
    $CV = $_POST["CV"];
    $socialMedia = $_POST["socialMedia"];

    // Validate form fields
    if (empty($name) || empty($email) || empty($phoneNum) || empty($researchArea) || empty($listOfPublications) || empty($academicStatus) || empty($CV) || empty($socialMedia)) {
        echo '<script>alert("Please fill in all the fields!!");</script>';
    } else {
        // Prepare the INSERT statement
        $insertQuery = "INSERT INTO expert (name, email, phoneNum, researchArea, listOfPublications, academicStatus, CV, socialMedia) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $insertQuery);

        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $phoneNum, $researchArea, $listOfPublications, $academicStatus, $CV, $socialMedia);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Record inserted successfully.";
            //header("Location: view.php"); Redirect to view.php
            exit();
        } else {
            echo "Error inserting record: " . mysqli_stmt_error($stmt);
        }
    }
}

// Initialize variables with empty values
$name = "";
$email = "";
$phoneNum = "";
$researchArea = "";
$listOfPublications = "";
$academicStatus = "";
$CV = "";
$socialMedia = "";

?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
</head>

<body>
    <?php include '../ExpertSideBar/Expert_sidebar.php' ?>
    <div class="content">
        <div style="margin-top: 30px; margin-left: 10px;">
            <form class="row g-3" method="POST" action="" onsubmit="return validateForm();">
                <h5><b>CREATE PROFILE</b></h5><br><br>

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
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">SAVE</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-primary" onclick="window.location.href = 'view.php'">EDIT</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phoneNum = document.getElementById("phoneNum").value;
            var researchArea = document.getElementById("researchArea").value;
            var listOfPublications = document.getElementById("listOfPublications").value;
            var academicStatus = document.getElementById("academicStatus").value;
            var CV = document.getElementById("CV").value;
            var socialMedia = document.getElementById("socialMedia").value;

            if (name === "" || email === "" || phoneNum === "" || researchArea === "" || listOfPublications === "" || academicStatus === "" || CV === "" || socialMedia === "") {
                alert("Please fill in all the fields!!");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>