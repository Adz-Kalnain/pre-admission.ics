<?php 
include('../functions.php');

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
    <title>Evaluator - ICS</title>
    <link rel="icon" href="../seal/logo.png" sizes="32x32" type="image/png">

    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">          
    <link rel="stylesheet" href="../css/ics.style.css">
    <link rel="stylesheet" href="../css/btn.admin.css">
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
            <img class="logo mx-auto" src="../seal/logo.png" alt="ics logo">
          </a>
          <ul class="admin-menu">
            <li class="menu-heading">
              <h3>APPLICANTS LIST</h3>
            </li>
            <li>
                <a href="ics.evaluator.main.php" class="active">
                    <i class="fa fa-list" aria-hidden="true"><span>Applications</span></i>
                </a>
            </li>
            <li>
              <a href="ics.evaluator.pre.php">
                <i class="fa fa-list" aria-hidden="true"><span>Prequalified</span></i>
              </a>
            </li>
            <li>
              <a href="ics.evaluator.rej.php">
                <i class="fa fa-thumbs-o-down" aria-hidden="true"><span>Rejected</span></i>
              </a>
            </li>
            <li>
              <a href="ics.evaluator.cancel.php">
              <i class="fa fa-ban" aria-hidden="true"><span>Cancelled</span></i>
              </a>
            </li>
            <li>
              <a href="../index.php?logout='1'">
                <i class="fa fa-sign-out"><span>logout</span></i>
              </a>
            </li>
          </ul>
        </nav>
      </header>
      <?php endif ?>
      <section class="page-content">
        <section class="btn-group">
          <p class="section-name">Applications List</p>
          <div class="buttons">
          </div>
        </section>
        <section class="grid">
          <article>
          <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl mx-3 my-3">
          <table class="table table-sm table-striped table-bordered table-hover" id="printable-table">
                    <thead class="thead">
                    <?php $results = mysqli_query($db, "SELECT * from selectedcourse LEFT JOIN users ON selectedcourse.user_id = users.id
                     LEFT JOIN coursestbl ON selectedcourse.course_id = coursestbl.course_id
                     LEFT JOIN attachment ON selectedcourse.file_id = attachment.id WHERE userStatus='PENDING' AND college_id='1'")?>
                        <tr>
               
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Course</th>
                            <th>Student Type</th>
                            <th>Cet</th>
                            <th>Gpa</th>
                            <th>action</th>

                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <?php   while ($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                            
                            <td style="display:none" ><?php echo $row['user_id']; ?> </td>
                            <td><?php echo $row['fname']; ?> </td>
                            <td><?php echo $row['lname']; ?> </td>
                            <td><?php echo $row['course_name']; ?></td>
                            <td><?php echo $row['studentType']; ?></td>  
                            <td><?php echo $row['cetValue']; ?></td>  
                            <td><?php echo $row['gpaValue']; ?></td>
                            <td>
                            <a class="btnaction" href="action/accept.php?icsuser_id=<?php echo $row['user_id']; ?>">
                              <button class="btn btn-success">Verify</button>
                            </a>
                            <a class="btnaction" href="action/reject.php?icsuser_id=<?php echo $row['user_id']; ?>">
                              <button class="btn btn-danger">Disqualify</button>
                            </a>
                          </td> 
                            <!-- <td><input type="number" name="score" class="form-control scoreInput"></td> -->
                            
                         <!-- data-toggle="modal" data-target="#selectAction" -->
                        </tr>      
                          <?php 
                            }
                         ?>



                    </tbody>
                </table>
          </article>
        </section>
      </section>
</body>
<script src="../jquery/jquery.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../DataTables/datatables.js"></script>
    <script src="../js/control.js"></script>
    <script src="print.js"></script>
    
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

    <script>
      function toggle(source){
          checkboxes = document.getElementsByName('selected');
          for (var i=0, n=checkboxes.length; i<n; i++){
              checkboxes[i].checked = source.checked;
          }
      }
    </script>

</html>

  
  
  