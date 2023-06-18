<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>FK_EDUSEARCH</title>
</head>

<body>

    <!-- <div class="card">
        <div class="card-header">
            <div class="card-actions float-end">
                <a href="#" class="me-1">
                    <i class="align-middle" data-feather="refresh-cw"></i>
                </a>
                <div class="d-inline-block dropdown show">
                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                        <i class="align-middle" data-feather="more-vertical"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <h5 class="card-title mb-0">Private info</h5>
        </div> -->

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
                    <input type="text" class="form-control" id="inputFirstName" placeholder="First Name">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">Email Address</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">Phone Number</label>
                    <input type="email" class="form-control" id="inputPhone" placeholder="Phone Number">
                </div>
            </div>


            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">Research Area</label>
                    <input type="email" class="form-control" id="inputResearch" placeholder="Research Area">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">List of Publications</label>
                    <input type="email" class="form-control" id="inputList" placeholder="List of Publications">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="inputEmail4">Academic Status</label>
                    <input type="email" class="form-control" id="inputAcademic" placeholder="Academic Status">
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
                        <input type="fb" class="form-control" id="inputAcademic" placeholder="">
                    </div>

                    <div class="mb-2">
                        <i class="align-middle me-2 fab fa-fw fa-twitter"></i>
                        <input type="twitter" class="form-control" id="inputAcademic" placeholder="">
                    </div>

                    <div class="mb-2">
                        <i class="align-middle me-2 fab fa-fw fa-instagram"></i>
                        <input type="ig" class="form-control" id="inputAcademic" placeholder="">
                    </div>

                    <div class="mb-2">
                        <i class="align-middle me-2 fab fa-fw fa-linkedin"></i>
                        <input type="link" class="form-control" id="inputAcademic" placeholder="">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">SAVE</button>
            <button type="submit" class="btn btn-primary">CANCEL</button>
        </form>

    </div>
    









</body>

</html>