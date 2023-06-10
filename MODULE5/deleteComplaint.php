<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "fkedusearch") or die(mysqli_error($link));

$idURL = isset($_GET['id']) ? $_GET['id'] : '';

//The SQL statement that deletes the record
$query = "SELECT * FROM complaint WHERE complaint_id = '$idURL'";


//Execute the query (the recordset $rs contains the result)
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);

$complaint_name = isset($row["complaint_name"]) ? $row["complaint_name"] : '';
$complaint_datetime = isset($row["complaint_datetime"]) ? $row["complaint_datetime"] : '';
$complaint_types = isset($row["complaint_types"]) ? $row["complaint_types"] : '';
$complaint_desc = isset($row["complaint_desc"]) ? $row["complaint_desc"] : '';
$complaint_id = isset($row["complaint_id"]) ? $row["complaint_id"] : '';

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
            <form action="deleteAction.php" method="post" class="row g-3">
                <h2 align="left"><b>COMPLAINT</b></h2>
                <p><b>Admin Page</b></p>
                <div class="mb-3 row" style="margin-top: 10px;">
                    <label for="complaint_name" class="col-sm-2 col-form-label">Complainant's Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="complaint_name" name="complaint_name"
                            value="<?php echo $complaint_name; ?>" required>
                        
                    </div>
                    <br><br>

                    <label for="complaint_datetime" class="col-sm-2 col-form-label">Date and Time:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="complaint_datetime"
                            name="complaint_datetime" value="<?php echo $complaint_datetime; ?>"
                            required>
                    </div>
                    <br><br>

                    <label for="complaint_types" class="col-sm-2 col-form-label">Complaint Type:</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="complaint_types" name="complaint_types" aria-label="Default select example"
                            required>
                            <option selected>Choose your complaint type</option>
                            <option value="complaint_types1" <?php if ($complaint_types == 'complaint_types1') echo 'selected'; ?>>Unsatisfied Expert's Feedback</option>
                            <option value="complaint_types2" <?php if ($complaint_types == 'complaint_types2') echo 'selected'; ?>>Wrongly Assigned Research Area</option>
                            <option value="complaint_types3" <?php if ($complaint_types == 'complaint_types3') echo 'selected'; ?>>Others</option>
                        </select>
                    </div>
                    <br><br>

                    <label for="complaint_desc" class="col-sm-2 col-form-label">Complaint Details:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="complaint_desc" name="complaint_desc" rows="3"><?php echo $complaint_desc; ?></textarea>
                    </div>
                    <br><br><br><br>

                    <input type="hidden" name="id2" value="<?php echo $complaint_id; ?>">

                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">DELETE</button>

                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" onclick="goBack()">CANCEL</button>
                </div>
            </form>

            <table>
                <tr>
                    <td>Complaint's Name: <?php echo $complaint_name; ?></td><br>
                </tr>
                <tr>
                    <td>Date and Time: <?php echo $complaint_datetime; ?></td><br>
                </tr>
                <tr>
                    <td>Complaint Type: <?php echo $complaint_types; ?></td><br>
                </tr>
                <tr>
                    <td>Complaint Details: <?php echo $complaint_desc; ?></td><br>
                </tr>
                <tr>
                    <td>
                        <a href="edit.php?id=<?php echo $complaint_id; ?>">Ubah</a> ||
                        <a href="delete.php?id=<?php echo $complaint_id; ?>">Padam</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
