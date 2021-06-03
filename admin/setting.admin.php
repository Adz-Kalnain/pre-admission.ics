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
    <link rel="stylesheet" href="../css/setting.style.css">
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
              <h3>APPLICANTS LIST</h3>
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
                <a href="admin.admit.php">
                <i class="fa fa-gavel" aria-hidden="true"><span>Admitted</span></i>
                </a>
            </li>
            <li>
                <a href="admin.wait.php">
                <i class="fa fa-clock-o" aria-hidden="true"><span>Waiting</span></i>
                </a>
            </li>
            <li>
              <a href="admin.rej.php">
                <i class="fa fa-thumbs-o-down" aria-hidden="true"><span>Rejected</span></i>
              </a>
            </li>
            <li>
              <a href="admin.cancel.php">
              <i class="fa fa-ban" aria-hidden="true"><span>Cancelled</span></i>
              </a>
            </li>
            <li class="menu-heading">
              <h3>Settings</h3>
            </li>
            <li>
              <a href="setting.admin.php" class="active">
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
              
              <div class="options">
                <ul class="setting-menu" id="myTab">
                  <div class="list-group list-group-flush" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-requirement-list" data-toggle="list" href="#list-requirement" role="tab" aria-controls="requirement">Requirement Management</a>
                    <a class="list-group-item list-group-item-action" id="list-course-list" data-toggle="list" href="#list-course" role="tab" aria-controls="course">Course Management</a>
                    <a class="list-group-item list-group-item-action" id="list-college-list" data-toggle="list" href="#list-college" role="tab" aria-controls="college">College Management</a>
                    <a class="list-group-item list-group-item-action" id="list-admission-list" data-toggle="list" href="#list-admission" role="tab" aria-controls="admission">Admission</a>
                    <a class="list-group-item list-group-item-action" id="list-quota-list" data-toggle="list" href="#list-quota" role="tab" aria-controls="quota">Quota Management</a>
                    <a class="list-group-item list-group-item-action" id="list-account-list" data-toggle="list" href="#list-account" role="tab" aria-controls="account">Create new account</a>
                  </div>
                </ul>
              </div>
              <div class="options-view">
                <div class="tab-content" id="nav-tabContent">
                  
                  <!--REQUIREMENT-->
                  <div class="tab-pane fade show active" id="list-requirement" role="tabpanel" aria-labelledby="list-requirement-list">
                  
                    <div class="requirement" id="setting-content-container">
                      <h4 class="sett-name mb-5">Requirement
                          <?php if (isset($message1)): ?>
                            <span class="message" id="message"><?php echo $message1; ?></span>
                          <?php endif ?>
                          <?php if (isset($message2)): ?>
                            <span class="message" id="message"><?php echo $message2; ?></span>
                          <?php endif ?>
                      </h4>
                      <form action="setting.admin.php" method="post" class="form">
                        <label for="gpa">GPA (Grade Point Average)</label>
                        <input type="number" name="gpa" class="form-control  mb-3" required>
                        <label for="cet">CET Score (College Entrance Test)</label>
                        <input type="number" name="cet" class="form-control" required>
                        <div class="row">
                          <div class="col-6">

                              <?php  
                                  $query = "SELECT * FROM college";
                                  $result = mysqli_query($db, $query);
                                  $options = "";
                                  while ($row = mysqli_fetch_array($result)){
                                    $options = $options."<option value='$row[0]'>$row[1]</option>";
                                  }
                              ?>

                              <label class="control-label mt-3" for="college">Select College:</label>
                              <select class="form-control input-sm" name="college" id="college_req" required onchange="course_reqChange()" >
                                  <option value="empty"disabled selected>Select a college</option>
                                  <?php echo $options; ?>
                              </select>
                          </div>
                          <div class="col-6">
                              
                              <?php  
                                  $query2 = "SELECT * FROM coursestbl";
                                  $result2 = mysqli_query($db, $query2);
                                  $options2 = "";
                                  while ($row2 = mysqli_fetch_array($result2)){
                                    $options2 = $options2."<option>$row2[1]</option>";
                                  }
                              ?>
                              
                              <label class="control-label mt-3" for="course">Select Course:</label>
                              <select class="form-control input-sm" name="course" id="course_req" required>
                                  <option value=""disbaled selected>Select a course</option>
                                  <?php echo $options2; ?> 
                              </select>
                          </div>
                          <input type="submit" class="btn mt-3 ml-3" name="submit" value="Save" id="allSettingButtons">
                        </div>
                      </form>
                    </div>
                    
                  </div>
                  
                  <!--COURSES-->
                  <div class="tab-pane fade" id="list-course" role="tabpanel" aria-labelledby="list-course-list">
                    
                    <div class="course" id="setting-content-container">
                      <h4 class="sett-name mb-2">Course
                          <?php if (isset($course_message1)): ?>
                            <span class="message" id="message"><?php echo $course_message1; ?></span>
                          <?php endif ?>
                          <?php if (isset($course_message2)): ?>
                            <span class="message" id="message"><?php echo $course_message2; ?></span>
                          <?php endif ?>
                      </h4>
                      <form action="setting.admin.php" method="post" class="form">
                          <label for="courseName">Course Name:</label>
                          <input type="text" name="courseName" class="form-control  mb-3" required>
                          
                          <label for="courseDescription">Course Description</label>
                          <textarea class="form-control" name="courseDescription" id="" cols="20" rows="5" required></textarea>
                          
                          <div class="row">
                            <div class="col-12">

                            <?php  
                                $query = "SELECT * FROM college";
                                $result = mysqli_query($db, $query);
                                $options = "";
                                while ($row = mysqli_fetch_array($result)){
                                  $college_id = 'college_id';
                                  $options = $options."<option value='$row[0]'>$row[1]</option>";
                                }
                            ?>

                            <label class="control-label mt-3" for="college">For College Of:</label>
                            <select class="form-control input-sm" name="college" id="college" required>
                              <option value="empty"disabled selected>Select a college</option>
                              <?php echo $options; ?>
                              <!-- <option value="1">Institute of Computer Studies</option>
                              <option value="2">College of Engineering</option>  -->
                            </select>
                            </div>
                            <!-- <div class="col-6">
                              <label for="courseLogo" class="control-label mt-3">Course Logo:(optional)</label>
                              <input type="file" name="courseLogo" class="form-control mb-3">
                            </div> -->
                          </div>
                          
                          <input type="submit" class="btn mt-3" name="courseSubmit" value="Save" id="allSettingButtons">
                          <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#courseModal" id="allSettingButtons">View all created courses here</button>
                      
                      </form>
                    </div>

                  <!--MODAL COURSES-->
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
                                  <table class="table table-sm table-striped table-bordered table-hover" id="#printable-table">
                                      <thead class="thead">
                                      <?php $course_results = mysqli_query($db, "SELECT * FROM coursestbl"); ?>
                                          <tr class="bg-danger" style="color: white;">
                                              <th>Course Name</th>
                                              <th>Course Description</th>
                                              <th>College Id</th>
                                              <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody class="tbody">
                                        <?php while ($row = mysqli_fetch_array($course_results)) { ?>
                                          <tr>
                                            <td><?php echo $row['course_name']; ?></td>
                                            <td><p><?php echo $row['course_description']; ?></p></td>
                                            <td><?php echo $row['college_id']; ?></td>
                                            <td>
                                              <a class="btnDelete" href="delete.php?course_id=<?php echo $row['course_id']; ?>">Delete</a>
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

                  <!--COLLEGE-->
                  <div class="tab-pane fade" id="list-college" role="tabpanel" aria-labelledby="list-college-list">
                    
                    <div class="college" id="setting-content-container">
                      <h4 class="sett-name mb-2">College
                          <?php if (isset($college_message1)): ?>
                            <span class="message" id="message"><?php echo $course_message1; ?></span>
                          <?php endif ?>
                          <?php if (isset($college_message2)): ?>
                            <span class="message" id="message"><?php echo $course_message2; ?></span>
                          <?php endif ?>
                      </h4>
                      <form action="setting.admin.php" method="post" class="form">
                          <label for="collegeName">College Name:</label>
                          <input type="text" name="collegeName" class="form-control  mb-3" required>
                          
                          <label for="collegeDescription">College Description</label>
                          <textarea class="form-control" name="collegeDescription" id="" cols="20" rows="5" required></textarea>
                          
                          
                          <input type="submit" class="btn mt-3" name="collegeSubmit" value="Save" id="allSettingButtons">
                          <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#collegeModal" id="allSettingButtons">View all created colleges here</button>
                      
                      </form>
                    </div>

                  
                  <!--MODAL COLLEGE-->
                  <div class="modal fade" id="collegeModal" tabindex="-1" role="dialog" aria-labelledby="collegeModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="collegeModalTitle">Colleges and Descriptions</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                                  <table class="table table-sm table-striped table-bordered table-hover" id="#printable-table">
                                      <thead class="thead">
                                      <?php $course_results = mysqli_query($db, "SELECT * FROM college"); ?>
                                          <tr class="bg-danger" style="color: white;">
                                              <th>College Name</th>
                                              <th>College Description</th>
                                              <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody class="tbody">
                                        <?php while ($row = mysqli_fetch_array($course_results)) { ?>
                                          <tr>
                                            <td><?php echo $row['college_name']; ?></td>
                                            <td><?php echo $row['college_description']; ?></td>
                                            <td>
                                              <a class="btnDelete" href="delete.php?college_id=<?php echo $row['college_id']; ?>">Delete</a>
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

                  <!--ADMISSION-->
                  <div class="tab-pane fade" id="list-admission" role="tabpanel" aria-labelledby="list-admission-list">
                    <div class="admission" id="setting-content-container">
                        <h4 class="sett-name mb-5">Admission
                          <?php if (isset($admission_message1)): ?>
                            <span class="message" id="message"><?php echo $admission_message1; ?></span>
                          <?php endif ?>
                        </h4>
                        <form action="setting.admin.php" method="POST" class="form">
                          <label for="startingdate">Start receiving applicant on :</label>
                          <input type="date" name="startingdate" class="form-control mb-3">
                          
                          <label for="endingdate">Stop receiving application on :</label>
                          <input type="date" name="endingdate" class="form-control mb-3">

                          <label for="sy">School year :</label>
                          <input type="text" name="sy" class="form-control mb-3">
                          
                          <input type="submit" class="btn mt-3" name="admissionsubmit" value="Save" id="allSettingButtons">
                      </form>
                    </div>
                  </div>
                  
                  <!--QUOTA-->
                  <div class="tab-pane fade" id="list-quota" role="tabpanel" aria-labelledby="list-quota-list">
                    <div class="quota" id="setting-content-container">
                        
                        <h4 class="sett-name mb-3">Quota
                          <?php if (isset($quota_message)): ?>
                              <span class="message" id="message"><?php echo $quota_message; ?></span>
                          <?php endif ?>
                        </h4>

                        <form action="setting.admin.php" method="POST">
                          
                        <label for="quota">Accepting applicant</label>
                        <input type="number" name="quota" class="form-control  mb-3" required>
                        
                        <label for="waiting">Waiting applicant</label>
                        <input type="number" name="waiting" class="form-control" required>
                        
                            <?php  
                                $query = "SELECT * FROM coursestbl";
                                $result = mysqli_query($db, $query);
                                $options="";
                                while ($row = mysqli_fetch_array($result)){
                                  $options = $options."<option>$row[1]</option>";
                                }
                            ?>
                          
                          <label class="control-label mt-3" for="course">Select Course:</label>
                          <select class="form-control input-sm" name="course" id="course_quota" required>
                              <option value=""disbaled selected>Select a course</option>
                              <?php echo $options; ?> 
                          </select>
 
                          <input type="submit" class="btn mt-3" name="quotaSubmit" value="Save" id="allSettingButtons">
                          
                        </form>
                      </div>
                  </div>
                  
                  <!--CREATE ACCOUNT-->
                  <div class="tab-pane fade" id="list-account" role="tabpanel" aria-labelledby="list-account-list">
                      <div class="schedule" id="setting-content-container">
                        <h4 class="sett-name mb-2 mt-4">Create Account
                          <?php if (isset($account_message1)): ?>
                          <span class="message" id="message"><?php echo $account_message1; ?></span>
                          <?php endif ?>
                          <?php if (isset($account_message2)): ?>
                          <span class="warning" id="warning"><?php echo $account_message2; ?></span>
                          <?php endif ?>
                        </h4>
                          <form action="setting.admin.php" method="POST" name="createAccount">
                            <div class="row">
                              <div class="col-6">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control mb-3" id="fname" name="fname" placeholder="First Name" required>
                              </div>
                              <div class="col-6">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control mb-3" id="lname" name="lname" placeholder="Last Name" required>
                              </div>
                                
                              <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
                                  <input type="email" class="form-control mb-3" id="email" name="email" placeholder="Email Adress" value="<?php echo $email; ?>" required>
                                  <?php if (isset($email_error)): ?>
                                  <span><?php echo $email_error; ?></span>
                                  <?php endif ?>
                                </div>
                              </div>

                              <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                              </div>

                              <div class="col-6">

                              <?php  
                                  $query = "SELECT * FROM college";
                                  $result = mysqli_query($db, $query);
                                  $options = "";
                                  while ($row = mysqli_fetch_array($result)){
                                    $options = $options."<option value='$row[0]'>$row[1]</option>";
                                  }
                              ?>

                                <label class="control-label mt-3" for="college">College:</label>
                                <select class="form-control input-sm mb-3" name="college" id="college" required>
                                  <option value="" disabled selected>Select a college</option>
                                  <?php echo $options ?>
                                  <!-- <option value="ics">Institute of Computer Studies</option>
                                  <option value="coe">College of Engineering</option>  -->
                                </select>
                              </div>

                              <div class="col-6">
                                <label class="control-label mt-3" for="role">Role:</label>
                                <select class="form-control input-sm" name="role" id="role">
                                  <option value="ao">Admission Officer</option>
                                  <option value="evaluator">Evaluator</option>
                                  <option value="ic">Interviewer</option> 
                                </select>
                              </div>
                              
                              <div class="col-12">
                                <input type="submit" class="btn mt-3" name="accountSubmit" value="Save" id="allSettingButtons">
                              </div>
                              
                            </div>
                        </form>
                        
                            
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
    <script src="../bootstrap4/js/bootstrap.js"></script>
    <script type="text/javascript" charset="utf8" src="../DataTables/datatables.js"></script>

    <!--Script that prevent opening the default tab after refresh-->
    <script>
      $(document).ready(function(){
          $('a[data-toggle="list"]').on('show.bs.tab', function(e) {
              localStorage.setItem('activeTab', $(e.target).attr('href'));
          });
          var activeTab = localStorage.getItem('activeTab');
          if(activeTab){
              $('#myTab a[href="' + activeTab + '"]').tab('show');
          }
      });
    </script>

    <!--This javascript prevent the resubmission of form when refresh button(f5) is click-->
    <script>
        if (window.history.replaceState) {
          window.history.replaceState (null, null, window.location.href);
        }
    </script>

    <!--DATATABLE-->
    <script>
        $(document).ready( function () {
        $('#printable-table').DataTable();
        } );
    </script>

    <script>
        $('#printable-table').DataTable( {
            select: true
        } );
    </script>


</html>
