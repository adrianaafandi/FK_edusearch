<<<<<<< Updated upstream
=======
<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "YES", "fk-edusearch", "3307") or die(mysql_connect_error());

//Select the database.
mysqli_select_db($link, "fk-edusearch") or die(mysqli_error($link));

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

>>>>>>> Stashed changes
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
</head>

<body>


    <div class="content">
        <div style="margin-top: 30px; margin-left: 10px;">
            <form class="row g-3" method="POST" action="">
                <h4 align="left"><b>UPDATE INFORMATION</b></h4><br>
                <br><br>

                <div class="col-12 col-lg-6">
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">PROFILE</a></li>
                        </ul><br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1" role="tabpanel">
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">FIRST NAME</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">LAST NAME</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">EMAIL ADDRESS</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">PHONE NUMBER</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">PROFILE PICTURE</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="col-12 col-lg-6">
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">RESEARCH AREA</a></li>
                        </ul><br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1" role="tabpanel">
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">RESEARCH AREA</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 
                <div class="col-12">
					<button type="submit" class="btn btn-primary mb-2">NEXT</button>
			    </div>

            </form>
        </div>
    </div>
</body>

</html>