<?php 
include('../functions.php');
include('action/assign.php');

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
    <title>Interviewer - ICS</title>
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
                <a href="ics.ic.main.php" class="active">
                  <i class="fa fa-handshake-o" aria-hidden="true"><span>Interviewing</span></i>
                </a>
            </li>
            <li>
              <a href="ics.ic.rej.php">
                <i class="fa fa-thumbs-o-down" aria-hidden="true"><span>Rejected</span></i>
              </a>
            </li>
            <li>
              <a href="ics.ic.cancel.php">
              <i class="fa fa-ban" aria-hidden="true"><span>Cancelled</span></i>
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
          <p class="section-name">Interviewing List</p>
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
                     LEFT JOIN attachment ON selectedcourse.file_id = attachment.id WHERE userStatus='INTERVIEW' AND college_id='1'")?>
                        <tr>
               
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Course</th>
                            <th>Student Type</th>
                            <th>Cet</th>
                            <th>Gpa</th>
                            <th>Set score</th>

                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                            
                            <td style="display:none" ><?php echo $row['user_id']; ?> </td>
                            <td><?php echo $row['fname']; ?> </td>
                            <td><?php echo $row['lname']; ?> </td>
                            <td><?php echo $row['course_name']; ?></td>
                            <td><?php echo $row['studentType']; ?></td>  
                            <td><?php echo $row['cetValue']; ?></td>  
                            <td><?php echo $row['gpaValue']; ?></td>
                            <td style="display:none"><?php echo $row['quota']; ?></td>
                            <td><button class="btn btn-success addbtn">Score</button></td>   
                            <!-- <td><input type="number" name="score" class="form-control scoreInput"></td> -->

                            <td style="display:none"><?php echo $row['cet_path']; ?></td>  
                            <td style="display:none"><?php echo $row['gmoral_path']; ?></td>  
                            <td style="display:none"><?php echo $row['gpa_path']; ?></td>  
                            <td style="display:none"><?php echo $row['cetValue']; ?></td>  
                            <td style="display:none"><?php echo $row['gpaValue']; ?></td>  
                            
                         <!-- data-toggle="modal" data-target="#selectAction" -->
                        </tr>      
                          <?php 
                            }
                         ?>



                    </tbody>
                </table>
              </div>
          </article>
        </section>
      </section>

      <!-- Modal -->
<div class="modal fade" id="addAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set Score</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
            <form action="ics.ic.main.php" method="POST"> 
                <input type="id" name="userid" id="userid" style="display: none;">
                <input type="id" name="cetscore" id="cetscore" style="display: none;">
                <input type="id" name="gpascore" id="gpascore" style="display: none;">
                <input type="id" name="coursequota" id="coursequota" style="display: none;">
                <label for="score">Score</label>
                <input type="number" class="form-control" name="score">
                <button type="submit" class="btn btn-info mt-2" name="icsscoreSave">Save</button>
                <br>
            </form>
        </div>

    </div>
  </div>
</div>

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

    <script>
      function toggle(source){
          checkboxes = document.getElementsByName('selected');
          for (var i=0, n=checkboxes.length; i<n; i++){
              checkboxes[i].checked = source.checked;
          }
      }
    </script>

    <script>
      $(document).ready(function () {
          $('.addbtn').on('click', function () {


            $('#addAction').modal('show');
            $tr = $(this).closest('tr');

                var data =$tr.children("td").map(function(){
                  return $(this).text();
                }).get();
                $('#userid').val(data[0]);
                $('#cetscore').val(data[4]);
                $('#gpascore').val(data[5]);
                $('#coursequota').val(data[6]);
          });
          
      });
    </script>

</html>

  
  
  