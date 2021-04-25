<?php 
include('../functions.php');
include('admin.function.php');

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="icon" href="../seal/wmsu-logo.png" sizes="32x32" type="image/png">

    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">          
    <link rel="stylesheet" href="../css/admin.style.css">
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.css">

</head>
<body>
    <?php if (isset($_SESSION['user'])) : ?>
    <header class="page-header">
        <nav>
          <button class="toggle-mob-menu" aria-expanded="false" aria-label="open menu">
            <i class="fa fa-bars"></i>
          </button>
          <a href="#">
            <img class="logo mx-auto" src="../seal/wmsu-logo.png" alt="ics logo">
          </a>
          <ul class="admin-menu">
            <li class="menu-heading">
              <h3>Dashboard</h3>
            </li>
            <li>
              <a href="admin.main.php">
                <i class="fa fa-list" aria-hidden="true"><span>Applicants</span></i>
              </a>
            </li>
            <li>
              <a href="admin.pre.php">
                <i class="fa fa-check" aria-hidden="true"><span>Prequalified</span></i>
              </a>
            </li>
            <li>
              <a href="admin.qual.php">
                  <i class="fa fa-thumbs-o-up" aria-hidden="true"><span>Qualified</span></i>
              </a>
            </li>
            <li>
              <a href="admin.rej.php">
                <i class="fa fa-thumbs-o-down" aria-hidden="true"><span>Rejected</span></i>
              </a>
            </li>
            <li class="menu-heading">
              <h3>Settings</h3>
            </li>
            <li>
              <a href="admin.sett.php" class="active">
                <i class="fa fa-cog" aria-hidden="true"><span>Settings</span></i>
              </a>
            </li>
            <li>
              <a href="../index.php?logout='1'">
                <i class="fa fa-sign-out"><span>Logout</span></i>
                
              </a>
            </li>
          </ul>
        </nav>
    </header>
    <?php endif ?>
      <section class="page-content">
        <section class="btn-group">
          <p class="section-name">Settings</p>
        </section>
        <section class="grid">
          <article class="setting">
              <div class="accordion" id="accordionexample">
                <!--Requirement Management------------------------------------------>
                <div class="card">
                    <div class="card-header" id="headerone">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseone" aria-expanded="true" aria-controls="collapseone">
                                Requirement Management
                            </button>
                        </h5>
                    </div>

                    <div class="collapse" id="collapseone"aria-labelledby="headerone" data-parent="#accordionexample">
                        <div class="card-body">

                        <?php 
                        $db = mysqli_connect('localhost', 'root', '', 'initialsystem');
                        $college = "";
                        $cet = "";
                        $gpa = "";
                        if (isset($_POST['submit'])) {
                            $college = $_POST['college'];
                            $cet = $_POST['cet'];
                            $gpa = $_POST['gpa'];

                            $sql_check = "SELECT * FROM requirementtbl WHERE college='$college' LIMIT 1";
            
                            $res_check = mysqli_query($db, $sql_check);

                            if (mysqli_num_rows($res_check) == 1) {
                                $query = "UPDATE requirementtbl SET cet='$cet', gpa='$gpa' WHERE college='$college'";
                                $results = mysqli_query($db, $query);
                                
                                if ($results) {
                                  echo "<div class='form'>
                                      <h5>You Updated the set requirement successfully.</h5><br/>
                                      <p class='link'><a href='admin.sett.php'>Try again.</a></p>
                                      </div>";
                                }
                            }else{
                              $query = "INSERT INTO requirementtbl (college, cet, gpa) 
                              VALUES ('$college','$cet', '$gpa')";
                              $results = mysqli_query($db, $query);
                                    if ($results) {
                                        echo "<div class='form'>
                                            <h5>You Inserted the set requirement successfully.</h5><br/>
                                            <p class='link'><a href='admin.sett.php'>Try again.</a></p>
                                            </div>";
                                    }
                                //exit();
                            }
                        }else{
                    ?>

                          <form action="" method="post" class="form">
                            <label for="gpa">GPA (Grade Point Average)</label>
                            <input type="number" name="gpa" class="form-control  mb-3" required>
                            <label for="cet">CET Score (College Entrance Test)</label>
                            <input type="number" name="cet" class="form-control" required>
                            <label class="control-label mt-3" for="college">For College Of:</label>
                            <select class="form-control input-sm" name="college" id="college" required>
                              <option value="ics">Institute of Computer Studies</option>
                              <option value="coe">College of Engineering</option> 
                            </select>
                            <input type="submit" class="btn mt-3" name="submit" value="submit" id="allSettingButtons">
                          </form>
                    <?php
                      }
                    ?>  
                          </div>
                    </div>
                </div>
                
                <!---Course Management---------------------------------------------->
                <div class="card">
                    <div class="card-header" id="headertwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="false" aria-controls="collapsetwo">
                                Course Management
                            </button>
                        </h5>
                    </div>

                    <div class="collapse" id="collapsetwo"aria-labelledby="headertwo" data-parent="#accordionexample">
                        <div class="card-body">
                        <?php 
                          $db = mysqli_connect('localhost', 'root', '', 'initialsystem');
                          $coursename = "";
                          $coursedescription = "";
                          $college = "";
                          if (isset($_POST['courseSubmit'])) {
                              $coursename = $_POST['courseName'];
                              $coursedescription = $_POST['courseDescription'];  
                              $college = $_POST['college'];
                              
                              $sql_check = "SELECT * FROM coursestbl WHERE course_name='$coursename' LIMIT 1";
              
                              $res_check = mysqli_query($db, $sql_check);

                              if (mysqli_num_rows($res_check) == 1) {
                                echo "<div class='form'>
                                <h5>Course already created. Try a different one</h5><br/>
                                <p class='link'><a href='admin.sett.php'>Try again.</a></p>
                                </div>";
                              }else{
                                $query = "INSERT INTO coursestbl (course_name, course_description, college) 
                                VALUES ('$coursename','$coursedescription', '$college')";
                                $results = mysqli_query($db, $query);
                                
                                if ($results) {
                                  echo "<div class='form'>
                                      <h5>Course created successfully.</h5><br/>
                                      <p class='link'><a href='admin.sett.php'>Try again.</a></p>
                                      </div>";
                                }
                                  //exit();
                              }
                          }else{
                        ?>  
                          <form action="admin.sett.php" method="post" class="form">
                              <label for="courseName">Course Name:</label>
                              <input type="text" name="courseName" class="form-control  mb-3" required>
                              <label for="courseDescription">Course Description</label>
                              <textarea class="form-control" name="courseDescription" id="" cols="30" rows="10" required></textarea>
                              <label class="control-label mt-3" for="college">For College Of:</label>
                              <select class="form-control input-sm" name="college" id="college" required>
                                <option value="ics">Institute of Computer Studies</option>
                                <option value="coe">College of Engineering</option> 
                              </select>
                              <input type="submit" class="btn mt-3" name="courseSubmit" value="submit" id="allSettingButtons">
                              <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#courseModal" id="allSettingButtons">View all created course here</button>
                          
                          </form>
                        <?php
                          }
                        ?>
                          <div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="courseModalTitle">Courses and Descriptions</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                                      <table class="table table-sm table-striped table-bordered table-hover">
                                          <thead class="thead">
                                          <?php $course_results = mysqli_query($db, "SELECT * FROM coursestbl"); ?>
                                              <tr>
                                                  <th>Course Name</th>
                                                  <th>Course Description</th>
                                                  <th>College</th>
                                                  <th>Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody class="tbody">
                                            <?php while ($row = mysqli_fetch_array($course_results)) { ?>
                                              <tr>
                                                <td><?php echo $row['course_name']; ?></td>
                                                <td><?php echo $row['course_description']; ?></td>
                                                <td><?php echo $row['college']; ?></td>
                                                <td>
                                                  <a href="admin.sett.php" class="edit_btn" >Edit</a>
                                                  --
                                                  <a class="btnDelete" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                                                </td>
                                              </tr>
                                            <?php } ?>
                                            </tbody>
                                      </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-danger" data-dismiss="modal" id="allSettingButtons">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                      </div>
                    </div>
                </div>

                <!--Admission-------------------------------------------------------->
                <div class="card">
                    <div class="card-header" id="headerthree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsethree" aria-expanded="false" aria-controls="collapsethree">
                                Admission
                            </button>
                        </h5>
                    </div>

                    <div class="collapse" id="collapsethree"aria-labelledby="headerthree" data-parent="#accordionexample">
                        <div class="card-body">
                        <?php 
                          $db = mysqli_connect('localhost', 'root', '', 'initialsystem');
                          $start = "";
                          $end = "";
                          if (isset($_POST['admissionSubmit'])) {
                              $start = $_POST['startingdate'];
                              $end = $_POST['endingdate'];
                          
                              $sql_check = "SELECT * FROM admissiondatetbl WHERE is_active='1' LIMIT 1";
              
                              $res_check = mysqli_query($db, $sql_check);

                              if (mysqli_num_rows($res_check) == 1) {
                                  $query = "UPDATE admissiondatetbl SET start_date='$start', end_date='$end' WHERE is_active='1'";
                                  $results = mysqli_query($db, $query);
                                  
                                  if ($results) {
                                    echo "<div class='form'>
                                        <h5>You have updated the admission date successfully.</h5><br/>
                                        <p class='link'><a href='admin.sett.php'>Try again.</a></p>
                                        </div>";
                                  }
                              }else{
                                $query = "INSERT INTO admissiondatetbl (start_date, end_date, is_active) 
                                VALUES ('$start','$end', '1')";
                                $results = mysqli_query($db, $query);
                                      if ($results) {
                                          echo "<div class='form'>
                                              <h5>You have set the admission date successfully.</h5><br/>
                                              <p class='link'><a href='admin.sett.php'>Try again.</a></p>
                                              </div>";
                                      }
                                  //exit();
                              }
                          }else{
                      ?>
                            
                            <form action="admin.sett.php" method="POST" class="form">
                              <label for="startingdate">Set the starting date of Admission :</label>
                              <input type="date" name="startingdate" class="form-control mb-3">
                              <label for="endingdate">Set the End date of Admission :</label>
                              <input type="date" name="endingdate" class="form-control mb-3">
                              
                              <input type="submit" class="btn mt-3" name="admissionSubmit" value="submit" id="allSettingButtons">
                            </form>
                      <?php
                        }
                      ?>
                          </div>
                    </div>

                </div>

                  <!--For Creating New Account------------------------------------------------>
                <div class="card">
                  <div class="card-header" id="headerfour">
                      <h5 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                              Create new account
                          </button>
                      </h5>
                  </div>

                  <div class="collapse" id="collapsefour"aria-labelledby="headerfour" data-parent="#accordionexample">
                      <div class="card-body">
                          <?php 
                          $db = mysqli_connect('localhost', 'root', '', 'initialsystem');
                          $username = "";
                          $email = "";
                          $name = "";
                          $college = "";
                          $role = "";
                          if (isset($_POST['create'])) {
                              $name = $_POST['name'];
                              $username = $_POST['username'];
                              $email = $_POST['email'];
                              $password = $_POST['password'];
                              $college = $_POST['college'];
                              $role = $_POST['role'];

                              $sql_u = "SELECT * FROM users WHERE username='$username'";
                              $sql_e = "SELECT * FROM users WHERE email='$email'";
              
                              $res_u = mysqli_query($db, $sql_u);
                              $res_e = mysqli_query($db, $sql_e);

                              if (mysqli_num_rows($res_u) > 0) {
                              $name_error = "Username already taken"; 	
                              }else if(mysqli_num_rows($res_e) > 0){
                              $email_error = "Email already taken"; 	
                              }else{
                                  $query = "INSERT INTO users (name, username, email, password, user_type, college) 
                                          VALUES ('$name','$username', '$email', '".md5($password)."', '$role' , '$college')";
                                  $results = mysqli_query($db, $query);
                                      //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                      if ($results) {
                                          echo "<div class='form'>
                                              <h3>You created an account successfully.</h3><br/>
                                              <p class='link pb-2'>Click here to <a href='admin.sett.php'>Retry</a></p>
                                              </div>";
                                      } else {
                                          echo "<div class='form'>
                                              <h3>Required fields are missing.</h3><br/>
                                              <p class='link'>Click here to <a href='admin.sett.php'>Retry</a> again.</p>
                                              </div>";
                                      }
                                  //exit();
                              }
                          }else{
                      ?>
                          <form action="admin.sett.php" method="POST" name="createAccount">

                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control login-input mb-3" id="name" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
            
                            <label for="username" class="form-label">Username</label>
                            <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
                              <input type="text" class="form-control login-input mb-3" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                              <?php if (isset($name_error)): ?>
                              <span><?php echo $name_error; ?></span>
                              <?php endif ?>

                            </div>
                            <label for="email" class="form-label">Email</label>
                            <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
                              <input type="email" class="form-control login-input mb-3" id="email" name="email" placeholder="Email Adress" value="<?php echo $email; ?>" required>
                              <?php if (isset($email_error)): ?>
                              <span><?php echo $email_error; ?></span>
                              <?php endif ?>
                            </div>
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control login-input" name="password" placeholder="Password" required>
            
                            <label class="control-label mt-3" for="college">College:</label>
                            <select class="form-control input-sm mb-3" name="college" id="college" required>
                              <option value="ics">Institute of Computer Studies</option>
                              <option value="coe">College of Engineering</option> 
                            </select>

                            <label class="control-label" for="role">Role:</label>
                            <select class="form-control input-sm" name="role" id="role">
                              <option value="admin">Administrator</option>
                              <option value="ao">Admission Officer</option>
                              <option value="evaluator">Evaluator</option>
                              <option value="ic">Interviewer</option> 
                            </select>

                            <input type="submit" class="btn mt-3" name="create" value="submit" id="allSettingButtons">
                          </form>
                      <?php
                        }
                      ?>
                      </div>
                  </div>

                </div>

                <!--Quota Management---------------------------------------------------------->
                <div class="card">
                  <div class="card-header" id="headerfive">
                      <h5 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                              Quota Management
                          </button>
                      </h5>
                  </div>

                  <div class="collapse" id="collapsefive"aria-labelledby="headerfive" data-parent="#accordionexample">
                      <div class="card-body">

                          <label for="itquota">Quota for IT</label>
                          <input type="number" name="itquota" class="form-control">
                          <label for="csquota">Quota for CS</label>
                          <input type="number" name="csquota" class="form-control">

                          <input type="button" class="btn mt-3" name="quotasubmit" value="submit" id="allSettingButtons">
                      </div>
                  </div>
                </div>
                
                <!--SET SCHEDULE-------------------------------------------------------------------------------------------------------->

                <div class="card">
                  <div class="card-header" id="headersix">
                      <h5 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                              Set Schedule/Set Interviewer
                          </button>
                      </h5>
                  </div>

                  <div class="collapse" id="collapsesix"aria-labelledby="headerfive" data-parent="#accordionexample">
                      <div class="card-body">
                          <?php
                            $db = mysqli_connect('localhost','root','','initialsystem');
                            $icname = "";
                              $icdate = "";
                              $ictimefrom = "";
                              $ictimeto = "";
                              $college = "";

                            if (isset($_POST['interviewer'])) {
                              $icname = $_POST['setInterviewer'];
                              $icdate = $_POST['setScheddate'];
                              $ictimefrom = $_POST['setSchedTimeFrom'];
                              $ictimeto = $_POST['setSchedTimeTo'];
                              $college = $_POST['college'];

                              $sql_check = "SELECT * FROM interviewertbl WHERE ic_date = '$icdate' AND ic_name = '$icname'";
                              $sql = mysqli_query($db, $sql_check);
                          
                              if (mysqli_num_rows($sql) > 0) {
                                  $sched_error = "Schedule already existed";
                                  echo "<div class='form'>
                                  <h5>Creation failed, Schedule Already Existed</h5><br/>
                                  <p class='link pb-2'>Click here to <a href='admin.sett.php'>Retry</a></p>
                                  </div>";
                              }else {
                                  $query = "INSERT INTO interviewertbl (ic_name, ic_date, ic_timefrom, ic_timeto, college)
                                  VALUES ('$icname', '$icdate', '$ictimefrom', '$ictimeto', '$college')"; 
                                  
                                  $result = mysqli_query($db,$query);
                                  if ($result) {
                                    echo "<div class='form'>
                                    <h5>Schedule created successfully</h5><br/>
                                    <p class='link pb-2'>Click here to <a href='admin.sett.php'>Retry</a></p>
                                    </div>";
                                  }else{
                                    echo "<div class='form'>
                                    <h5>An error occured. Schedule Creation Failed</h5><br/>
                                    <p class='link pb-2'>Click here to <a href='admin.sett.php'>Retry</a></p>
                                    </div>";
                                  }
                              }
                            }else{
                          ?>
              
                            <form action="admin.sett.php" method="POST" name="interviewSched">
                              <label for="setInterviewer">Set Interviewer Name</label>
                              <input type="text" name="setInterviewer" class="form-control">
                              <label for="setScheddate">Set Interview Date</label>
                              <input type="date" name="setScheddate" class="form-control" required>
                              <label for="setSchedTimeFrom">Set Interview Time From:</label>
                              <input type="time" name="setSchedTimeFrom" class="form-control" required>
                              <label for="setSchedTimeTo">Set Interview Time To:</label>
                              <input type="time" name="setSchedTimeTo" class="form-control" required>
                              <label class="control-label mt-3" for="college">For College Of:</label>
                              <select class="form-control input-sm" name="college" id="college" required>
                                <option value="ics">Institute of Computer Studies</option>
                                <option value="coe">College of Engineering</option> 
                              </select>
                              
                              <input type="submit" class="btn mt-3" name="interviewer" value="submit" id="allSettingButtons">
                              <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#scheduleModal" id="allSettingButtons">View all created schedule here</button>
                          
                            </form>
                          <?php
                            }
                          ?>
                          <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="scheduleModalTitle">Schedules and Interviewer</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                                      <table class="table table-sm table-striped table-bordered table-hover">
                                          <thead class="thead">
                                          <?php $results = mysqli_query($db, "SELECT * FROM interviewertbl"); ?>
                                              <tr>
                                                  <th>Interviewer</th>
                                                  <th>Date</th>
                                                  <th>Time</th>
                                                  <th>Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody class="tbody">
                                            <?php while ($row = mysqli_fetch_array($results)) { ?>
                                              <tr>
                                                <td><?php echo $row['ic_name']; ?></td>
                                                <td><?php echo $row['ic_date']; ?></td>
                                                <td><?php echo $row['ic_timefrom']; ?> -- <?php echo $row['ic_timeto']; ?></td>
                                                <td>
                                                  <a href="admin.sett.php" class="edit_btn" >Edit</a>
                                                  --
                                                  <a class="btnDelete" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                                                </td>
                                              </tr>
                                            <?php } ?>
                                            </tbody>
                                      </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-danger" data-dismiss="modal" id="allSettingButtons">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                      </div>
                  </div>
                </div>

              </div>
          </article>
        </section>
      </section>
</body>
    <script src="../jquery/jquery.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script src="../js/control.js"></script>

    <script>
      $(function(){
        $('#accordionexample .card-header .btn').eq(0).trigger('click');
      });
    </script>

</html>
