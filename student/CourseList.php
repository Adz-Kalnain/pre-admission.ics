
<?php
 include('../session.php');
 include('../db.php');



 $query= mysqli_query($db,"SELECT * FROM users WHERE `username` = '".$_SESSION['login_user']."' ")or die(mysql_error());
 $arr = mysqli_fetch_array($query);

 if (isset($_GET['select'])) {
    $id = $_GET['select'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Course List</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../svgs/logo.png" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.uapplication.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php 
                            echo $_SESSION['message']; 
                            unset($_SESSION['message']);
                          
                            
                        ?>
    </div>
    <?php endif ?>




</head>

<style>

* {
  font-family: Arial;
}

table {
  border-collapse: collapse;
  border: none;
  margin-top: 20px;
}

td,
th {
  padding: 50px;
}

tr:not(:first-child) {
  border-top: 1px solid #dedede;
}

tbody.transparency-demo td {
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
}

tbody.transparency-demo tr:first-child td {
  border-top: 5px solid transparent;
}

a {

  padding: 10px;
  border-radius: 4px;
  cursor: pointer;

}
</style>

<body>

    <header id="uphead">
        <nav class="navbar navbar-expand-lg navbar-dark px-5">
            <a class="navbar-brand justify-content-start" href="UserProfile.html">
                <img src="../svgs/ics_seal.jpg" alt="">WMSU Online Pre-Admission
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">

                    <?php  if (isset($_SESSION['login_user'])) : ?>
                    <p>
                        Welcome
                        <strong>
                            <?php echo $_SESSION['login_user']; ?>
                        </strong>
                    </p>

                    <?php endif ?>
                    </p>
                    <li class="nav-item">
                        <a class="nav-link active" href="../index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../student/UserProfile.php">View Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../student/logout.php">Log-out</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container"><br>
       


 <div class="col-lg-12">

<div class="card shadow mb-4">
  <div class="card-header py-3">
      <div class="row">
      <div class="col-md-9">
      <h6 class="m-0 font-weight-bold text-danger">List of Courses</h6>
      </div>
      <div class="col-md-3">
      <a href="UserApplication.php">Return to Colleges</a>
      </div>
      </div>
  </div>
  <div class="card-body">
  <div class="row">


  <div class="col-lg-12">


<table class='selected-col-2'>
<tbody>
<?php $results = mysqli_query($db, "SELECT * from coursestbl WHERE college_id='$id'")?>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
    <td style="display:none"><?php echo $row['course_id']; ?></td>
    <td><img class="rounded-circle" src="../collegeimg/<?php echo $row['course_img']; ?>" alt=""  width="100px" height="100px"></td>
    <td><?php echo $row['course_name']; ?></td>
    <td><?php echo $row['course_description']; ?></td>
    
    <td><button type="button" class="btn btn-primary selectCourse" >Apply
                        </button></td>
    </tr>
    
    <?php } ?>
</tbody>
</table>
<form action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="modal" id="selectModel">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    <?php  $getID = mysqli_query($db, "SELECT * from users WHERE username ='gold'");
                                           $rows = mysqli_num_rows($getID); ?>
                                  

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Upload your Requirements</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                 <div class="form-group">
                                    <input style="display: none;" type="id"    name="id" id="id"  class="form-control" >
                                </div>

                                    <div class="form-group">
                                        <label>Course Name :</label>
                                        <input type="name" name="courseName" disabled="disabled"  id="courseName" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                            <input style="display: none;" type="text" class="form-control" id="contact" readonly="readonly" name="email"  value=" <?php echo $arr['id']?>">
                                        </div>



                                        <div class="modal-body">
                                            <div class="col-sm-12">
                                                <label for="cet" class="form-label">CET copy</label>
                                                <input type="file" id="cet" name="cet">
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="cet" class="form-label">Good Moral</label>
                                                <input type="file" id="moral" name="moral">
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="gpa" class="form-label">GPA copy</label>
                                                <input type="file" id="gpa" name="gpa">
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="gpa" class="form-label">Shiftee Form copy (if your
                                                    Shiftee)</label>
                                                <input type="file" id="shiftee" name="shiftee">
                                            </div>

                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success" name="send">Upload</button>
                                            
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
<!-- /.container-fluid -->
  
        </div>
        <br>
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



<script>

//TRANSFER DATA FROM TABLE TO MODAL
        $(document).ready(function () {
            $('.selectCourse').on('click', function () {


              $('#selectModel').modal('show');
              $tr = $(this).closest('tr');

                  var data =$tr.children("td").map(function(){
                    return $(this).text();
                  }).get();
                  $('#id').val(data[0]);
                  $('#courseName').val(data[2]);

            });
           
        });
    </script>