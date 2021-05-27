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
    <title>Administrator</title>
    <link rel="icon" href="../seal/wmsu-logo.png" sizes="32x32" type="image/png">

    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">          
    <link rel="stylesheet" href="../css/admin.style.css">
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
          <ul class="admin-menu">
            <li class="menu-heading">
              <h3>Dashboard</h3>
            </li>
            <li>
                <!--<a href="#applicantSubmenu" class="active" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">-->
                <a href="#admin.main.php" class="active">
                  <i class="fa fa-list" aria-hidden="true"><span>Applicants</span></i>
                </a>
                <!--<ul class="collapse list-unstyled" id="applicantSubmenu">
                  <li>
                    <a href="#">ICS</a>
                  </li>
                  <li>
                    <a href="#">COE</a>
                  </li>
                </ul>-->
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
              <a href="setting.admin.php">
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
          <p class="section-name">Applicant's List</p>
          <div class="buttons">
            <button class="toggle-more-menu" id="dropdown-more-buttons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-bars"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdown-more-buttons">
              <button class="dropdown-item" type="button">Print</button>
            </div>
          </div>
        </section>
        <section class="grid">
          <article>
              <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl mx-3 my-3">
                <table class="table table-sm table-striped table-bordered table-hover" id="printable-table">
                    <thead class="thead">
                    <?php $results = mysqli_query($db, "SELECT * from selectedcourse LEFT JOIN users ON selectedcourse.user_id = users.id
                     LEFT JOIN coursestbl ON selectedcourse.course_id = coursestbl.course_id
                     LEFT JOIN attachment ON selectedcourse.file_id = attachment.id WHERE userStatus='PENDING'")?>
                        <tr>
               
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Course</th>
                            <th>Action </th>

                        </tr>
                    </thead>
                    <tbody class="tbody">
                 <?php   while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                   
                          <td><?php echo $row['fname']; ?> </td>
                          <td><?php echo $row['lname']; ?> </td>
                          <td><?php echo $row['course_name']; ?></td>   
                           
                          <td style="display:none" ><?php echo $row['cet_path']; ?></td>  
                          <td style="display:none"><?php echo $row['gmoral_path']; ?></td>  
                          <td style="display:none"><?php echo $row['gpa_path']; ?></td>  
                          <td style="display:none"><?php echo $row['cetValue']; ?></td>  
                          <td style="display:none"><?php echo $row['gpaValue']; ?></td>  
                          <td style="display:none" ><?php echo $row['user_id']; ?> </td>
                          <td>
                          <button type="button" class ="btn btn-info actionbtn"> ACTION </button>
                         </td>       
                          <?php 
                        }
                         ?>



                    </tbody>
                </table>
              </div>
          </article>
        </section>
      </section>
</body>
    <script src="../jquery/jquery.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../DataTables/datatables.js"></script>
    <script src="../js/control.js"></script>
    
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




<!-- DONE ACTION -->
<div class="modal fade" id="adminAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="adminFunction.php" method="POST">

        <div class="modal-body">


        <input style="display: none;" type="id"   name="userID" id="userID"  class="form-control" >

        <div class="form-group">
                <label>First Name :</label>
                <input type="id"   disabled="disabled"   name="firstname" id="firstname"  class="form-control" >
            </div>
        <div class="form-group">
                <label>Last name :</label>
                <input type="name" name="sender" disabled="disabled"  id="lastname" class="form-control" >
            </div>
            
            <div class="form-group">
                <label> Course Selected </label>
                <input type="text" name="username" disabled="disabled" class="form-control" id="coursename" >
            </div>
            <div class="form-group">
                <label>CET  :</label>
                <input type="name" name="sender" disabled="disabled"  id="cetValue" class="form-control" >
            </div>
            
            <div class="form-group">
                <label> GPA </label>
                <input type="text" name="username" disabled="disabled" class="form-control" id="gpaValue" >
            </div>
            <div class="form-group">
                <label> GPA </label>
                <input type="text" name="username" disabled="disabled" class="form-control" id="cet_path" >
            </div>


       
        </div>
        <div class="modal-footer">    
        <button type="accept" name="accept" id="accept" class="btn btn-success">VERIFY</button>
        <button type="accept" name="reject" id="reject" class="btn btn-success">REJECT</button>

        </div>
      </form>
  
    </div>
  </div>
</div>


<script>
        $(document).ready(function () {
            $('.actionbtn').on('click', function () {


              $('#adminAction').modal('show');
              $tr = $(this).closest('tr');

                  var data =$tr.children("td").map(function(){
                    return $(this).text();
                  }).get();
                  $('#firstname').val(data[0]);
                  $('#lastname').val(data[1]);
                  $('#coursename').val(data[2]);
                  $('#cet_path').val(data[3]);
                  $('#gmoral_path').val(data[4]);
                  $('#cpa_path').val(data[5]);
                  $('#cetValue').val(data[6]);
                  $('#gpaValue').val(data[7]);
                  $('#userID').val(data[8]);
                    
        
             

            });
           
        });
    </script>

