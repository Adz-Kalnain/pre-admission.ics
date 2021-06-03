<?php
include ('../db.php');

if (isset($_POST['submit'])) {
	req();
}

if (isset($_POST['courseSubmit'])) {
	course();
}

if (isset($_POST['collegeSubmit'])) {
	college();
}

if (isset($_POST['admissionsubmit'])) {
	admission();
}

if (isset($_POST['quotaSubmit'])) {
	quota();
}

// if (isset($_POST['schedSubmit'])) {
// 	sched();
// }

if (isset($_POST['accountSubmit'])) {
	newAccount();
}



function req() {
    global $db , $errors , $message1 , $message2;
    $college = "";
    $course = "";
    $cet = "";
    $gpa = "";
    $gpa = e($_POST['gpa']);
    $cet = e($_POST['cet']);
    $college = e($_POST['college']);
    $course = e($_POST['course']);

    $sql_check = "SELECT * FROM coursestbl WHERE college_id='$college' AND course_name='$course' LIMIT 1";

    $res_check = mysqli_query($db, $sql_check);

    if (mysqli_num_rows($res_check) == 1) {
        $query = "UPDATE coursestbl SET cet_req='$cet', gpa_req='$gpa' WHERE course_name='$course'";
        $results = mysqli_query($db, $query);
        
        if ($results) {
            $message1 = "| You have Updated the set requirement successfully.";
        }
    }
}

function course() {
    global $db , $course_message1 , $course_message2;
    $coursename = "";
    $coursedescription = "";
    $college = "";
    $coursename = e($_POST['courseName']);
    $coursedescription = e($_POST['courseDescription']);  
    $college = e($_POST['college']);
    
        $sql_check = "SELECT * FROM coursestbl WHERE course_name='$coursename' LIMIT 1";

        $res_check = mysqli_query($db, $sql_check);

        if (mysqli_num_rows($res_check) == 1) {
            $course_message1 = "| Course was added already. Try a different one.";
        }else{
            $query = "INSERT INTO coursestbl (course_name, course_description, college_id) 
            VALUES ('$coursename','$coursedescription', '$college')";
            $results = mysqli_query($db, $query);
        
            if ($results) {
                $course_message2 = "| Course was added successfully.";
                //header("locatio:setting-copy.php?#list-course");
            }
        }
}

function college() {
    global $db , $errors , $college_message1 , $college_message2;
    $collegename = "";
    $collegedescription = "";
    $collegename = e($_POST['collegeName']);
    $collegedescription = e($_POST['collegeDescription']);
    
        $sql_check = "SELECT * FROM college WHERE college_name='$collegename' LIMIT 1";

        $res_check = mysqli_query($db, $sql_check);

        if (mysqli_num_rows($res_check) == 1) {
            $college_message1 = "| College was added already. Try a different one.";
        }else{
            $query = "INSERT INTO college (college_name, college_description) 
            VALUES ('$collegename','$collegedescription')";
            $results = mysqli_query($db, $query);
        
            if ($results) {
                $college_message2 = "| College was added successfully.";
                //header("locatio:setting-copy.php?#list-course");
            }
        }
}

function admission() {
    global $db , $admission_message;
    $start = "";
    $end = "";
    $sy = "";
    $start = $_POST['startingdate'];
    $end = $_POST['endingdate'];
    $sy = $_POST['sy'];

    $sql_check = "SELECT * FROM admissionbatch WHERE is_active='1' LIMIT 1";

    $res_check = mysqli_query($db, $sql_check);

    if (mysqli_num_rows($res_check) == 1) {
        $query = "UPDATE admissionbatch SET start_date='$start', end_date='$end', shoolyear='$sy' WHERE is_active='1'";
        $results = mysqli_query($db, $query);
        
        if ($results) {
            $admission_message = "| You have updated the admission date successfully.";
            mysqli_close($db);
        }
    }else{
        $query = "INSERT INTO admissionbatch (end_date, start_date, schoolyear, is_active) 
        VALUES ('$end', '$start', '$sy', '1')";
        $results = mysqli_query($db, $query);
        if ($results) {
            $admission_message = "| You have set the admission date successfully.";
            mysqli_close($db);
        }
    }
    
}

function quota() {
    global $db ,$quota_message;
    $course = mysqli_real_escape_string($db, $_POST['course']);
    $quota = mysqli_real_escape_string($db, $_POST['quota']);
    $waiting = mysqli_real_escape_string($db, $_POST['waiting']);
   
    $sql_check = "SELECT * FROM coursestbl WHERE course_name = '$course' LIMIT 1";
    $result_check = mysqli_query($db, $sql_check);

    if(mysqli_num_rows($result_check) == 1) {
        $query = "UPDATE coursestbl SET quota='$quota', waiting='$waiting' WHERE course_name='$course'";
        $results = mysqli_query($db, $query);

        if($results) {
            $quota_message = "| You have updated the course quota successfully.";
        }
    }
}

// function sched() {
//     global $db , $errors , $sched_message1 , $sched_message2 , $sched_message3;
//     $icname = "";
//     $icdate = "";
//     $ictimefrom = "";
//     $ictimeto = "";
//     $college = "";

//    $icname = $_POST['setInterviewer'];
//     $icdate = $_POST['setScheddate'];
//     $ictimefrom = $_POST['setSchedTimeFrom'];
//     $ictimeto = $_POST['setSchedTimeTo'];
//     $college = $_POST['college'];

//     $sql_check = "SELECT * FROM interviewertbl WHERE ic_date = '$icdate' AND ic_name = '$icname'";
//     $sql = mysqli_query($db, $sql_check);

//     if (mysqli_num_rows($sql) > 0) {
//         $sched_message1 = "| Creation failed, Schedule Already Existed";
//     }else {
//         $query = "INSERT INTO interviewertbl (ic_name, ic_date, ic_timefrom, ic_timeto, college)
//         VALUES ('$icname', '$icdate', '$ictimefrom', '$ictimeto', '$college')"; 
        
//         $result = mysqli_query($db,$query);
//         if ($result) {
//             $sched_message2 = "| Schedule created successfully";
//         }else{
//             $sched_message3 = "| An error occured. Schedule Creation unseccessful";
//         }
//     }

// }

function newAccount() {
    global $db , $name_error , $email_error , $account_message1 , $account_message2;
    $fname = "";
    $lname = "";
    $username = "";
    $email = "";
    $college = "";
    $role = "";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $college = $_POST['college'];
    $role = $_POST['role'];

    if ($college == '1') {
        $role = 'ics-'.$role;
    }else{
        $role = 'coe-'.$role;
    }

    $sql_u = "SELECT * FROM users WHERE username='$email'";

    $res_u = mysqli_query($db, $sql_u);

    if (mysqli_num_rows($res_u) > 0) {
        $name_error = "Email already taken"; 	
    }else{
        $query = "INSERT INTO users (username, fname, lname, email, user_type, password) 
                  VALUES ('$email', '$fname', '$lname', '$email', '$role', '".md5($password)."')";
        $results = mysqli_query($db, $query);
            //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
            if ($results) {
                $account_message1 = "| You created an account successfully.";
            } else {
                $account_message2 = "| Required fields are missing.";
            }
    }
}

?>