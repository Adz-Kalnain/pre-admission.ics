<?php
 include('../session.php');
 include('../db.php');



 $query= mysqli_query($db,"SELECT * FROM users WHERE `username` = '".$_SESSION['login_user']."' ")or die(mysql_error());
 $arr = mysqli_fetch_array($query);
 $userid = $arr['id'];
 $name = $_POST['pname'];
 $address = $_POST['address'];
 $contact = $_POST['contact'];
$birthdate = $_POST['birthdate'];



// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file




    $filename = $_FILES['cscet']['name'];
    // destination of the file on the server
    $destination = '../files_upload/CS/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['cscet']['tmp_name'];
    $size = $_FILES['cscet']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpeg', 'jpg', 'png'])) {
        echo "You file extension must be .zip, .pdf, .docx , .jpeg, .jpg, or .png";
    } elseif ($_FILES['cscet']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO applicants (cet_name,cet_path,name,address, contact, birthdate) VALUES ('$filename','$destination','$name','$address', '$contact', '$birthdate' )";
            if (mysqli_query($db, $sql)) {
                echo "File uploaded successfully";
                header ("Location: UserApplication.php");
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}