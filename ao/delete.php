<?php 
$conn = new mysqli("localhost", "root", "", "initialsystem");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
	$reqid = $_GET['id'];
	$delete_queries = "DELETE FROM `requirementtbl` WHERE `id`='$reqid'";
$result = $conn->query($delete_queries);

	if ($result == TRUE){
		header('location: ao.sett.php');
	}else{
		echo "Error:" .$conn->error;
	}
}

if (isset($_GET['course_id'])) {
	$courseid = $_GET['course_id'];
	$delete_queries = "DELETE FROM `coursestbl` WHERE `course_id`='$courseid'";
	$result = $conn->query($delete_queries);

	if ($result == TRUE){
		header('location: ao.sett.php');
	}else{
		echo "Error:" .$conn->error;
	}
}

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$delete_queries = "DELETE FROM `interviewertbl` WHERE `id`='$id'";
	$result = $conn->query($delete_queries);

	if ($result == TRUE){
		header('location: ao.sett.php');
	}else{
		echo "Error:" .$conn->error;
	}
}

?>