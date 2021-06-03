<?php 
include ('../db.php');
include ('../session.php');

$query = mysqli_query($db, "SELECT * FROM users WHERE username = '".$_SESSION['login_user']."'") or die(mysql_error());
$arr = mysqli_fetch_array($query);

if (isset($_POST['cancel'])) { 

$del = mysqli_query($db,"delete from selectedcourse where user_id = '".$arr['id']."'"); // delete query
// echo $arr['id'];
if($del)
{
     mysqli_close($db); // Close connection
     header("location:UserProfile.php"); // redirects to all records page
   
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
}
?>