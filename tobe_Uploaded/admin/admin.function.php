<?php
//include '../configure.php';
$server_name = "localhost";
$user_name = "root";
$password = "";
$dbname = "initialsystem";
$db = new mysqli ($server_name, $user_name, $password, $dbname);

if ($db->connect_error) {
    die ("Connection failed:".$db->connect_error);
}

if (isset($_POST['submit'])) {
	req();
}

if (isset($_POST['courseSubmit'])) {
	course();
}

if (isset($_POST['admissionSubmit'])) {
	admission();
}

if (isset($_POST['quotaSubmit'])) {
	quota();
}

if (isset($_POST['schedSubmit'])) {
	sched();
}

if (isset($_POST['accountSubmit'])) {
	newAccount();
}



function req() {
    global $db, $errors , $message1 , $message2;
    $gpa = mysqli_real_escape_string($db, $_POST['gpa']);
    $cet = mysqli_real_escape_string($db, $_POST['cet']);
    $college = mysqli_real_escape_string($db, $_POST['college']);
    $course = mysqli_real_escape_string($db, $_POST['course']);

    $sql_check = "SELECT * FROM requirementtbl WHERE college='$college' AND course='$course' LIMIT 1";

    $res_check = mysqli_query($db, $sql_check);

    if (mysqli_num_rows($res_check) == 1) {
        $query = "UPDATE requirementtbl SET cet='$cet', gpa='$gpa' WHERE college='$college' AND course='$course'";
        $results = mysqli_query($db, $query);
        if ($results) {
            $message1 = "| You Updated the set requirement successfully.";
        }
    }else{
        $query = "INSERT INTO requirementtbl (college, course, cet, gpa) 
        VALUES ('$college', '$course','$cet', '$gpa')";
        $results = mysqli_query($db, $query);
        if ($results) {
            $message2 = "| You Inserted the set requirement successfully.";
        }
    }
}

function course() {
    global $db , $errors , $course_message1 , $course_message2;
    $coursename = mysqli_real_escape_string($db, $_POST['courseName']);
    $coursemajor = mysqli_real_escape_string($db, $_POST['courseMajor']);
    $coursedescription = mysqli_real_escape_string($db, $_POST['courseDescription']);  
    $college = mysqli_real_escape_string($db, $_POST['college']);
    
        $sql_check = "SELECT * FROM coursestbl WHERE course_name='$coursename' LIMIT 1";

        $res_check = mysqli_query($db, $sql_check);

        if (mysqli_num_rows($res_check) == 1) {
            $course_message1 = "| Course already created. Try a different one.";
        }else{
            $query = "INSERT INTO coursestbl (course_name, coursemajor, course_description, college) 
            VALUES ('$coursename', '$coursemajor', '$coursedescription', '$college')";
            $results = mysqli_query($db, $query);
        
            if ($results) {
                $course_message2 = "| Course created successfully.";
            }
        }
}

function admission() {   

    global $db , $errors , $admission_message1 , $admission_message2;
    $start = mysqli_real_escape_string($db, $_POST['startingdate']);
    $end = mysqli_real_escape_string($db, $_POST['endingdate']);
    $schoolyear = mysqli_real_escape_string($db, $_POST['schoolyear']);

    $sql_check = "SELECT * FROM admissiondatetbl WHERE is_active='1' LIMIT 1";

    $res_check = mysqli_query($db, $sql_check);

    if (mysqli_num_rows($res_check) == 1) {
        $query = "UPDATE admissiondatetbl SET start_date='$start', end_date='$end', schoolyear='$schoolyear' WHERE is_active='1'";
        $results = mysqli_query($db, $query);
        
        if ($results) {
            $admission_message1 = "| You have updated the admission date successfully.";
            mysqli_close($db);
        }
    }else{
        $query = "INSERT INTO admissiondatetbl (start_date, end_date, schoolyear, is_active) 
        VALUES ('$start','$end', '$schoolyear', '1')";
        $results = mysqli_query($db, $query);
        if ($results) {
            $admission_message2 = "| You have set the admission date successfully.";
            mysqli_close($db);
        }
    }
    /*global $db, $admission_message1 , $admission_message2;
    $sql_check = "SELECT * FROM admissiondatetbl WHERE is_active='1' LIMIT 1";

    $res_check = mysqli_query($db, $sql_check);

    if (mysqli_num_rows($res_check) == 1) {
        $stmt = $db->prepare("UPDATE adminsiondatetbl SET start_date='?', end_date='?', schoolyear='?' WHERE is_active='?'");
        $stmt->bind_param("ssss", $start, $end, $schoolyear, $active);

        $start = $_POST['startingdate'];
        $end = $_POST['endingdate'];
        $schoolyear = $_POST['schoolyear'];
        $active = "1";

        $stmt->execute();
        
        $message1 = "| You have updated the admission date successfully.";

        $stmt->close();
        $db->close();
    }*/
    
}

function quota() {
    global $db , $errors , $quota_message1 , $quota_message2;
    $college = mysqli_real_escape_string($db, $_POST['college_dept']);
    $course = mysqli_real_escape_string($db, $_POST['course_sel']);
    $quota = mysqli_real_escape_string($db, $_POST['quotaInput']);

    $sql_check = "SELECT * FROM quotatbl WHERE quota_college = '$college' AND quota_course = '$course'";
    $result_check = mysqli_query($db, $sql_check);

    if(mysqli_num_rows($result_check) == 1) {
        $query = "UPDATE quotatbl SET quota_college = '$college', quota_course = '$course', quota = '$quota'";
        $results = mysqli_query($db, $query);

        if($results) {
            $quota_message1 = "| You have updated the Course Quota successfully.";
            mysqli_close($db);
        }
    }else{
        $query = "INSERT INTO quotatbl (quota_college, quota_course, quota)
                    VALUES ('$college', '$course', '$quota')";
        $results = mysqli_query($db, $query);
        if($results) {
            $quota_message2 = "| You have set the course quota successfully.";
        }
    }
}

function sched() {
    global $db , $errors , $sched_message1 , $sched_message2 , $sched_message3;
   $icname = mysqli_real_escape_string($db, $_POST['setInterviewer']);
    $icdate = mysqli_real_escape_string($db, $_POST['setScheddate']);
    $ictimefrom = mysqli_real_escape_string($db, $_POST['setSchedTimeFrom']);
    $ictimeto = mysqli_real_escape_string($db, $_POST['setSchedTimeTo']);
    $college = mysqli_real_escape_string($db, $_POST['college']);

    $sql_check = "SELECT * FROM interviewertbl WHERE ic_date = '$icdate' AND ic_name = '$icname'";
    $sql = mysqli_query($db, $sql_check);

    if (mysqli_num_rows($sql) > 0) {
        $sched_message1 = "| Creation failed, Schedule Already Existed";
    }else {
        $query = "INSERT INTO interviewertbl (ic_name, ic_date, ic_timefrom, ic_timeto, college)
        VALUES ('$icname', '$icdate', '$ictimefrom', '$ictimeto', '$college')"; 
        
        $result = mysqli_query($db,$query);
        if ($result) {
            $sched_message2 = "| Schedule created successfully";
        }else{
            $sched_message3 = "| An error occured. Schedule Creation unseccessful";
        }
    }

}

function newAccount() {
    global $db , $name_error , $email_error , $account_message1 , $account_message2;
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $college = mysqli_real_escape_string($db, $_POST['college']);
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
        $query = "INSERT INTO users (name, username, email, password, user_type, college) 
                  VALUES ('$name','$username', '$email', '".md5($password)."', '$role' , '$college')";
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