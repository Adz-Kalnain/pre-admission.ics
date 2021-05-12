
<?php
 include('../session.php');
 include('../db.php');

 


if (isset($_POST['approve']))
{
 $id=$_POST['id'];
 $status=$_POST['status'];

 
$query="UPDATE applicants SET status='approve' WHERE id='$id'";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluator</title>
    <link rel="icon" href="../svgs/logo.png" sizes="32x32" type="image/png">

    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">          
    <link rel="stylesheet" href="../css/admin.style.css">
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.css">

</head>
<body>
        <header class="page-header">
        <nav>
          <button class="toggle-mob-menu" aria-expanded="false" aria-label="open menu">
            <i class="fa fa-bars"></i>
          </button>
          <a href="../index.html">
            <img class="logo mx-auto" src="../svgs/logo.png" alt="ics logo">
          </a>
          <ul class="admin-menu">
            <li class="menu-heading">
              <h3>Dashboard</h3>
            </li>
            <li>
              <a href="evaluator.main.php" class="active">
                <i class="fa fa-list" aria-hidden="true"><span>Applicants</span></i>
              </a>
            </li>
            <li>
              <a href="evaluator.pre.php">
                <i class="fa fa-check" aria-hidden="true"><span>Prequalified</span></i>
              </a>
            </li>
            <li>
              <a href="evaluator.rej.php">
                <i class="fa fa-thumbs-o-down" aria-hidden="true"><span>Rejected</span></i>
              </a>
            </li>
            <!--<li class="menu-heading">
              <h3>Settings</h3>
            </li>
            <li>
              <a href="#0">
                <i class="fa fa-cog" aria-hidden="true"><span>Settings</span></i>
              </a>
            </li>-->
            <!--<li>
              <a href="#0">
                <i class="fa fa-list-alt" aria-hidden="true"><span>Requirement</span></i>
              </a>
            </li>-->
            <li>
              <a href="../login-page.php?logout='1'">
                <i class="fa fa-sign-out"><span>Logout</span></i>
                
              </a>
            </li>
          </ul>
        </nav>
      </header>
            <section class="page-content">
        <section class="search-and-user">
          <div class="admin-profile">
            <div class="notifications">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <button class="userprofile" id="dropdown-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-profile">
                    <p class="mb-0 mt-4">Mr.Evaluator Sir</p>
                    <div class="dropdown-divider"></div>
                    <p class="mt-0 mb-5">Evaluator</p>
                    <button type="button" class="btn-danger">Logout</button>
                </div>
                <span class="badge">11</span>
              </div>
          </div>
        </section>
        <section class="btn-group">
          <p class="section-name">Applicant's List</p>
          <div class="buttons">
            <button class="btn-success"><span class="label">Verified</span></button>
            <button class="btn-danger"><span class="label">Reject</span></button>
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

                    <?php $results = mysqli_query($db, "SELECT * FROM applicants WHERE status='pending'"); ?>

                        <tr>
                            <th>FirstName</th>
                            <th>BirthDate</th>
                            <th>Address</th>
                            <th>ContactNo</th>
                            <th>Email</th>
                            <th>Cet</th>
                            <th>Status</th>
 
                        </tr>
                    </thead>
                    <tbody class="tbody">
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['birthdate']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['contact']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['cet_name']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                   <a href="evaluator.pre.php?approve=<?php echo $row['id']; ?>" class="edit_btn" >Approve</a>
                                  </td>
                                  <td>
                                    <a href="evaluator.rej.php?reject=<?php echo $row['id']; ?>" class="del_btn">Reject</a>
                                  </td>
                         
                        </tr>
                                          
                        <?php } ?>



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

    <script>
      function toggle(source){
          checkboxes = document.getElementsByName('selected');
          for (var i=0, n=checkboxes.length; i<n; i++){
              checkboxes[i].checked = source.checked;
          }
      }
    </script>

</html>

  
  
  