
<?php
 include('../session.php');
 include('../db.php');



 $query= mysqli_query($db,"SELECT * FROM users WHERE `username` = '".$_SESSION['login_user']."' ")or die(mysql_error());
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php 
                            echo $_SESSION['message']; 
                            unset($_SESSION['message']);
                          
                            
                        ?>
    </div>
    <?php endif ?>




</head>

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
                <img src="../seal/wmsu-logo.png" alt="">WMSU Online Pre-Admission
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">

                    <?php  if (isset($_SESSION['login_user'])) : ?>
                    <p>
                        Welcome
                        <strong>
                            <?php echo $_SESSION['login_user']; ?>
                        </strong>
                    </p>

                    <?php endif ?>
                    </p>
                    <li class="nav-item">
                        <a class="nav-link active" href="../student/UserApplication.php">Home</a>
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
    <h6 class="m-0 font-weight-bold text-danger">List of Colleges</h6>
  </div>
  <div class="card-body">
  <div class="row">


  <div class="col-lg-12">


<table class='selected-col-2'>
<tbody>
<?php
$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$results = mysqli_query($db, "SELECT * from college LIMIT $start,$limit");
$results1 = mysqli_query($db, "SELECT COUNT(college_id) AS id from college");
$collegeCount = mysqli_fetch_array($results1);
	$total = $collegeCount['id'];
	$pages = ceil( $total / $limit );

	$Previous = $page - 1;
	$Next = $page + 1;
?>
    
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
    <td><img class="rounded-circle" src="../collegeimg/<?php echo $row['college_img']; ?>" alt=""  width="100px" height="100px"></td>
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
				    <?php for($i = 1; $i<= $pages; $i++) : ?>
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
        <script type="text/javascript">
	$(document).ready(function(){
		$("#limit-records").change(function(){
			$('form').submit();
		})
	})
</script>
</body>

</html>