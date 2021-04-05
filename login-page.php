
<?php
   session_start();
   include("db.php");
   $error=''; // Variable To Store Error Message
   $active = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $sql = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'";
      //$sql = "SELECT user_id,active FROM admin_tbl WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql) or die("Error: ".mysqli_error($db));

      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $userid=$row['id'];
      $active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         // Register $myusername, $mypassword and redirect to file "index.php"
         //session_register("username");
         //session_register("password");
         $_SESSION['login_user'] = $myusername;
         $_SESSION['id'] = $userid; 

         header("location: student/UserApplication.php");
      }else {
         $error = "Your Username Name or Password is invalid";
      }
   }
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
      
  <title>WMSU ICS Online Pre-Admission</title>
  <link rel="icon" href="svgs/logo.png" sizes="32x32" type="image/png">    

  <link href="bootstrap4/css/bootstrap.min.css" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">          
  <link rel="stylesheet" href="css/login-style.css">
        
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark px-5">
            <a class="navbar-brand justify-content-start" href="index.html">
              <img src="svgs/ics_seal.jpg" alt="">WMSU ICS Online Pre-Admission
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="registration-page.php">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="login-page.php">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.html">About</a>
                </li>
              </ul>
            </div>
          </nav>
    </header>

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="svgs/ics_seal.jpg" alt="">
                <p class="h2">WMSU ICS Online Pre-Admission System</p>
            
                <div class="col-md-8 col-lg-8 col-sm-8" id="form-body">
                <h4 class="mb-4 mt-4 pt-3">Sign-in</h4>

            

                    <!--<form class="needs-validation" novalidate>
                        <div class="row">

                            <div class="col-12">
                                <input type="text" class="form-control" id="email" placeholder="" value="" required>
                                <label for="email" class="form-label">Email</label>
                                <div class="invalid-feedback">
                                    Username should not be empty.
                                </div>
                            </div>

                            <div class="col-12">
                                <input type="password" class="form-control" id="pass" placeholder="" value="" required>
                                <label for="pass" class="form-label">Password</label>
                                <div class="invalid-feedback">
                                    Password should not be empty.
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                              <input type="submit" value="Login" name="submit" class="login-button"/> 
                    --><!--<div class="menu-item-group">
                                    <button type="button" class="btn btn-login btn-secondary w-100 btn-md mt-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Login
                                    </button>
                                    <div class="dropdown-menu">
                                    <a href="admin/admin-pre-qualified.html" class="dropdown-item">Admin</a>
                                    <a href="student/UserProfile.html" class="dropdown-item">Student</a>
                                    <a href="evaluator/applicants.html" class="dropdown-item">Evaluator</a>
                                    <a href="ic/ic-pre-qualified-list.html" class="dropdown-item">Interviewer</a>
                                    <a href="ao/ao-cs-pre-qualified-list.html" class="dropdown-item">Admission Officer</a>
                                    </div>
                                </div>-->
                            <!--/div> -->
                            <!--<div class="col-sm-6">
                                <button class="w-100 btn btn-cancel btn-md mt-3 mb-3"> <a href="index.html">Cancel</a> </button>
                            </div>-->
                            <!--<div class="register ml-3">
                                Doesnt have an account yet? <a href="registration-page.html"><span class="pressMe">Click Here</span></a>
                            </div>
                        </div>
                    </form>-->
                    
                    <form class="form" method="POST" action="">
                          <label for="username" class="form-label">Username</label>
                          <input type="text" class="form-control" id="username" name="username" placeholder="" autofocus="true"/>
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder=""/>
                          <input type="submit" value="login" name="submit" class="btn btn-login w-100 mt-3"/>
             

                          <p class="link mt-2">Don't have an account? <a href="registration.php"><span class="pressMe">Registration Now</span></a></p>
                    </form>
                     

                </div>
            </div>
        </main>

        <footer class="mb-5 text-muted text-center text-small">
            <p class="mb-2">&copy; 2020–2023 KainotomoTech</p>
            </ul>
        </footer>
    
    </div>

    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>

