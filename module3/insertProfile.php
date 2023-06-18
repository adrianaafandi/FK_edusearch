<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>FK_EDUSEARCH</title>
</head>

<body>

    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="inputUsername">Username</label>
                        <input type="text" class="form-control" id="inputUsername" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="inputUsername">Biography</label>
                        <textarea rows="2" class="form-control" id="inputBio" placeholder="Tell something about yourself"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <img alt="Chris Wood" src="img/avatars/avatar.jpg" class="rounded-circle img-responsive mt-2" width="128" height="128" />
                        <div class="mt-2">
                            <span class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
                        </div>
                        <small>For best results, use an image at least 128px by 128px in .jpg
                            format</small>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>

    </div>
    </div>








</body>

</html>