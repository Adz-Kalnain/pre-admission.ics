<?php
include ('../../db.php');

if (isset($_GET['user_id'])) {
    $userID = $_GET['user_id'];
    $action = 'VERIFIED';

    $query = "UPDATE selectedcourse SET userStatus='$action' WHERE user_id='$userID'";
    $results = mysqli_query($db, $query);
        if ($results) {
        //echo $sender;
            $_SESSION['message'] = "Address updated!";
            
            header('location: ../coe.evaluator.main.php');
        } else {
            echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
        }
}

if (isset($_GET['icsuser_id'])) {
    $userID = $_GET['icsuser_id'];
    $action = 'VERIFIED';

    $query = "UPDATE selectedcourse SET userStatus='$action' WHERE user_id='$userID'";
    $results = mysqli_query($db, $query);
        if ($results) {
        //echo $sender;
            $_SESSION['message'] = "Address updated!";
            
            header('location: ../ics.evaluator.main.php');
        } else {
            echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
        }
}
?>