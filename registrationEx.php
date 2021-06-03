<?php include('registrationclass.php');
include('../db.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration - WMSU Online Pre-Admission System</title>
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
    <link rel="icon" href="seal/wmsu-logo.png" sizes="32x32" type="image/png">

    <style>
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
                    
                    session_start();




                    if (isset($_POST['submit'])) {
                        $applicantid = $_POST['applicant'];
                        $app_ID = $_POST['applicant'];



                        $checking = "SELECT * FROM cetresult WHERE applicantid='$applicantid'";
                        $account =  "SELECT * FROM users WHERE applicantid='$app_ID'";

                        $checking_result =  mysqli_query($db, $checking);
                        $account_result = mysqli_query($db, $account);

                        if (mysqli_num_rows($checking_result) < 1) {
                            echo "Sorry your we don't recognize your Applicant ID<br>";
                            echo "<div class='form'>
                            <p class='link pb-2'>Click here to <a href='registrationEx.php'>Try again</a></p>
                            </div>";
                        } else if (mysqli_num_rows($account_result) > 0) {
                            echo "Account already exist";
                            echo "<br><br><div class='form'>
                            <p class='link pb-2'>Click here to <a href='registrationEx.php'>Try again</a></p>
                            </div>";
                        } else {
                            $_SESSION['appID'] = $app_ID;
                            // $appID = new MyClass();
                            // $appID->setAppid($app_ID);
                            header("location: RegistrationEx1.php");
                            //echo 'AppID:'  . $appID->getAppid().'<br>';


                        }
                    } else {
                    ?>

                        <form class="form" action="" method="post">
                            <label for="email" class="form-label">CET's Applicant ID</label>
                            <input type="text" class="form-control login-input" id="applicant" name="applicant" required>


                            <input type="submit" name="submit" value="Submit" class="btn btn-submit mt-2 mb-2">
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