<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
    <img src="img.png" class="img-fluid">
</head>

<body>
    <?php
    // Connect to the database server.
    $link = mysqli_connect("localhost", "root", "", "fkedusearch", "8111") or die(mysqli_connect_error());

    // Select the database
    mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

    // Retrieve data from expert table
    $expertQuery = "SELECT * FROM expert WHERE id = 1";
    $expertResult = mysqli_query($link, $expertQuery);
    $expertData = mysqli_fetch_assoc($expertResult);

    // Retrieve data from publication table
    $publicationQuery = "SELECT * FROM publication WHERE id = 1";
    $publicationResult = mysqli_query($link, $publicationQuery);
    $publicationData = mysqli_fetch_assoc($publicationResult);

    // Retrieve data from research table
    $researchQuery = "SELECT * FROM research WHERE id = 1";
    $researchResult = mysqli_query($link, $researchQuery);
    $researchData = mysqli_fetch_assoc($researchResult);

    // Initialize variables with retrieved values
    $name = isset($expertData['name']) ? $expertData['name'] : "";
    $email = isset($expertData['email']) ? $expertData['email'] : "";
    $phoneNum = isset($expertData['phoneNum']) ? $expertData['phoneNum'] : "";
    $academicStatus = isset($expertData['academicStatus']) ? $expertData['academicStatus'] : "";
    $CV = isset($expertData['CV']) ? $expertData['CV'] : "";
    $socialMedia = isset($expertData['socialMedia']) ? $expertData['socialMedia'] : "";
    $list_publication = isset($publicationData['list_publication']) ? $publicationData['list_publication'] : "";
    $research_area = isset($researchData['research_area']) ? $researchData['research_area'] : "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phoneNum = $_POST["phoneNum"];
        $academicStatus = $_POST["academicStatus"];
        $CV = $_POST["CV"];
        $socialMedia = $_POST["socialMedia"];
        $list_publication = $_POST["list_publication"];
        $research_area = $_POST["research_area"];

        // Validate form fields
        if (empty($name) || empty($email) || empty($phoneNum) || empty($academicStatus) || empty($CV) || empty($socialMedia)) {
            echo '<script>alert("Please fill in all the fields!!");</script>';
        } else {
            // Prepare the UPDATE statement
            $updateQuery = "UPDATE expert, publication, research SET expert.name=?, expert.email=?, expert.phoneNum=?, expert.academicStatus=?, expert.CV=?, expert.socialMedia=?, publication.list_publication=?, research.research_area=? WHERE expert.id=1";
            $stmt = mysqli_prepare($link, $updateQuery);

            // Bind parameters to the statement
            mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $phoneNum, $academicStatus, $CV, $socialMedia, $list_publication,  $research_area);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Record updated successfully.";
                header("Location: homepageExpert.php"); //Redirect to view.php
                exit();
            } else {
                echo "Error updating record: " . mysqli_stmt_error($stmt);
            }
        }
    }
    ?>

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
                    <label for="academicStatus" class="col-sm-2 col-form-label">Academic Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="academicStatus" name="academicStatus" value="<?php echo $academicStatus; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="CV" class="col-sm-2 col-form-label">CV</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="CV" name="CV" value="<?php echo $CV; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="socialMedia" class="col-sm-2 col-form-label">Social Media</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="socialMedia" name="socialMedia" value="<?php echo $socialMedia; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="listPublication" class="col-sm-2 col-form-label">List Publication</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="list_publication" name="list_publication" value="<?php echo $list_publication; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="researchArea" class="col-sm-2 col-form-label">Research Area</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="research_area" name="research_area" value="<?php echo $research_area; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phoneNum = document.getElementById("phoneNum").value;
            var academicStatus = document.getElementById("academicStatus").value;
            var CV = document.getElementById("CV").value;
            var socialMedia = document.getElementById("socialMedia").value;

            if (name.trim() == "" || email.trim() == "" || phoneNum.trim() == "" || academicStatus.trim() == "" || CV.trim() == "" || socialMedia.trim() == "") {
                alert("Please fill in all the fields!!");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>