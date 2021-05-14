<?php 
include('../functions.php');
include('admin.function.php');
//include('sample.php');

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
    <link rel="stylesheet" href="../css/admin.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">          
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.css">

</head>
<body>
  <?php  if (isset($_SESSION['user'])) : ?>
    <header class="page-header">
      <nav>

        <button class="toggle-mob-menu" aria-expanded="false" aria-label="open menu">
          <i class="fa fa-bars"></i>
        </button>
        <a href="../index.html">
          <img class="logo mx-auto" src="../seal/wmsu-logo.png" alt="wmsu logo">
        </a>

        <div class="options">
          <ul class="admin-menu" id="myTab">
            <div class="list-group list-group-flush" id="list-tab" role="tablist">
              <li class="menu-heading">
                <h3>Dashboard</h3>
              </li>
              <a class="list-group-item list-group-item-action active" id="list-applicant-list" data-toggle="list" href="#list-applicant" role="tab" aria-controls="applicant">
                <i class="fa fa-list" aria-hidden="true">
                  <span>Applicants</span>
                </i>
              </a>
              <a class="list-group-item list-group-item-action" id="list-prequalified-list" data-toggle="list" href="#list-prequalified" role="tab" aria-controls="prequalified">
                <i class="fa fa-check" aria-hidden="true">
                  <span>Prequalified</span>
                </i>
              </a>
              <a class="list-group-item list-group-item-action" id="list-qualified-list" data-toggle="list" href="#list-qualified" role="tab" aria-controls="qualified">
                <i class="fa fa-thumbs-o-up" aria-hidden="true">
                  <span>Qualified</span>
                </i>
              </a>
              <a class="list-group-item list-group-item-action" id="list-rejected-list" data-toggle="list" href="#list-rejected" role="tab" aria-controls="rejected">
                <i class="fa fa-thumbs-o-down" aria-hidden="true">
                  <span>Rejected</span>
                </i>
              </a>
              <li class="menu-heading">
                <h3>Settings</h3>
              </li>
              <a class="list-group-item list-group-item-action" id="list-setting-list" data-toggle="list" href="#list-setting" role="tab" aria-controls="setting">
                <i class="fa fa-cog" aria-hidden="true">
                  <span>Settings</span>
                </i>
              </a>
              <a class="list-group-item list-group-item-action" id="list-chart-list" data-toggle="list" href="#list-chart" role="tab" aria-controls="chart">
                <i class="fa fa-bar-chart" aria-hidden="true">
                  <span>Chart</span>
                </i>
              </a>
              <a href="../index.php?logout='1'" class="list-group-item">
                <i class="fa fa-sign-out">
                  <span>Logout</span>
                </i>
              </a>
            </div>
          </ul>
        </div>

      </nav>
    </header>
  <?php endif ?>


