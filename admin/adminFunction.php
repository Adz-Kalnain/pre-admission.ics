
<?php 
 include('../db.php');
 include('../session.php');

                        if (isset($_POST['accept'])) {
                            $userID= $_POST['userID'];
                          
                          
                            $action = 'VERIFIED';
 

                                $query = "UPDATE selectedcourse SET userStatus='$action'  WHERE user_id='$userID'";
                                $results = mysqli_query($db, $query);
                                    //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                    if ($results) {
                                    //echo $sender;
                                       $_SESSION['message'] = "Address updated!";
                                     
                                        header('location: admin.main.php');
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }


                            else if  (isset($_POST['reject'])) {
                                $userID= $_POST['userID'];
                          
                          
                                $action = 'REJECT';
     
    
                                    $query = "UPDATE selectedcourse SET userStatus='$action'  WHERE user_id='$userID'";
                                    $results = mysqli_query($db, $query);
                                        //yung md5 for encryption yan, pero dih na ata possible yung feature na reset password pang gagamit tayo md5, pero oknayan atleast encrypted. 
                                        if ($results) {
                                        //echo $sender;
                                            $_SESSION['message'] = "Address updated!"; 
                                            header('location: admin.main.php');
                                        } else {
                                            echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                        }
                                    //exit();
                                

                            }

 ?>