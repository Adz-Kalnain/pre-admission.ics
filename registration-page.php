<!--  < ?php include('authenticate.php') ?>-->

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration-WMSU ICS Online Pre-Admission System</title>

    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
    <link rel="icon" href="svgs/logo.png" sizes="32x32" type="image/png">
    
    <style>
    .navbar{
        background-color:rgba(0, 128, 128, 0.808);
    }
    .navbar .navbar-brand img{
        width: 90px;
        border-radius: 60px;
        margin-right: 10px;
    }
    .navbar .navbar-collapse ul li a.active{
        border-bottom: 2px solid white;
    }
	.container {
		max-width: 960px;
	}
    .container main div img{
        width: 120px;
        border-radius: 60px;
    }
    .container main #form-body{
        background-color: rgba(104, 87, 67, 0.055);
        padding-left: 35px;
        padding-right: 35px;
        margin: auto;
        border-radius: 10px;
    }
    .container main .form{
        background-color: rgba(104, 87, 67, 0.055);
        padding-left: 35px;
        padding-right: 35px;
        margin: auto;
        border-radius: 10px;
    }
    .form-label{
        color: rgb(87, 85, 85);
        float: left;
        margin-top: 15px;
    }
    h4{
        color: rgb(85, 84, 84);
    }
    .form-check-label{
        color: grey;
    }
    .btn-submit{
        background-color: teal;
        color: white;
        width: 90%;
    }
    .btn-submit:hover{
        background-color: rgb(4, 116, 116);
        color: whitesmoke;
    }
    .form_error span {
        width: 80%;
        height: 35px;
        margin: 3px 10%;
        color: red;
    }
    @media (max-width: 375px){
        .h2{
            font-size: 20px;
        }
        .form-label{
            font-size: 15px;
        }
    }
    @media (max-width: 520px){
        .navbar .navbar-brand img{
            width: 60px;
        }
        .navbar .navbar-brand{
            font-size: 16px;
            font-weight: 200px;
        }
    }
    </style>

</head>
<body class="bg-light"> 
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
                  <a class="nav-link active" href="registration-page.php">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login-page.php">Login</a>
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
                <p class="lead">Please fill the field below with the correct information being asked.</p>
            
                <div class="col-md-7 col-lg-8" id="form-body">
                    <h4 class="mb-4 mt-4 pt-3">Registration</h4>

                    <!--<  ?php
                        /*require('db.php');
                        // pag e sumbit na, mag insert sia value sa database naten, anyways initialsystem pinangalan ko sa database naten
                        // tas users naman sa table
                        if (isset($_REQUEST['username'])) {
                            // pantanggal backslashes dih kodin alam masyado nakita kolang online
                            $username = stripslashes($_REQUEST['username']);
                            //escapes special characters sa strings
                            $username = mysqli_real_escape_string($con, $username);
                            $email    = stripslashes($_REQUEST['email']);
                            $email = mysqli_real_escape_string($con, $email);
                            $password = stripslashes($_REQUEST['password']);
                            $password = mysqli_real_escape_string($con, $password);
                            $query = "INSERT into `users` (username, password, email, user_type)
                                        VALUES ('$username', '" . md5($password) . "', '$email' , 'user')";
                            $result = mysqli_query($con, $query);
                            //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                            if ($result) {
                                echo "<div class='form'>
                                    <h3>You are registered successfully.</h3><br/>
                                    <p class='link pb-2'>Click here to <a href='login-page.php'>Login</a></p>
                                    </div>";
                            } else {
                                echo "<div class='form'>
                                    <h3>Required fields are missing.</h3><br/>
                                    <p class='link'>Click here to <a href='registration-page.php'>registration</a> again.</p>
                                    </div>";
                            }
                        } else {
                    ?>-->
                    
                    <?php 
                        $db = mysqli_connect('localhost', 'root', '', 'initialsystem');
                        $username = "";
                        $email = "";
                        $name = "";
                        if (isset($_POST['submit'])) {
                            $name = $_POST['name'];
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $sql_u = "SELECT * FROM users WHERE username='$username'";
                            $sql_e = "SELECT * FROM users WHERE email='$email'";
            
                            $res_u = mysqli_query($db, $sql_u);
                            $res_e = mysqli_query($db, $sql_e);

                            if (mysqli_num_rows($res_u) > 0) {
                            $name_error = "Username already taken"; 	
                            }else if(mysqli_num_rows($res_e) > 0){
                            $email_error = "Email already taken"; 	
                            }else{
                                $query = "INSERT INTO users (name,username, email, password, user_type) 
                                        VALUES ('$name','$username', '$email', '$password', 'user')";
                                $results = mysqli_query($db, $query);
                                    //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                    if ($results) {
                                        echo "<div class='form'>
                                            <h3>You are registered successfully.</h3><br/>
                                            <p class='link pb-2'>Click here to <a href='login-page.php'>Login</a></p>
                                            </div>";
                                    } else {
                                        echo "<div class='form'>
                                            <h3>Required fields are missing.</h3><br/>
                                            <p class='link'>Click here to <a href='registration-page.php'>registration</a> again.</p>
                                            </div>";
                                    }
                                //exit();
                            }
                        }else{
                    ?>

                    <form class="form" action="" method="post">


                    <label for="name" class="form-label">Name</label>
                      
                            <input type="text" class="form-control login-input" id="name" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
          


                        <label for="username" class="form-label">Username</label>
                        <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
                            <input type="text" class="form-control login-input" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                            <?php if (isset($name_error)): ?>
                            <span><?php echo $name_error; ?></span>
                            <?php endif ?>

                        </div>
                        <label for="email" class="form-label">Email</label>
                        <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
                            <input type="email" class="form-control login-input" id="email" name="email" placeholder="Email Adress" value="<?php echo $email; ?>" required>
                            <?php if (isset($email_error)): ?>
                            <span><?php echo $email_error; ?></span>
                            <?php endif ?>
                        </div>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control login-input" name="password" placeholder="Password" required>
                        <input type="submit" name="submit" value="Register" class="btn btn-submit mt-2 mb-2">
                        <p class="link pb-2">Already have an account? <a href="login-page.php">Login here</a></p>
                    </form>
                    <?php
                    }
                    ?>
                    <!--<  ?php
                        }
                    ?>-->

                </div>
            </div>
        </main>
        

    <footer class="text-muted text-center text-small">
        <p>&copy; 2020–2023 KainotomoTech</p>
        </ul>
    </footer>

</div>

<!--<script>
    var password = document.getElementById("createpass")
    , confirm_password = document.getElementById("confirmpass");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
        confirm_password.setCustomValidity('');
        }
    }
    createpass.onchange = validatePassword;
    confirmpass.onkeyup = validatePassword;
</script>

<script>
    function validateForm(){
        alert("User Registration Was Successfull");
        return true;
    }
</script>
-->
<script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
<script src="js/form-validation.js"></script>

</body>
</html>