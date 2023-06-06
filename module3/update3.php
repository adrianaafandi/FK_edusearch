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
                            <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">CV</a></li>
                        </ul><br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1" role="tabpanel">
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">CV</label>
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
                            <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab" role="tab">SOCIAL MEDIA</a></li>
                        </ul><br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1" role="tabpanel">
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">FACEBOOK</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">TWITTER</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">INSTAGRAM</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">LINKEDIN</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 
                <div class="col-12">
					<button type="submit" class="btn btn-primary mb-2">UPDATE</button>
                    <button type="submit" class="btn btn-primary mb-2">CANCEL</button>
			    </div>

            </form>
        </div>
    </div>
</body>

</html>