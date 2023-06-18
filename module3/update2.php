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
                            <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">LIST OF PUBLICATIONS</a></li>
                        </ul><br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1" role="tabpanel">
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">LIST OF PUBLICATION</label>
                                    <div class="col-sm-8">
                                    <textarea class="form-control" placeholder="1.A mobile application of augmented reality for periodic table with speech recognition."; "2.A survey on current malicious javascript behaviour of infected web content in detection of malicious web pages" rows="4"></textarea><br>
                                    </div>
                                </div>
                                <div class="col-12">
					<button type="submit" class="btn btn-primary mb-2">ADD PUBLICATION</button>
			    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>



                <div class="col-12 col-lg-6">
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">ACADEMIC</a></li>
                        </ul><br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1" role="tabpanel">
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">ACADEMIC STATUS</label>
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