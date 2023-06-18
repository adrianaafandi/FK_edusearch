<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>FK_EDUSEARCH</title>
</head>

<body>

    <?php include '../UserSideBar/User_sidebar.php' ?>

    <?php
    // Connect to the database server.
    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

    // Select the database
    mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $id = $_POST["id"];
        $name = $_POST["inputName"];
        $email = $_POST["inputEmail"];
        $phoneNum = $_POST["inputPhone"];
        $researchArea = $_POST["inputResearch"];
        $listOfPublications = $_POST["inputList"];
        $academicStatus = $_POST["inputAcademic"];
        $cv = $_FILES["inputCV"]["name"];
        $socialMedia = $_POST["inputSocialMedia"];

        // Validate form fields
        if (empty($id) || empty($Name) || empty($email) || empty($phoneNum) || empty($researchArea) || empty($listOfPublications) || empty($academicStatus) || empty($cv) || empty($socialMedia)) {
            echo '<script>alert("Please fill in all the fields!!");</script>';
        } else {
            // Construct INSERT query
            $insertQuery = "INSERT INTO expert (id, inputName, inputEmail, inputPhone, inputResearch, inputList, inputAcademic, inputCV, inputSocialMedia) 
            VALUES ('$id', '$name', '$email', '$phoneNum', '$researchArea', '$listOfPublications', '$academicStatus', '$cv', '$socialMedia')";

            // Execute INSERT query
            if (mysqli_query($link, $insertQuery)) {
                echo "Record inserted successfully.";
                header("Location: view.php"); // Redirect to view.php
                exit();
            } else {
                echo "Error inserting record: " . mysqli_error($link);
            }
        }
    }

    // Fetch the categories from the database
    $categoryQuery = "SELECT * FROM category";
    $categoryResult = mysqli_query($link, $categoryQuery);

    // Initialize variables with empty values
    $id = "";
    $name = "";
    $emai = "";
    $phoneNum = "";
    $researchArea = "";
    $listOfPublications = "";
    $academicStatus = "";
    $cv = "";
    $socialMedia = "";
    ?>




    <div class="card-body">
        <form>
            <div class="col-md-4">
                <div class="text-center">
                    <img alt="avatar" src="/FKEduSearch/FK_edusearch/module3/avatar.png" class="rounded-circle img-responsive mt-2" width="128" height="128" />
                    <div class="mt-2">
                        <label for="imageUpload" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload
                            <input type="file" id="imageUpload" style="display: none;">
                        </label>
                    </div>

                    <script>
                        document.getElementById('imageUpload').addEventListener('change', function(event) {
                            var file = event.target.files[0];
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                document.querySelector('img').src = e.target.result;
                            };

                            reader.readAsDataURL(file);
                        });
                    </script>


                    <small>For best results, use an image at least 128px by 128px in .jpg
                        format</small>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputFirstName">Name</label>
                    <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">Email Address</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">Phone Number</label>
                    <input type="email" class="form-control" id="inputPhone" name="inputPhone" placeholder="Phone Number">
                </div>
            </div>


            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">Research Area</label>
                    <input type="email" class="form-control" id="inputResearch" name="inputResearch" placeholder="Research Area">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">List of Publications</label>
                    <input type="email" class="form-control" id="inputList" name="inputList" placeholder="List of Publications">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">Academic Status</label>
                    <input type="email" class="form-control" id="inputAcademic" name="inputAcademic" placeholder="Academic Status">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="title" class="col-sm-2 col-form-label">CV</label>
                    <input type="file" class="form-control" id="inputCV" placeholder="Upload CV">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">SOCIAL MEDIA</label>
                    <div class="mb-2">
                        <i class="align-middle me-2 fab fa-fw fa-facebook"></i>
                        <input type="fb" class="form-control" id="inputSocialMedia" name="inputSocialMedia" placeholder="">
                    </div>

                    <div class="mb-2">
                        <i class="align-middle me-2 fab fa-fw fa-twitter"></i>
                        <input type="twitter" class="form-control" id="inputSocialMedia" name="inputSocialMedia" placeholder="">
                    </div>

                    <div class="mb-2">
                        <i class="align-middle me-2 fab fa-fw fa-instagram"></i>
                        <input type="ig" class="form-control" id="inputSocialMedia" name="inputSocialMedia" placeholder="">
                    </div>

                    <div class="mb-2">
                        <i class="align-middle me-2 fab fa-fw fa-linkedin"></i>
                        <input type="link" class="form-control" id="inputSocialMedia" name="inputSocialMedia" placeholder="">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">EDIT</button>
            <button type="submit" class="btn btn-primary">CANCEL</button>
        </form>

    </div>










</body>

</html>