<?php
 include('../session.php');
 include('../db.php');



 $query= mysqli_query($db,"SELECT * FROM users WHERE `username` = '".$_SESSION['login_user']."' ")or die(mysql_error());
 $arr = mysqli_fetch_array($query);
 $userid = $arr['id'];

 if (isset($_POST['send'])) { // if save button on the form is clicked
    // name of the uploaded file


    $courseID = $_POST['id'];
    $id = $arr['id'];
 //   $created_at = date('m/d/Y h:i:s a', time()); 

    
    $cet = $_FILES['cet']['name'];
    $moral = $_FILES['moral']['name'];
    $gpa = $_FILES['gpa']['name'];
  //  $shiftee = $_FILES['shiftee']['name'];

    // destination of the file on the server
    $destination = '../files_upload/attachment/' . $cet;
    $destination2 = '../files_upload/attachment/' . $moral;
    $destination3 = '../files_upload/attachment/' . $gpa;


    // get the file extension
    $extension1 = pathinfo($cet, PATHINFO_EXTENSION);
    $extension2 = pathinfo($moral, PATHINFO_EXTENSION);
    $extension3 = pathinfo($gpa, PATHINFO_EXTENSION);


    // the physical file on a temporary uploads directory on the server
    $file1 = $_FILES['cet']['tmp_name'];
    $file2 = $_FILES['moral']['tmp_name'];
    $file3 = $_FILES['gpa']['tmp_name'];


    $size = $_FILES['cet']['size'];

    if (!in_array($extension1, ['zip', 'pdf', 'docx', 'jpeg', 'jpg', 'png'])) {
        echo "You file extension must be .zip, .pdf, .docx , .jpeg, .jpg, or .png";
    } elseif ($_FILES['cet']['size'] > 10000000) { // file shouldn't be larger than 10Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        move_uploaded_file($file2, $destination2);
        move_uploaded_file($file3, $destination3);
        if (move_uploaded_file($file1, $destination)) {
            
            $sql = "INSERT INTO attachment (cet_path,gpa_path,gmoral_path,user_id) VALUES ('$cet','$moral','$gpa','$id')";
            if (mysqli_query($db, $sql)) {
                $file_id = mysqli_insert_id($db);
               $query1= mysqli_query($db,"INSERT INTO selectedcourse (user_id,course_id,file_id) VALUES ('$id','$courseID','$file_id')") ;
             //  $_SESSION['message'] = $tracking_code; 
            //header("Location: ../../pages/user/send_docu.php");    
            echo $courseID;
            echo $id;


            }
        } else {
            echo "Failed to upload file.";
        }
    }
}