<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>FK_EDUSEARCH</title>
</head>

<body>

    <?php include '../AdminSideBar/Admin_sidebar.php'; ?>
    <div class="card-body">
        <form>

            <style>
                .question-box {

                    flex-direction: column;
                    align-items: center;
                    border: 1px solid #ccc;
                    padding: 10px;
                    margin-bottom: 10px;
                    background-color: #f1f1f1;
                }

                .name {
                    margin-left: 10px;
                    font-weight: bold;
                }

                .approve-button {
                    margin-top: 10px;
                    display: flex;
                    justify-content: center;
                }

                .icon {
                    font-size: 24px;
                    /* Adjust the font size to make the icon bigger */
                }

                .info-box {
                    border: 1px solid #ccc;
                    padding: 15px;
                    margin-top: 12px;
                    background-color: #D3D3D3;
                }

            </style>

            <div class="info-box">
                <div class="question-box">
                    <i class="fas fa-user-circle icon"></i>
                    <span class="name">DR. NOORLINI</span><br>
                    <p>Dr. Noorlini has made changes to her profile information.</p>
                    <div class="approve-button">
                        <button type="submit" class="btn btn-primary">APPROVE</button>
                    </div>
                </div><br>

                <div class="question-box">
                    <i class="fas fa-user-circle icon"></i>
                    <span class="name">DR. AHMAD FAKHRI</span><br>
                    <p>Dr. Ahmad Fakhri Bin Ab. Nasir has made changes to his profile information.</p>
                    <div class="approve-button">
                        <button type="submit" class="btn btn-primary">APPROVE</button>
                    </div>
                </div><br>

                <div class="question-box">
                    <i class="fas fa-user-circle icon"></i>
                    <span class="name">DR. NOOR AZIDA</span><br>
                    <p>Dr. Noor Azida Binti Sahabudin has made changes to her profile information.</p>
                    <div class="approve-button">
                        <button type="submit" class="btn btn-primary">APPROVE</button>
                    </div>
                </div><br>

            </div>





        </form>

    </div>











</body>

</html>