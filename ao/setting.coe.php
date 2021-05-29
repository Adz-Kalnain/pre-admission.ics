<?php 
include('../functions.php');
include('coe.function.php');

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
    <title>Admission Officer - COE</title>
    <link rel="icon" href="../seal/coe-logo.png" sizes="32x32" type="image/png">

    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">          
    <link rel="stylesheet" href="../css/setting.coe.css">
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
            <img class="logo mx-auto" src="../seal/coe-logo.png" alt="ics logo">
          </a>
          <ul class="admin-menu">
            <li class="menu-heading">
              <h3>APPLICANTS LIST</h3>
            </li>
            <!-- <li>
              <a href="coe.ao.main.php">
                <i class="fa fa-list" aria-hidden="true"><span>Prequalified</span></i>
              </a>
            </li> -->
            <li>
            <a href="coe.ao.qual.php">
                <i class="fa fa-thumbs-o-up" aria-hidden="true"><span>Qualified</span></i>
              </a>
            </li>
            <li>
                <a href="coe.admit.php">
                <i class="fa fa-gavel" aria-hidden="true"><span>Admitted</span></i>
                </a>
            </li>
            <li>
                <a href="coe.wait.php">
                <i class="fa fa-clock-o" aria-hidden="true"><span>Waiting</span></i>
                </a>
            </li>
            <li>
              <a href="coe.rej.php">
                <i class="fa fa-thumbs-o-down" aria-hidden="true"><span>Rejected</span></i>
              </a>
            </li>
            <li>
              <a href="coe.cancel.php">
              <i class="fa fa-ban" aria-hidden="true"><span>Cancelled</span></i>
              </a>
            </li>
            <li class="menu-heading">
              <h3>Settings</h3>
            </li>
            <li>
              <a href="setting.coe.php" class="active">
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
                      <form action="setting.coe.php" method="post" class="form">
                        
                        <label for="gpa">GPA (Grade Point Average)</label>
                        <input type="number" name="gpa" class="form-control  mb-3" required>
                        
                        <label for="cet">CET Score (College Entrance Test)</label>
                        <input type="number" name="cet" class="form-control" required>
                        
                            <?php  
                                $query2 = "SELECT * FROM coursestbl WHERE college_id = '2'";
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
                            <input type="submit" class="btn mt-3" name="submit" value="Save" id="allSettingButtons">
                      </form>
                    </div>
                  
                  </div>
                    
                  <!--QUOTA-->
                  <div class="tab-pane fade" id="list-quota" role="tabpanel" aria-labelledby="list-quota-list">
                    
                  <div class="quota" id="setting-content-container">
                      <h4 class="sett-name mb-4">Quota
                          <?php if (isset($quota_message)): ?>
                            <span class="message" id="message"><?php echo $quota_message; ?></span>
                          <?php endif ?>
                      </h4>
                      <form action="setting.coe.php" method="post" class="form">
                        
                        <label for="quota">Accepting applicant</label>
                        <input type="number" name="quota" class="form-control  mb-3" required>
                        
                        <label for="waiting">Waiting applicant</label>
                        <input type="number" name="waiting" class="form-control" required>
                        
                            <?php  
                                $query = "SELECT * FROM coursestbl WHERE college_id = '2'";
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
                          
                          <input type="submit" class="btn mt-3" name="quotasubmit" value="Save" id="allSettingButtons">
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
                          <form action="setting.coe.php" method="POST" name="createAccount">
                            <div class="row">
                              <div class="col-6">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control mb-3" id="fname" name="fname" placeholder="First Name" required>
                              </div>
                              <div class="col-6">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control mb-3" id="lname" name="lname" placeholder="Last Name" required>
                              </div>

                              <div class="col-6">
                                <label for="username" class="form-label">Username</label>
                                <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
                                  <input type="text" class="form-control mb-3" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                                  <?php if (isset($name_error)): ?>
                                  <span><?php echo $name_error; ?></span>
                                  <?php endif ?>
                                </div>
                              </div>
                                
                              <div class="col-6">
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

                              <div class="col-12">
                                <label class="control-label mt-3" for="role">Role:</label>
                                <select class="form-control input-sm" name="role" id="role">
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
