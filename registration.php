<!--  < ?php include('authenticate.php') ?>-->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration - WMSU Online Pre-Admission System</title>

    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
    <link rel="icon" href="seal/wmsu-logo.png" sizes="32x32" type="image/png">

    <style>
        /*.navbar{
        background-color:rgba(0, 128, 128, 0.808);
    }
    .navbar .navbar-brand img{
        width: 90px;
        border-radius: 60px;
        margin-right: 10px;
    }
    .navbar .navbar-collapse ul li a.active{
        border-bottom: 2px solid white;
    }*/
        .container {
            max-width: 960px;
        }

        .container main div img {
            width: 120px;
            border-radius: 60px;
        }

        .container main #form-body {
            background-color: rgba(104, 87, 67, 0.055);
            padding-left: 35px;
            padding-right: 35px;
            margin: auto;
            border-radius: 10px;
        }

        .container main .form {
            /*background-color: rgba(104, 87, 67, 0.055);*/
            padding-left: 35px;
            padding-right: 35px;
            padding-bottom: 5px;
            margin: auto;
            border-radius: 10px;
        }

        .form-label {
            color: rgb(87, 85, 85);
            float: left;
            margin-top: 15px;
        }

        h4 {
            color: rgb(85, 84, 84);
        }

        .form-check-label {
            color: grey;
        }

        .btn-submit {
            background-color: crimson;
            color: white;
            width: 90%;
        }

        .btn-submit:hover {
            background-color: rgb(173, 17, 49);
            color: whitesmoke;
        }

        .form_error span {
            width: 80%;
            height: 35px;
            margin: 3px 10%;
            color: red;
        }

        .form .link a {
            color: crimson;
        }

        @media (max-width: 375px) {
            .h2 {
                font-size: 20px;
            }

            .form-label {
                font-size: 15px;
            }
        }

        @media (max-width: 520px) {
            .navbar .navbar-brand img {
                width: 60px;
            }

            .navbar .navbar-brand {
                font-size: 16px;
                font-weight: 200px;
            }
        }

        @media (max-width: 440px) {
            .navbar .navbar-brand {
                font-size: 15px;
                font-weight: 600;
            }

            .navbar .navbar-brand img {
                width: 30px;
                margin-right: 2px;
            }

            .navbar .navbar-toggler .navbar-toggler-icon {
                width: 20px;
                height: 20px;
            }
        }
    </style>

</head>

<body class="bg-light">

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="seal/wmsu-logo.png" alt="">
                <p class="h2">WMSU Online Pre-Admission System</p>
                <p class="lead">Please fill the field below with the correct information being asked.</p>

                <div class="col-md-7 col-lg-8" id="form-body">
                    <h4 class="mb-4 mt-4 pt-3">Registration</h4>

                    <?php
                    $db = mysqli_connect('localhost', 'root', '', 'initialsystem');
                    session_start();
                    $username = "";



                    if (isset($_POST['submit'])) {
                        $applicantid = $_POST['applicant'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        // $fname = $_POST['fname'];
                        // $lname = $_POST['lname'];

                        $sql_e = "SELECT * FROM users WHERE username='$username'";
                        $checking = "SELECT * FROM cetresult WHERE applicantid='$applicantid'";

                        $res_e = mysqli_query($db, $sql_e);
                        $checking_result =  mysqli_query($db, $checking);

                        if (mysqli_num_rows($checking_result) < 1) {
                            echo "Sorry your we don't recognize your Applicant ID";
                            echo "<br><br><div class='form'>
                            <p class='link pb-2'>Click here to <a href='registration.php'>Try again</a></p>
                            </div>";
                            
                        }
                        
                        else if (mysqli_num_rows($res_e) > 0) {
                            $username_error = "Email already taken";
                        } 
                        
                         else {
                            $query = "INSERT INTO users (username, password, user_type,studentType) 
                                        VALUES ('$username', '" . md5($password) . "', 'user')";
                            $results = mysqli_query($db, $query);
                            //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                            if ($results) {

                                echo "<div class='form'>
                                            <h3>You are registered successfully.</h3><br/>
                                            <p class='link pb-2'>Click here to <a href='index.php'>Login</a></p>
                                            </div>";
                            } else {
                                echo "<div class='form'>
                                            <h3>Required fields are missing.</h3><br/>
                                            <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                                            </div>";
                            }
                            //exit();
                        }
                    } else {
                    ?>

                        <form class="form" action="" method="post">
                            <label for="email" class="form-label">CET's Applicant ID</label>
                            <input type="text" class="form-control login-input" id="applicant" name="applicant" required>


                           


                            <div class="form-group">
                                <label>First Name :</label>
                                <input type="id" disabled="disabled" name="firstname" id="firstname" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Last name :</label>
                                <input type="name" name="sender" disabled="disabled" id="lastname" class="form-control">
                            </div>

                            <label for="email" class="form-label">Email</label>
                            <div <?php if (isset($username_error)) : ?> class="form_error" <?php endif ?>>
                                <input type="username" class="form-control login-input" id="username" name="username" placeholder="Email Adress" value="<?php echo $username; ?>" required>
                                <?php if (isset($username_error)) : ?>
                                    <span><?php echo $username_error; ?></span>
                                <?php endif ?>
                            </div>
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control login-input" name="password" placeholder="Password" required>
                            <input type="submit" name="submit" value="Register" class="btn btn-submit mt-2 mb-2">
                            <p class="link pb-2">Already have an account? <a href="index.php">Login here</a></p>
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
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script src="js/form-validation.js"></script>

</body>

</html>