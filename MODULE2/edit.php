<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>FK_EDUSEARCH</title>
    </head>

    <body>
        <div class="content">
            <div style="margin-top: 30px; margin-left: 10px;">
                <form class="row g-3">
                    <h6 align="left"><b>EDIT POST</b></h6><br><br>
                        <div class="mb-3 row" style="margin-top: 10px;">
                            <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="inputCategory" aria-label="Default select example">
                                        <option selected>Select category</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <br><br>
                                    <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputTitle">
                                        </div>
                                        <br><br>
                                    <label for="inputContent" class="col-sm-2 col-form-label">Content</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputContent" rows="3"></textarea>
                                        </div>
                                        <br><br><br><br>
                                    <label for="inputTag" class="col-sm-2 col-form-label">Tags</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputTags">
                                        </div>
                        </div>
                </form>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary">EDIT</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-danger">CANCEL</button>
                    </div> 
            </div>
        </div>
    </body>
</html>