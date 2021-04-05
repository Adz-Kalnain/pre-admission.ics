

<?php
 include('../session.php');
 include('../db.php');



 $query= mysqli_query($db,"SELECT * FROM users WHERE `username` = '".$_SESSION['login_user']."' ")or die(mysql_error());
 $arr = mysqli_fetch_array($query);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User Profile</title>
    <link rel="icon" href="../svgs/logo.png" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.uprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>
    <header id="uphead">
        <nav class="navbar navbar-expand-lg navbar-dark px-5">
            <a class="navbar-brand justify-content-start" href="UserProfile.html">
                <img src="../svgs/ics_seal.jpg" alt="">WMSU ICS Online Pre-Admission
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registration-page.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login-page.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                </ul>
            </div>
        </nav>>
        <section class="container-fluid">
            <div class="toast" data-autohide="false" style="position: absolute; top: 0; right: 0;">
                <div class="toast-header">
                    <strong class="mr-auto text-success">Registration</strong>
                    <small class="text-muted">Just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                </div>
                <div class="toast-body">
                    Congratulations! You have successfully created an account.
                </div>
            </div>
            </div>
        </section>
    </header>
    <main id="maincontainer">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 mt-10 pt-10">
                    <div class="row z-depth-3 ">
                        <div class="col-sm-3 rounded-left" id="left">
                            <div class="card-block text-center text-white">
                                <img class="rounded-circle mt-4" src="meeh.jpg" alt="" width="150px" height="150px">
                                <h3 class="font-weight-bold mt-2">Student Picture</h3>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control-file" id="Studpic" placeholder="" value="">
                                </div>
                                <div class="col-sm-10 ">
                                    <br>
                                    <button type="button" class="btn btn-dark" data-placement="right">Status</button>
                                </div>
                            </div><br>
                        </div>
                        <div class="col-sm-9 bg-white rounded-right ">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="studinfo-tab" data-toggle="tab" href="#studinfo"
                                        role="tab" aria-controls="home" aria-selected="true">Student Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="course-tab" data-toggle="tab" href="#comments" role="tab"
                                        aria-controls="course" aria-selected="false">Comments</a>
                                </li>
                                <div class="d-flex justify-content-end" id="logout">
                                    <a href="../index.html" class="btn btn-outline-secondary" role="button">Logout</a>
                                </div>
                            </ul>

                            <div class="col-md-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="studinfo" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>First Name</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $arr['name']?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Last Name</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p>Dela Cruz</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Birthday</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p>12/12/2000</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p>Upper Calarian, Zamboanga City</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $arr['email']?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Contact Number</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p>09991234567</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="comments" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class="col-md-12">
                                            <h3>Nothing to show for now!</h3>
                                        </div>
                                        <div class="col-8 mt-5 pt-5">
                                            <input type="text" class="form-control" id="address"
                                                placeholder="Reply to a Comment">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="tableC">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 lg-10 col-sm-10">
                <h2>Characteristics of IT and ComSci</h2>
                <table>
                    <tr>
                        <th style="width:50%">Characteristics</th>
                        <th>IT</th>
                        <th>ComSci</th>
                    </tr>
                    <tr>
                        <td>Analytical Skills</td>
                        <td><i class="fa fa-remove"></i></td>
                        <td><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td>Problem solving Skills</td>
                        <td><i class="fa fa-check"></i></td>
                        <td><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td>Creatvity</td>
                        <td><i class="fa fa-check"></i></td>
                        <td><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td>Critical Thinking Skills</td>
                        <td><i class="fa fa-remove"></i></td>
                        <td><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td>Versatile</td>
                        <td><i class="fa fa-check"></i></td>
                        <td><i class="fa fa-check"></i></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <section class="container-fluid justify-content-center" id="Ready">
        <div class="row">
            <div class="col-lg-10 col-md-10">
                <h1>Are you ready to choose your course?</h1>
                <p>Hi there, .</p>
                <div class="Application col-md-10">
                    <a href="UserApplication.php" class="btn btn-primary my-2">Apply for a course</a>
                </div>
            </div>
        </div>
    </section>
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

    <script>
        $(document).ready(function () {
            $('.toast').toast('show');

        });
    </script>
</body>

</html>