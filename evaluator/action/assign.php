<?php
include ('../db.php');

if (isset($_POST['assign'])) {
    $userID = $_POST['userid'];
    $ic = $_POST['icname'];
    $action = 'INTERVIEW';

    
    $query = "UPDATE selectedcourse SET ic='$ic', userStatus = '$action' WHERE user_id='$userID'";
    $results = mysqli_query($db, $query);
        if ($results) {
        //echo $sender;
            $_SESSION['message'] = "Address updated!"; 
            header('location: coe.evaluator.pre.php');
        } else {
            echo "ERROR: Could not be able to execute $query. ".mysqli_error($db);
        }
}

if (isset($_POST['assignIcs'])) {
    $userID = $_POST['userid'];
    $ic = $_POST['icname'];
    $action = 'INTERVIEW';

    
    $query = "UPDATE selectedcourse SET ic='$ic', userStatus = '$action' WHERE user_id='$userID'";
    $results = mysqli_query($db, $query);
        if ($results) {
        //echo $sender;
            $_SESSION['message'] = "Address updated!"; 
            header('location: ics.evaluator.pre.php');
        } else {
            echo "ERROR: Could not be able to execute $query. ".mysqli_error($db);
        }
}

if (isset($_POST['scoreSave'])) {
    $userID = $_POST['userid'];
    $score = $_POST['score'];
    $cetscore = $_POST['cetscore'];
    $gpascore = $_POST['gpascore'];
    $quota = $_POST['coursequota'];
    $grandtotal = ($score+$cetscore+$gpascore)/3;
  
    $check = "SELECT * FROM selectedcourse";
    $check_result = mysqli_query($db,$check);
    if (mysqli_num_rows($check_result)<=$quota) {
        $action = 'QUALIFIED';
        $query = "UPDATE selectedcourse SET userStatus='$action', average='$grandtotal' ,inter_score='$score' WHERE user_id='$userID'";
        $results = mysqli_query($db, $query);
        if ($results) {
        //echo $sender;
            $_SESSION['message'] = "Address updated!"; 
            header('location: coe.evaluator.pre.php');
        } else {
            echo "ERROR: Could not be able to execute $query. ".mysqli_error($db);
        }
    }else {
        $action = 'WAITING';
        $query = "UPDATE selectedcourse SET userStatus='$action', average='$grandtotal' ,inter_score='$score' WHERE user_id='$userID'";
        $results = mysqli_query($db, $query);
        if ($results) {
        //echo $sender;
            $_SESSION['message'] = "Address updated!"; 
            header('location: coe.evaluator.pre.php');
        } else {
            echo "ERROR: Could not be able to execute $query. ".mysqli_error($db);
        }
    }
    
    
}

?>