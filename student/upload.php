<?php
 include('../session.php');
 include('../db.php');



 $query= mysqli_query($db,"SELECT * FROM users WHERE `username` = '".$_SESSION['login_user']."' ")or die(mysql_error());
 $arr = mysqli_fetch_array($query);
 $userid = $arr['id'];


// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['file']['name'];

    // destination of the file on the server
    $destination = '../files_upload/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpeg', 'jpg', 'png'])) {
        echo "You file extension must be .zip, .pdf, .docx , .jpeg, .jpg, or .png";
    } elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO file (file_name, size, user_id,file_path) VALUES ('$filename', $size, '$userid','$destination ')";
            if (mysqli_query($db, $sql)) {
                echo "File uploaded successfully";
                
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}