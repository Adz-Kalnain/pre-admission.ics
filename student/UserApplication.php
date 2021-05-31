<?php
include('../session.php');
include('../db.php');



$query = mysqli_query($db, "SELECT * FROM users WHERE `username` = '" . $_SESSION['login_user'] . "' ") or die(mysql_error());
$arr = mysqli_fetch_array($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Application</title>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../seal/wmsu-logo.png" sizes="32x32" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.uapplication.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../svgs/sweetalert2.all.min.js"></script>

  <?php if (isset($_SESSION['message'])) : ?>
    <div class="msg">

      <script>
        Swal.fire(
          'Congrats!',
          'You have successfully applied for a course',
          'success'
        )
      </script>


      <?php
      unset($_SESSION['message']);
      ?>
    </div>
  <?php endif ?>



  <?php if (isset($_SESSION['error'])) : ?>
    <div class="msg">

      <script>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'You can only apply for 1 course at a time!',
          footer: '<a href>Why do I have this issue?</a>'
        })
      </script>


      <?php
      unset($_SESSION['message']);
      ?>
    </div>
  <?php endif ?>


  <style>
    body {
      font-family: Arial;
    }

    * {
      box-sizing: border-box;
    }

    form.example input[type=text] {
      padding: 10px;
      font-size: 17px;
      border: 1px solid grey;
      float: left;
      width: 80%;
      background: #f1f1f1;
    }

    form.example button {
      float: left;
      width: 20%;
      padding: 10px;
      background: crimson;
      color: white;
      font-size: 17px;
      border: 1px solid grey;
      border-left: none;
      cursor: pointer;
    }

    form.example button:hover {
      background: maroon;
    }

    form.example::after {
      content: "";
      clear: both;
      display: table;
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
      <label>Search for your desired course</label>
      <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
        <input type="text" placeholder="Search.." name="search" id="myInput" onkeyup="myFunction()">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <div class="row">
          <div class="col-md-10">
          <h6 class="m-0 font-weight-bold text-danger">List of Colleges</h6>
          </div>
          <div class="col-md-2">
          <a href="Listofcourses.php">View all Courses</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">


            <div class="col-lg-12">


              <table class='selected-col-2' id="myTable">
                <tbody>
                  <?php
                  $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 5;
                  $page = isset($_GET['page']) ? $_GET['page'] : 1;
                  $start = ($page - 1) * $limit;
                  $results = mysqli_query($db, "SELECT * from college LIMIT $start,$limit");
                  $results1 = mysqli_query($db, "SELECT COUNT(college_id) AS id from college");
                  $collegeCount = mysqli_fetch_array($results1);
                  $total = $collegeCount['id'];
                  $pages = ceil($total / $limit);

                  $Previous = $page - 1;
                  $Next = $page + 1;
                  ?>

                  <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                      <td><img class="rounded-circle" src="../collegeimg/<?php echo $row['college_img']; ?>" alt="" width="100px" height="100px"></td>
                      <td><?php echo $row['college_name']; ?></td>
                      <td><?php echo $row['college_description']; ?></td>
                      <td style="display: none;"><?php echo $row['college_id']; ?></td>
                      <td><a href="CourseList.php?select=<?php echo $row['college_id']; ?>">Select</a></td>
                    </tr>

                  <?php } ?>
                </tbody>
              </table>
              <div class="col-md-10">
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                    <li>
                      <a href="UserApplication.php?page=<?= $Previous; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                      </a>
                    </li>
                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                      <li><a href="UserApplication.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php endfor; ?>
                    <li>
                      <a href="UserApplication.php?page=<?= $Next; ?>" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
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
    td = tr[i].getElementsByTagName("td")[1];
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
</body>

</html>