<section class="page-content">
<!--  <section class="btn-group">
        <div class="buttons">
          <button class="btn btn-primary mr-2 pl-3 pr-3"><span class="label">Verify</span></button>
          <button class="btn btn-danger pl-3 pr-3"><span class="label">Reject</span></button>
          <button class="toggle-more-menu" id="dropdown-more-buttons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bars"></i>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdown-more-buttons">
            <button class="dropdown-item" type="button">Print</button>
          </div>
        </div>
  </section>
  -->
  <section class="grid">
    
    <div class="row" id="stat" style="font: 16px Lato;">
      
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h6>Application's Total #:</h6>
          </div>
        </div>
      </div>

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h6>Rejected Application's Total #:</h6>
          </div>
        </div>
      </div>

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h6>Qualified Application's Total #:</h6>
          </div>
        </div>
      </div>

    </div>
  
    <hr>
    
    <article>

      <div class="tab-content" id="nav-tabContent">
        
        <div class="tab-pane fade show active" id="list-applicant" role="tabpanel" aria-labelledby="list-applicant-list">
          <div class="btn-group">
            <p class="section-name">Applicant's List</p>
            <div class="buttons">
                <button type="button" class="btn btn-primary mr-2 pl-3 pr-3" data-toggle="modal" data-target="#insertModal">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
                <button class="btn btn-primary mr-2 pl-3 pr-3" onclick="myTable1.printApplicantTable()">
                  <i class="fa fa-print" aria-hidden="true"></i>
                </button>
                <button class="btn btn-primary mr-2 pl-3 pr-3"><span class="label">Verify</span></button>
                <button class="btn btn-danger mr-3 pl-3 pr-3"><span class="label">Reject</span></button>

                <!-- Insert Modal -->
                <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticModalLabel">Insert new applicant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?php require_once 'insert.php'; ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
          </div>
          <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl px-3 my-3">
            <table class="table table-sm table-striped table-bordered table-hover" id="printable-table">
              <thead class="thead">
                <tr>
                  <th><input type="checkbox" onclick="toggle(this)"></th>
                  <th>FirstName</th>
                  <th>LastName</th>
                  <th>BirthDate</th>
                  <th>Address</th>
                  <th>ContactNo</th>
                  <th>Email</th>
                  <th>Course</th>
                  <th>Cet</th>
                  <th>Gpa</th>
                </tr>
              </thead>
              <tbody class="tbody">
                <tr>
                  <td><input type="checkbox" name="selected"></td>
                  <td>Adz</td>
                  <td>Kalnain</td>
                  <td>December 16,1998</td>
                  <td>Mampang Z.C.</td>
                  <td>09666319676</td>
                  <td>adzgreen2017@gmail.com</td>
                  <td>CS</td>
                  <td>92%</td>
                  <td>92%</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="selected"></td>
                  <td>Adz</td>
                  <td>Kalnain</td>
                  <td>December 16,1998</td>
                  <td>Mampang Z.C.</td>
                  <td>09666319676</td>
                  <td>adzgreen2017@gmail.com</td>
                  <td>IT</td>
                  <td>92%</td>
                  <td>92%</td>
                </tr>
              </tbody>
            </table>
          </div>         
        </div>
        
        <div class="tab-pane fade" id="list-prequalified" role="tabpanel" aria-labelledby="list-prequalified-list">
          <div class="btn-group">
              <p class="section-name">Pre-qualified List</p>
              <div class="buttons">
                  <button class="btn btn-primary mr-2 pl-3 pr-3"><i class="fa fa-plus" aria-hidden="true"></i></button>
                  <button class="btn btn-primary mr-2 pl-3 pr-3" onclick="myTable2.printPreQualifiedTable()">
                    <i class="fa fa-print" aria-hidden="true"></i>
                  </button>
                  <button class="btn btn-primary mr-2 pl-3 pr-3"><span class="label">Place Schedule</span></button>
              </div>
          </div>
          <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl px-3 my-3">
            <table class="table table-sm table-striped table-bordered table-hover" id="printable-table-pre">
              <thead class="thead">
                <tr>
                  <th><input type="checkbox" onclick="toggle(this)"></th>
                  <th>FirstName</th>
                  <th>LastName</th>
                  <th>BirthDate</th>
                  <th>Address</th>
                  <th>ContactNo</th>
                  <th>Email</th>
                  <th>Course</th>
                  <th>Cet</th>
                  <th>Gpa</th>
                </tr>
              </thead>
              <tbody class="tbody">
                <tr>
                  <td><input type="checkbox" name="selected"></td>
                  <td>Adz</td>
                  <td>Kalnain</td>
                  <td>December 16,1998</td>
                  <td>Mampang Z.C.</td>
                  <td>09666319676</td>
                  <td>adzgreen2017@gmail.com</td>
                  <td>CS</td>
                  <td>92%</td>
                  <td>92%</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="selected"></td>
                  <td>Adz</td>
                  <td>Kalnain</td>
                  <td>December 16,1998</td>
                  <td>Mampang Z.C.</td>
                  <td>09666319676</td>
                  <td>adzgreen2017@gmail.com</td>
                  <td>IT</td>
                  <td>92%</td>
                  <td>92%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane fade" id="list-qualified" role="tabpanel" aria-labelledby="list-qualified-list">
          <div class="btn-group">
              <p class="section-name">Qualified List</p>
              <div class="buttons">
                  <button class="btn btn-primary mr-2 pl-3 pr-3"><i class="fa fa-plus" aria-hidden="true"></i></button>
                  <button class="btn btn-primary mr-2 pl-3 pr-3" onclick="myTable3.printQualifiedTable()"><i class="fa fa-print" aria-hidden="true"></i></button>
                  <button class="btn btn-primary mr-2 pl-3 pr-3"><span class="label">Notify</span></button>
              </div>
          </div>
          <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl px-3 my-3">
            <table class="table table-sm table-striped table-bordered table-hover" id="printable-table-qual">
              <thead class="thead">
                <tr>
                  <th><input type="checkbox" onclick="toggle(this)"></th>
                  <th>FirstName</th>
                  <th>LastName</th>
                  <th>BirthDate</th>
                  <th>Address</th>
                  <th>ContactNo</th>
                  <th>Email</th>
                  <th>Course</th>
                  <th>Cet</th>
                  <th>Gpa</th>
                </tr>
              </thead>
              <tbody class="tbody">
                <tr>
                  <td><input type="checkbox" name="selected"></td>
                  <td>Adz</td>
                  <td>Kalnain</td>
                  <td>December 16,1998</td>
                  <td>Mampang Z.C.</td>
                  <td>09666319676</td>
                  <td>adzgreen2017@gmail.com</td>
                  <td>CS</td>
                  <td>92%</td>
                  <td>92%</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="selected"></td>
                  <td>Adz</td>
                  <td>Kalnain</td>
                  <td>December 16,1998</td>
                  <td>Mampang Z.C.</td>
                  <td>09666319676</td>
                  <td>adzgreen2017@gmail.com</td>
                  <td>IT</td>
                  <td>92%</td>
                  <td>92%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane fade" id="list-rejected" role="tabpanel" aria-labelledby="list-rejected-list">
          <div class="btn-group">
              <p class="section-name">Rejected List</p>
              <div class="buttons">
                  <button class="btn btn-primary mr-2 pl-3 pr-3" onclick="myTable4.printRejectedTable()"><i class="fa fa-print" aria-hidden="true"></i></button>
                  <button class="btn btn-primary mr-2 pl-3 pr-3"><span class="label">Notify</span></button>
              </div>
          </div>
          <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl px-3 my-3">
            <table class="table table-sm table-striped table-bordered table-hover" id="printable-table-rej">
              <thead class="thead">
                <tr>
                  <th><input type="checkbox" onclick="toggle(this)"></th>
                  <th>FirstName</th>
                  <th>LastName</th>
                  <th>BirthDate</th>
                  <th>Address</th>
                  <th>ContactNo</th>
                  <th>Email</th>
                  <th>Course</th>
                  <th>Cet</th>
                  <th>Gpa</th>
                </tr>
              </thead>
              <tbody class="tbody">
                <tr>
                  <td><input type="checkbox" name="selected"></td>
                  <td>Adz</td>
                  <td>Kalnain</td>
                  <td>December 16,1998</td>
                  <td>Mampang Z.C.</td>
                  <td>09666319676</td>
                  <td>adzgreen2017@gmail.com</td>
                  <td>CS</td>
                  <td>92%</td>
                  <td>92%</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="selected"></td>
                  <td>Adz</td>
                  <td>Kalnain</td>
                  <td>December 16,1998</td>
                  <td>Mampang Z.C.</td>
                  <td>09666319676</td>
                  <td>adzgreen2017@gmail.com</td>
                  <td>IT</td>
                  <td>92%</td>
                  <td>92%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane fade" id="list-setting" role="tabpanel" aria-labelledby="list-setting-list">
        <article class="setting">
              
              <!--Setting Options-->
              <div class="options">
                <ul class="setting-menu" id="myTab">
                  <div class="list-group list-group-flush" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-requirement-list" data-toggle="list" href="#list-requirement" role="tab" aria-controls="home">Requirement Management</a>
                    <a class="list-group-item list-group-item-action" id="list-course-list" data-toggle="list" href="#list-course" role="tab" aria-controls="profile">Course Management</a>
                    <a class="list-group-item list-group-item-action" id="list-admission-list" data-toggle="list" href="#list-admission" role="tab" aria-controls="messages">Admission</a>
                    <a class="list-group-item list-group-item-action" id="list-quota-list" data-toggle="list" href="#list-quota" role="tab" aria-controls="settings">Quota Management</a>
                    <a class="list-group-item list-group-item-action" id="list-schedule-list" data-toggle="list" href="#list-schedule" role="tab" aria-controls="settings">Schedule</a>
                    <a class="list-group-item list-group-item-action" id="list-account-list" data-toggle="list" href="#list-account" role="tab" aria-controls="settings">Create new account</a>
                  </div>
                </ul>
              </div>
              
              <!--Option View-->
              <div class="options-view">
                <div class="tab-content" id="nav-tabContent">
                  
                  <?php include_once 'optionview.php'; ?>
                
                </div>
              </div>
          </article>          
        </div>

        <div class="tab-pane fade" id="list-chart" role="tabpanel" aria-labelledby="list-chartr-list">
          <div  class="chart mx-4 my-4" id="barchart_material" style="width: 900px; height: 500px;"></div>
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
    <script src="print.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['School year', 'Applicant', 'Accepted', 'Rejected'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'WMSU Pre-Admission',
            subtitle: 'Applicants, Accepted, and Rejected',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


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
  
    <!-- Checkboxes -->
    <script>
      function toggle(source){
          checkboxes = document.getElementsByName('selected');
          for (var i=0, n=checkboxes.length; i<n; i++){
              checkboxes[i].checked = source.checked;
          }
      }
    </script>

    <!--This javascript prevent the resubmission of form when refresh button(f5) is click-->
    <script>
        if (window.history.replaceState) {
          window.history.replaceState (null, null, window.location.href);
        }
    </script>

    <!--SCRIPT for quota options-->
    <script>
        $(document).ready(function() {
            $("#college_dept").change(function(){ 
                var val = $(this).val();
                <?php  
                    $query1 = "SELECT * FROM coursestbl WHERE college = 'ics'";
                    $result1 = mysqli_query($db, $query1);
                    $options = "";
                    while ($row1 = mysqli_fetch_array($result1)){
                      $options = $options."<option>$row1[1]</option>";
                    }
                ?>
                <?php  
                    $query2 = "SELECT * FROM coursestbl WHERE college = 'coe'";
                    $result2 = mysqli_query($db, $query2);
                    $options2 = "";
                    while ($row1 = mysqli_fetch_array($result2)){
                      $options2 = $options2."<option>$row1[1]</option>";
                    }
                ?>
                    if (val == "ics") {
                      $("#course_sel").html("<?php echo $options; ?>");
                    } else if(val == "coe") {
                      $("#course_sel").html("<?php echo $options2; ?>");
                    }
                
            });
        });     
    </script> 

      <!---Requirement Script-->
    <script>
        $(document).ready(function() {
            $("#college_req").change(function(){ 
                var val = $(this).val();
                <?php  
                    $query1 = "SELECT * FROM coursestbl WHERE college = 'ics'";
                    $result1 = mysqli_query($db, $query1);
                    $options = "";
                    while ($row1 = mysqli_fetch_array($result1)){
                      $options = $options."<option>$row1[1]</option>";
                    }
                ?>
                <?php  
                    $query2 = "SELECT * FROM coursestbl WHERE college = 'coe'";
                    $result2 = mysqli_query($db, $query2);
                    $options2 = "";
                    while ($row1 = mysqli_fetch_array($result2)){
                      $options2 = $options2."<option>$row1[1]</option>";
                    }
                ?>
                    if (val == "ics") {
                      $("#course_req").html("<?php echo $options; ?>");
                    } else if(val == "coe") {
                      $("#course_req").html("<?php echo $options2; ?>");
                    }
                
            });
        });     
    </script>

</html>

  
  
  