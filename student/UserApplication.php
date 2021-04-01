<?php include('upload.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Application</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.uapplication.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <header id="uphead">
        <nav class="navbar navbar-expand-lg navbar-dark px-5">
            <a class="navbar-brand justify-content-start" href="UserApplication.html">
                <img src="../svgs/ics_seal.jpg" alt="">WMSU ICS Online Pre-Admission
            </a>
        </nav>
    </header>
    <div class="jumbotron">
        <div class="container">
            <h3>Choose your course</h3>
            <div class="row">
                <div class="CS-text col-md-12">
                    <p>Computer Science</p>
                    <div class="CS-image col-md-12">
                        <div class="CS-modal col-md-12">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#CS-Modal">
                                Apply for CS
                            </button>
                            <p>As an old curriculum shiftee, my decisions were limited on what course i could take. Cold winds blew me
                             towards the ICS destination but then, warm breeze caressed me throughout my tech journey.</p>
                            <!-- The Modal -->
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="modal" id="CS-Modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Upload your Requirements</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">

                                                <div class="col-sm-12">
                                                    <label for="cet" class="form-label">CET copy</label>
                                                    <input type="file" id="cet">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="cet" class="form-label">Good Moral</label>
                                                    <input type="file" id="cet">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="gpa" class="form-label">GPA copy</label>
                                                    <input type="file" id="gpa">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="gpa" class="form-label">Shiftee Form copy (if your
                                                        Shiftee)</label>
                                                    <input type="file" id="shiftee">
                                                </div>

                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success" name="upload">Upload</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="IT-text col-md-12">
                    <p>Information Technology</p>
                    <div class="IT-image col-md-12">
                        <div class="IT-modal col-md-12">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#IT-Modal">
                                Apply for IT
                            </button>
                            <!-- The Modal -->
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="modal" id="IT-Modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Upload your Requirements</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">

                                                <div class="col-sm-12">
                                                    <label for="cet" class="form-label">CET copy</label>
                                                    <input type="file" id="cet">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="cet" class="form-label">Good Moral</label>
                                                    <input type="file" id="cet">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="gpa" class="form-label">GPA copy</label>
                                                    <input type="file" id="gpa">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="gpa" class="form-label">Shiftee Form copy (if your
                                                        Shiftee)</label>
                                                    <input type="file" id="shiftee">
                                                </div>

                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success" name="upload" data-dismiss="modal">Upload</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-md-6 text-center">
                <p>©Copyright 2020-2023
                    <a href="#">Kainotomo Tech</a>
                </p>
            </div>

            <div class="col-md-3 text-center">
                <p><a href="#">About Us</a></p>
            </div>
            <div class="col-md-3">
                <p><a href="#">Contact Us</a></p>
            </div>
        </div>
    </div>
</body>

</html>