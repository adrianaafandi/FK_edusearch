
<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysql_connect_error());

//Select the database.
mysqli_select_db($link, "Lab9database") or die(mysqli_error($link));

$idURL= $_GET['id'];

//SQL query
$query = "SELECT * FROM person WHERE Person_ID = '$idURL'"
	or die(mysqli_connect_error());
	
//Execute the query (the recordset $rs contains the result)
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);

	$complaint_name = $row["complaint_name"];
	$complaint_datetime = $row["complaint_datetime"];
	$complaint_types = $row["complaint_types"];
    $complaint_desc = $row["complaint_desc"];

?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
</head>

<body>

<img src="/fkedusearch/banner.png" style="height:200px" width="100%">

    <div class="content">
        <div style="margin-top: 30px; margin-left: 10px;">
            <form action="updateAction.php" method="post" class="row g-3">
                <h2 align="left"><b>COMPLAINT</b></h2>
                <p><b>We are here to assist you!</b></p>
                <div class="mb-3 row" style="margin-top: 10px;">
                    <label for="c_name" class="col-sm-2 col-form-label">Complainant's Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="complaint_name" name="complaint_name"
                            value="<?php echo $complaint_name; ?>" placeholder="Write your name" required>
                    </div>
                    <br><br>

                    <label for="c_datetime" class="col-sm-2 col-form-label">Date and Time:</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" id="complaint_datetime"
                            name="complaint_datetime" value="<?php echo $complaint_datetime; ?>"
                            placeholder="Select Date and Time" required>
                    </div>
                    <br><br>

                    <label for="c_types" class="col-sm-2 col-form-label">Complaint Type:</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="c_types" name="c_types" aria-label="Default select example"
                            required>
                            <option selected>Choose your complaint type</option>
                            <option value="complaint_types1">Unsatisfied Expert's Feedback</option>
                            <option value="complaint_types2">Wrongly Assigned Research Area</option>
                            <option value="complaint_types3">Others</option>
                        </select>
                    </div>
                    <br><br>

                    <label for="c_desc" class="col-sm-2 col-form-label">Complaint Details:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="complaint_desc" name="complaint_desc"
                            value="<?php echo $complaint_desc; ?>" rows="3"
                            placeholder="Describe your complaint details"></textarea>
                    </div>
                    <br><br><br><br>

                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">SUBMIT</button>

                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" onclick="goBack()">CANCEL</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
