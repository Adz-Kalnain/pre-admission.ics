<?php
include ('../db.php');
if (isset($_POST['submit'])) {
	req();
}

if (isset($_POST['quotaSubmit'])) {
	quota();
}

if (isset($_POST['accountSubmit'])) {
	newAccount();
}

if (isset($_POST['accept'])) {
    $userID= $_POST['userID'];
    $action = 'VERIFIED';

    $query = "UPDATE selectedcourse SET userStatus='$action'  WHERE user_id='$userID'";
    $results = mysqli_query($db, $query);
        if ($results) {
        //echo $sender;
            $_SESSION['message'] = "Address updated!";
            
            header('location: coe.ao.main.php');
        } else {
            echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
        }
}

if  (isset($_POST['reject'])) {
    $userID= $_POST['userID'];
    $action = 'REJECT';

    $query = "UPDATE selectedcourse SET userStatus='$action'  WHERE user_id='$userID'";
    $results = mysqli_query($db, $query);
        if ($results) {
        //echo $sender;
            $_SESSION['message'] = "Address updated!"; 
            header('location: coe.ao.main.php');
        } else {
            echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);

        }
}

function req() {
    global $db, $message1;
    $gpa = mysqli_real_escape_string($db, $_POST['gpa']);
    $cet = mysqli_real_escape_string($db, $_POST['cet']);
    $college_id = "1";
    $course = mysqli_real_escape_string($db, $_POST['course']);

    $sql_check = "SELECT * FROM coursestbl WHERE college_id='$college_id' AND course_name='$course' LIMIT 1";

    $res_check = mysqli_query($db, $sql_check);

    if (mysqli_num_rows($res_check) == 1) {
        $query = "UPDATE coursestbl SET cet_req='$cet', gpa_req='$gpa' WHERE college_id='$college_id' AND course_name='$course'";
        $results = mysqli_query($db, $query);
        if ($results) {
            $message1 = "| You have updated the set requirement successfully.";
        }
    }
}


function quota() {
    global $db ,$quota_message;
    $college = "1";
    $course = $_POST['course_sel'];
    $quota = $_POST['quotaInput'];
    $waiting = $_POST['waitingInput'];

    $sql_check = "SELECT * FROM coursestbl WHERE college_id = '$college' AND course_name = '$course' LIMIT 1";
    $result_check = mysqli_query($db, $sql_check);

    if(mysqli_num_rows($result_check) == 1) {
        $query = "UPDATE coursestbl SET quota='$quota', waiting='$waiting' WHERE course_name='$course'";
        $results = mysqli_query($db, $query);

        if($results) {
            $quota_message = "| You have updated the course quota successfully.";
            mysqli_close($db);
        }
    }
}

function newAccount() {
    global $db , $name_error , $email_error , $account_message1 , $account_message2;
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

    $sql_u = "SELECT * FROM users WHERE username='$username'";
    $sql_e = "SELECT * FROM users WHERE email='$email'";

    $res_u = mysqli_query($db, $sql_u);
    $res_e = mysqli_query($db, $sql_e);

    if (mysqli_num_rows($res_u) > 0) {
        $name_error = "Username already taken"; 	
    }else if(mysqli_num_rows($res_e) > 0){
        $email_error = "Email already taken"; 	
    }else{
        $role="ics-".$role;
        $query = "INSERT INTO users (username, fname, lname, email, user_type, password) 
                  VALUES ('$username','$fname', '$lname', '$email', '$role', '".md5($password)."')";
        $results = mysqli_query($db, $query);
            //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
            if ($results) {
                $account_message1 = "| You have created an account successfully.";
            } else {
                $account_message2 = "| Required fields are missing.";
            }
    }
}

?>