<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>FK_EDUSEARCH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #286291;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            border-radius: 0 10px 10px 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);

        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #EFEFEF;
            display: block;
            transition: 0.3s;
            font-family: "Century Gothic", sans-serif;
        }

        .sidebar a.active {
            background-color: #54AFE6;
            color: white;
            border-radius: 0 10px 10px 0;
        }

        .sidebar a:hover:not(.active) {
            background-color: #99C2E3;
            color: #262261;
            border-radius: 0 10px 10px 0;
        }

        .sidebar a:hover {
            color: #D5E0FF;
            background-color: #ADE1DF;
            color: #262261;
            border-radius: 0 15px 15px 0;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #62A0D4;
            color: white;
            padding: 10px 15px;
            border: none;
            width: 100%;
            text-align: left;
        }

        .openbtn:hover {
            background-color: #54AFE6;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidebar {
                padding-top: 15px;
            }

            .sidebar a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div id="mySidebar" class="sidebar">
        <img src="/fkedusearch/img/picture9.png" style="height:100px; width:100%; style=" margin-top:100px; ">


<a class=" active" href="#user" align="left">
        <img src="/fkedusearch/img/picture4.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span style="vertical-align: middle;">&nbsp&nbsp
            User</span>
        </a>

        <a href="#discussion" align="left">
            <img src="/fkedusearch/img/picture6.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span style="vertical-align: middle;">&nbsp&nbsp
                Discussion</span>
        </a>

        <a href="#expert" align="left">
            <img src="/fkedusearch/img/picture7.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span style="vertical-align: middle;">&nbsp&nbsp
                Expert</span>
        </a>

        <a href="#report" align="left">
            <img src="/fkedusearch/img/picture8.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span style="vertical-align: middle;">&nbsp&nbsp
                Report</span>
        </a>

        <a href="#complaint" align="left">
            <img src="/fkedusearch/img/picture10.png" style="vertical-align: middle; height: 30px; width: 30px;"> <span style="vertical-align: middle;">&nbsp&nbsp
                Complaint</span>
        </a>
    </div>

    <div id="main">
        <img src="/fkedusearch/img/banner.png" style="height:200px" width="100%">

        <button class="openbtn" onclick="toggleNav()">☰</button>


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

    </div>

    <script>
        function toggleNav() {
            var sidebar = document.getElementById("mySidebar");
            var main = document.getElementById("main");

            if (sidebar.style.width === "250px") {
                sidebar.style.width = "0";
                main.style.marginLeft = "0";
            } else {
                sidebar.style.width = "250px";
                main.style.marginLeft = "250px";
            }
        }
    </script>

</body>

</html>