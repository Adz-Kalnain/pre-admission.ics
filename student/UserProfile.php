<?php
include('../session.php');
include('../db.php');



$query = mysqli_query($db, "SELECT * FROM users WHERE `username` = '" . $_SESSION['login_user'] . "' ") or die(mysql_error());
$arr = mysqli_fetch_array($query);


?>

<?php
error_reporting(0);
?>
<?php
$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/" . $filename;

    // Get all the submitted data from the form
    $userNamez = $_SESSION['login_user'];
    $sql = "UPDATE users SET image_text = '{$filename}' WHERE `username` = '" . $_SESSION['login_user'] . "'";

    // Execute query
    mysqli_query($db, $sql);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully";
        header("Location: UserProfile.php");
    } else {
        $msg = "Failed to upload image";
    }
}
$result = mysqli_query($db, "SELECT * FROM users");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User Profile</title>
    <link rel="icon" href="../seal/wmsu-logo.png" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styleprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>
    <header id="uphead">
        <nav class="navbar navbar-expand-lg navbar-dark px-5">
            <a class="navbar-brand justify-content-start" href="UserProfile.html">
                <img src="../seal/wmsu-logo.png" alt="">WMSU Online Pre-Admission
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                <p>
              Welcome
              <strong>
                <?php echo $arr['applicantid']; ?>
              </strong>
            </p>
                    <li class="nav-item">
                        <a class="nav-link " href="../student/UserApplication.php">Dashboard</a>
                    </li>
                    
                    <?php $results = mysqli_query($db, "SELECT * from selectedcourse LEFT JOIN users ON selectedcourse.user_id = users.id
                     LEFT JOIN coursestbl ON selectedcourse.course_id = coursestbl.course_id
                     LEFT JOIN attachment ON selectedcourse.file_id = attachment.id WHERE username =  '" . $arr['username'] . "'") ?>
                    <li class="nav-item">
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Status
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Your Application</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <div class="form-group">
                                        <label>Status :</label>
                                     <?php echo $row['status']; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>CET Overall Score :</label>
                                     <?php echo $row['cetValue']; ?>%
                                    </div>
                                    <div class="form-group">
                                        <label>Grade Percent Average :</label>
                                     <?php echo $row['gpaValue']; ?>%
                                    </div>
                                    <div class="form-group">
                                        <label>CET File :</label>
                                     <?php echo $row['cet_path']; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Grade Percent Average File :</label>
                                     <?php echo $row['gpa_path']; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Good Moral File :</label>
                                     <?php echo $row['gmoral_path']; ?>
                                    </div>
                        <?php
                }
                    ?>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../student/logout.php">Log-out</a>
                    </li>
                </ul>
            </div>
        </nav>


    </header>
    <main id="maincontainer">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 mt-10 pt-10">
                    <div class="row z-depth-3 ">
                        <div class="col-sm-3 rounded-left" id="left">
                            <?php
                            $image_src2 = $arr['image_text'];
                            ?>
                            <div class="card-block text-center text-white">
                                <img class="rounded-circle mt-4" src='images/<?php echo $arr['image_text']; ?>' alt="" width="150px" height="150px">
                                <h3 class="font-weight-bold mt-2">Student Picture</h3>
                                <div class="col-sm-6">
                                    <div id="content">

                                        <form method="POST" action="" enctype="multipart/form-data">
                                            <input type="file" name="uploadfile" value="" >
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-10 ">
                                    <br>
                                    <button type="submit" class="btn btn-dark" name="upload" data-placement="right">Upload</button>
                                </div>
                            </div><br>
                        </div>
                        <div class="col-sm-9 bg-white rounded-right ">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="studinfo-tab" data-toggle="tab" href="#studinfo" role="tab" aria-controls="home" aria-selected="true">Student Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="course-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="course" aria-selected="false">Comments</a>
                                </li>
                            </ul>

                            <div class="col-md-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="studinfo" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>First Name</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $arr['fname'] ?></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Last Name</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $arr['lname'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $arr['username'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>User Type</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $arr['user_type'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="col-md-12">
                                            <h3>Nothing to show for now!</h3>
                                        </div>
                                        <div class="col-8 mt-5 pt-5">
                                            <input type="text" class="form-control" id="address" placeholder="Reply to a Comment">
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

</body>

</html>