<?php
include ('../db.php');
if (isset($_POST['submit'])) {
	req();
}

if (isset($_POST['quotasubmit'])) {
	quota();
}

if (isset($_POST['accountSubmit'])) {
	newAccount();
}

function req() {
    global $db, $message1;
    $gpa = mysqli_real_escape_string($db, $_POST['gpa']);
    $cet = mysqli_real_escape_string($db, $_POST['cet']);
    $college_id = "2";
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
    $course = mysqli_real_escape_string($db, $_POST['course']);
    $quota = mysqli_real_escape_string($db, $_POST['quota']);
    $waiting = mysqli_real_escape_string($db, $_POST['waiting']);
    $college_id = "2";

    $sql_check = "SELECT * FROM coursestbl WHERE college_id = '$college_id' AND course_name = '$course' LIMIT 1";
    $result_check = mysqli_query($db, $sql_check);

    if(mysqli_num_rows($result_check) == 1) {
        $query = "UPDATE coursestbl SET quota='$quota', waiting='$waiting' WHERE course_name='$course'";
        $results = mysqli_query($db, $query);

        if($results) {
            $quota_message = "| You have updated the course quota successfully.";
        }
    }
}

function newAccount() {
    global $db , $name_error , $email_error , $account_message1 , $account_message2;
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

    $sql_u = "SELECT * FROM users WHERE username='$email'";

    $res_u = mysqli_query($db, $sql_u);

    if (mysqli_num_rows($res_u) > 0) {
        $name_error = "Email already taken"; 	
    }else{
        $role="coe-".$role;
        $query = "INSERT INTO users (username, fname, lname, email, user_type, password) 
                  VALUES ('$email','$fname', '$lname', '$email', '$role', '".md5($password)."')";
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