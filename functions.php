<?php 
session_start();
include('../db.php');
// connect to database
//$db = mysqli_connect('localhost', 'root', '', 'initialsystem');
//$db = mysqli_connect('sql208.epizy.com', 'epiz_28315883', 'heDrBDtXAD', 'epiz_28315883_initialsystem');


// variable declaration
$username = "";
$email    = "";
$errors   = array();

function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: index.php");
}

if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);
		$rows = mysqli_num_rows($results);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);

			if ($logged_in_user['user_type'] == 'admin') {
  
						$_SESSION['user'] = $logged_in_user;
						$_SESSION['login_user'] = $username;
						$_SESSION['userID'] = $rows['id'];
						$_SESSION['success']  = "You are now logged in";
						header('location: admin/admin.main.php');		  
					}
					
					
					elseif ($logged_in_user['user_type'] == 'ics-evaluator'){
		
						$_SESSION['user'] = $logged_in_user;
						$_SESSION['login_user'] = $username;
						$_SESSION['userID'] = $rows['id'];
						$_SESSION['success']  = "You are now logged in";
						header('location: evaluator/ics.evaluator.main.php');
					}

					elseif ($logged_in_user['user_type'] == 'coe-evaluator'){
		
						$_SESSION['user'] = $logged_in_user;
						$_SESSION['login_user'] = $username;
						$_SESSION['userID'] = $rows['id'];
						$_SESSION['success']  = "You are now logged in";
						header('location: evaluator/coe.evaluator.main.php');
					}
					
					elseif ($logged_in_user['user_type'] == 'coe-ic'){
		
						$_SESSION['user'] = $logged_in_user;
						$_SESSION['login_user'] = $username;
						$_SESSION['userID'] = $rows['id'];
						$_SESSION['success']  = "You are now logged in";
						header('location: ic/coe.ic.main.php');
					}
					
					elseif ($logged_in_user['user_type'] == 'ics-ic'){
		
						$_SESSION['user'] = $logged_in_user;
						$_SESSION['login_user'] = $username;
						$_SESSION['userID'] = $rows['id'];
						$_SESSION['success']  = "You are now logged in";
						header('location: ic/ics.ic.main.php');
					}

					elseif ($logged_in_user['user_type'] == 'coe-ao'){
		
						$_SESSION['user'] = $logged_in_user;
						$_SESSION['login_user'] = $username;
						$_SESSION['userID'] = $rows['id'];
						$_SESSION['success']  = "You are now logged in";
						header('location: ao/coe.ao.qual.php');
					}

					elseif ($logged_in_user['user_type'] == 'ics-ao'){
		
						$_SESSION['user'] = $logged_in_user;
						$_SESSION['login_user'] = $username;
						$_SESSION['userID'] = $rows['id'];
						$_SESSION['success']  = "You are now logged in";
						header('location: ao/ics.qual.php');
					}
					
					elseif($logged_in_user['user_type'] == 'user'){
						$_SESSION['user'] = $logged_in_user;
						$_SESSION['login_user'] = $username;
						$_SESSION['userID'] = $rows['id'];
						$_SESSION['appID'] = $rows['applicantid'];
						$_SESSION['success']  = "You are now logged in";
						header('location: student/UserProfile.php');
			  }
			}

		else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}
//this one is optional^^^^^ 
?> 