<?php
include('../session.php');
include('../db.php');



$query = mysqli_query($db, "SELECT * FROM users WHERE `username` = '" . $_SESSION['login_user'] . "' ") or die(mysql_error());
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
  <link rel="icon" href="../seal/wmsu-logo.png" sizes="32x32" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.uapplication.css">
  <link rel="stylesheet" type="text/css" href="../DataTables/datatables.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>






</head>

<style>
  * {
    box-sizing: border-box;
  }

  body {
    background-color: #f1f1f1;
  }

  #regForm {
    background-color: #ffffff;
    margin: 100px auto;
    font-family: Raleway;
    padding: 40px;
    width: 70%;
    min-width: 300px;
  }

  h1 {
    text-align: center;
  }

  input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }

  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }

  /* Hide all steps by default: */
  .tab {
    display: none;
  }

  button {
    background-color: #04AA6D;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
  }

  button:hover {
    opacity: 0.8;
  }

  #prevBtn {
    background-color: #bbbbbb;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #04AA6D;
  }
</style>
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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">

          <?php if (isset($_SESSION['login_user'])) : ?>
            <p>
              Welcome
              <strong>
                <?php echo $arr['applicantid']; ?>
              </strong>
            </p>

          <?php endif ?>
          </p>
          <li class="nav-item">
            <a class="nav-link active" href="../student/UserApplication.php">Dashboard</a>
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
            <div class="col-md-7">
              <h6 class="m-0 font-weight-bold text-danger">List of Courses</h6>
            </div>
            <div class="col-md-5">
              <div class="input-group">
                <input class="form-control border-end-0 border rounded-pill" type="text" placeholder="Search for Course" id="myInput" onkeyup="myFunction()">
                <span class="input-group-append">
                  <button class="btn btn-outline-secondary bg-white border-start-0 border rounded-pill ms-n3" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <table class='selected-col-2' id="myTable">
                <tbody class="tbody">
                  <?php


                  $results = mysqli_query($db, "SELECT * from coursestbl ");


                  ?>

                  <?php $results = mysqli_query($db, "SELECT * from coursestbl ") ?>

                  <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                      <td style="display:none"><?php echo $row['course_id']; ?></td>
                      <td><img class="rounded-circle" src="../collegeimg/<?php echo $row['course_img']; ?>" alt="" width="100px" height="100px"></td>
                      <td><?php echo $row['course_name']; ?></td>
                      <td><?php echo $row['course_description']; ?></td>

                      <td><button type="button" class="btn btn-primary selectCourse">Apply
                        </button></td>
                    </tr>

                  <?php } ?>
                </tbody>
              </table>
             
              <!-- FORWARD ACTION -->
              <div class="modal fade" id="selectModal">
                <form id="send" action="upload.php" method="post" enctype="multipart/form-data">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <?php $getID = mysqli_query($db, "SELECT * from users WHERE username ='gold'");
                      $rows = mysqli_num_rows($getID); ?>
                      <div class="modal-header">

                        <h4 class="modal-title">Upload your Requirements</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="form-group">
                        <input style="display: none;" type="id" name="id" id="id" class="form-control">
                      </div>

                      <div class="form-group">
                        <label>Course Name :</label>
                        <input type="name" name="courseName" disabled="disabled" id="courseName" class="form-control">
                      </div>

                      <div class="form-group">
                        <input style="display: none;" type="text" class="form-control" id="contact" readonly="readonly" name="email" value=" <?php echo $arr['id'] ?>">
                      </div>

                      <div class="modal-body">
                        <div class="col-sm-12">
                          <div class="tab">
                            <label>CET Overall Percentage:</label>
                            <input type="name" name="cetValue" id="cetValue" oninput="this.className = ''" class="form-control">
                            <label for="cet" class="form-label">CET copy</label>
                            <input type="file" id="cet" oninput="this.className = ''" name="cet">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="tab">
                            <label>GPA Percentage:</label>
                            <input type="name" name="gpaValue" id="gpaValue" oninput="this.className = ''" class="form-control">
                            <label for="gpa" class="form-label">GPA Copy</label>
                            <input type="file" id="gpa" oninput="this.className = ''" name="gpa">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="tab">
                            <label for="moral" class="form-label">Good Moral Copy</label>
                            <input type="file" id="moral" oninput="this.className = ''" name="moral">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="tab">
                            <label for="gpa" class="form-label">Shiftee Form copy (if your
                              Shiftee)</label>
                            <input type="file" id="shiftee" oninput="this.className = ''" name="shiftee">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="tab">
                            <label class="form-label">Are you sure you want to submit?</label>
                          </div>
                        </div>
                        <div style="overflow:auto;">

                          <div class="modal-footer">

                            <div style="float:right;">
                              <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                              <button type="button" name="send" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                          </div>
                          <!-- Circles which indicates the steps of the form: -->
                          <div style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                          </div>

                   
                </form>
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
    <script src="../jquery/jquery.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../DataTables/datatables.js"></script>
    <script src="../js/control.js"></script>

    <script>
      $(document).ready(function() {
        $('#myTable').DataTable();
      });
    </script>

    <script>
      $('#myTable').DataTable({
        select: true
      });
    </script>
</body>

</html>


<script>
  var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab

  function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "submit";
      document.getElementById("nextBtn").type = "submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }

  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
      // ... the form gets submitted:
      document.getElementById("send").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }

  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
      // If a field is empty...
      if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false
        valid = false;
      }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }

  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#limit-records").change(function() {
      $('form').submit();
    })
  })
</script>
<script>
  function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>
<script>
  //TRANSFER DATA FROM TABLE TO MODAL
  $(document).ready(function() {
    $('.selectCourse').on('click', function() {


      $('#selectModal').modal('show');
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      $('#id').val(data[0]);
      $('#courseName').val(data[2]);

    });

  });
</script>