<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "initialsystem";
    $db = new mysqli ($servername, $username, $password, $dbname);

    if ($db->connect_error) {
        die ("Connection failed:".$db->connect_error);
    }
?>
<!--REQUIREMENT-->
<div class="tab-pane fade show active" id="list-requirement" role="tabpanel" aria-labelledby="list-requirement-list">
                  
    <div class="requirement mt-5" id="setting-content-container">
    <h4 class="sett-name mb-5">Requirement
        <?php if (isset($message1)): ?>
            <span class="message" id="message"><?php echo $message1; ?></span>
        <?php endif ?>
        <?php if (isset($message2)): ?>
            <span class="message" id="message"><?php echo $message2; ?></span>
        <?php endif ?>
    </h4>
    <form action="admin.php" method="POST" class="form">
        <label for="gpa">GPA (Grade Point Average)</label>
        <input type="number" name="gpa" class="form-control  mb-3" required>
        <label for="cet">CET Score (College Entrance Test)</label>
        <input type="number" name="cet" class="form-control" required>
        <div class="row">
            <div class="col-6">
                <label class="control-label mt-3" for="college">Select College:</label>
                <select class="form-control input-sm" name="college" id="college_req" required onchange="course_reqChange()" >
                    <option value="empty"disabled selected>Select a college</option>
                    <option value="ics" name="ics-college">ics</option>
                    <option value="coe" name="coe-college">coe</option>
                </select>
            </div>
            <div class="col-6">
                <label class="control-label mt-3" for="course">Select Course:</label>
                <select class="form-control input-sm" name="course" id="course_req" required>
                    <option value=""disbaled selected>Select a course</option> 
                </select>
            </div>
            <input type="submit" class="btn mt-3" name="submit" value="submit" id="allSettingButtons">
        </div>
    </form>
    </div>
    
</div>
                
<!--COURSES-->
<div class="tab-pane fade" id="list-course" role="tabpanel" aria-labelledby="list-course-list">
    
    <div class="course mt-5" id="setting-content-container">
    <h4 class="sett-name mb-2">Course
        <?php if (isset($course_message1)): ?>
            <span class="message" id="message"><?php echo $course_message1; ?></span>
        <?php endif ?>
        <?php if (isset($course_message2)): ?>
            <span class="message" id="message"><?php echo $course_message2; ?></span>
        <?php endif ?>
    </h4>
    <form action="admin.php" method="post" class="form">
        <div class="row">
            <div class="col-md-6">
            <label for="courseName">Course Name:</label>
            <input type="text" name="courseName" class="form-control  mb-3" required>
            </div>
            <div class="col-md-6">
            <label for="courseMajor">Course Major:</label>
            <input type="text" name="courseMajor" class="form-control  mb-3" required>
            </div>
        </div>
        <label for="courseDescription">Course Description</label>
        <textarea class="form-control" name="courseDescription" id="" cols="20" rows="5" required></textarea>
        <label class="control-label mt-3" for="college">For College Of:</label>
        <select class="form-control input-sm" name="college" id="college" required>
            <option value="ics">Institute of Computer Studies</option>
            <option value="coe">College of Engineering</option> 
        </select>
        <input type="submit" class="btn mt-3" name="courseSubmit" value="submit" id="allSettingButtons">
        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#courseModal" id="allSettingButtons">View all created courses here</button>
    </form>
</div>

<!--MODAL COURSES-->
<div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="courseModalTitle">Courses and Descriptions</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                <table class="table table-sm table-striped table-bordered table-hover" id="#printable-table">
                    <thead class="thead">
                    <?php $course_results = mysqli_query($db, "SELECT * FROM coursestbl"); ?>
                        <tr class="bg-danger" style="color: white;">
                            <th>Course Name</th>
                            <th>Course Major</th>
                            <th>Course Description</th>
                            <th>College</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="tbody">
                        <?php while ($row = mysqli_fetch_array($course_results)) { ?>
                        <tr>
                            <td><?php echo $row['course_name']; ?></td>
                            <td><?php echo $row['coursemajor'] ?></td>
                            <td><?php echo $row['course_description']; ?></td>
                            <td><?php echo $row['college']; ?></td>
                            <td>
                            <a class="btnDelete" href="delete.php?course_id=<?php echo $row['course_id']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                </table>
                </div>
            </div>
            <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal" id="allSettingButtons">Close</button>
            </div>
        </div>
        </div>
    </div>
</div>

<!--ADMISSION-->
<div class="tab-pane fade" id="list-admission" role="tabpanel" aria-labelledby="list-admission-list">
    <div class="admission mt-5" id="setting-content-container">
        <h4 class="sett-name mb-5">Admission Date
        <?php if (isset($admission_message1)): ?>
            <span class="message" id="message"><?php echo $admission_message1; ?></span>
        <?php endif ?>
        <?php if (isset($admission_message2)): ?>
            <span class="message" id="message"><?php echo $admission_message2; ?></span>
        <?php endif ?>
        </h4>
        <form action="admin.php" method="POST" class="form">
        <label for="startingdate">Set the starting date of Admission :</label>
        <input type="date" name="startingdate" class="form-control mb-3" required>
        <label for="endingdate">Set the End date of Admission :</label>
        <input type="date" name="endingdate" class="form-control mb-3" required>
        <label for="schoolyear">School Year:</label>
        <input type="text" class="form-control mb-3" name="schoolyear" required>
        
        <input type="submit" class="btn mt-3" name="admissionSubmit" value="submit" id="allSettingButtons">
    </form>
    </div>
</div>
                
<!--QUOTA-->
<div class="tab-pane fade" id="list-quota" role="tabpanel" aria-labelledby="list-course-list">
    <div class="quota mt-5" id="setting-content-container">
    <h4 class="sett-name mb-5">Quota
        <?php if (isset($quota_message1)): ?>
            <span class="message" id="message"><?php echo $quota_message1; ?></span>
        <?php endif ?>
        <?php if (isset($quota_message2)): ?>
            <span class="message" id="message"><?php echo $quota_message2; ?></span>
        <?php endif ?>
    </h4>
    <form action="admin.php" method="POST" class="form">
        <div class="row">
            <div class="col-6">
                <label class="control-label mt-3" for="college_dept">Select College:</label>
                <select class="form-control input-sm" name="college_dept" id="college_dept" onchange="courseChange()" required>
                    <option value="empty"disabled selected>Select a college</option>
                    <option value="ics" name="ics-college">ics</option>
                    <option value="coe" name="coe-college">coe</option>
                </select>
            </div>
            <div class="col-6">
                <label class="control-label mt-3" for="course_sel">Select Course:</label>
                <select class="form-control input-sm" name="course_sel" id="course_sel" required>
                    <option value="" disbaled selected>Select a course</option> 
                </select>
            </div>
        </div>
        
        <label for="quotaInput" class="control-label mt-3">Input quota for the selected course:</label>
        <input type="number" name="quotaInput" value="quota" class="form-control" required>

        <input type="submit" class="btn mt-3" name="quotaSubmit" value="submit" id="allSettingButtons">
    </form>
    </div>
</div>
                
<!--SCHEDULE-->
<div class="tab-pane fade" id="list-schedule" role="tabpanel" aria-labelledby="list-schedule-list">
    <div class="schedule mt-5" id="setting-content-container">
    <h4 class="sett-name mb-2 mt-4">Schedule
    <?php if (isset($sched_message1)): ?>
    <span class="message" id="message"><?php echo $sched_message1; ?></span>
    <?php endif ?>
    <?php if (isset($sched_message2)): ?>
    <span class="message" id="message"><?php echo $sched_message2; ?></span>
    <?php endif ?>
    <?php if (isset($sched_message3)): ?>
    <span class="message" id="message"><?php echo $sched_message3; ?></span>
    <?php endif ?>
    </h4>
    <form action="admin.php" method="POST" name="interviewSched">
        <label for="setInterviewer">Set Interviewer Name</label>
        <input type="text" name="setInterviewer" class="form-control">
        <label for="setScheddate">Set Interview Date</label>
        <input type="date" name="setScheddate" class="form-control" required>
        <label for="setSchedTimeFrom">Set Interview Time From:</label>
        <input type="time" name="setSchedTimeFrom" class="form-control" required>
        <label for="setSchedTimeTo">Set Interview Time To:</label>
        <input type="time" name="setSchedTimeTo" class="form-control" required>
        <label class="control-label mt-3" for="college">For College Of:</label>
        <select class="form-control input-sm" name="college" id="college" required>
        <option value="ics">Institute of Computer Studies</option>
        <option value="coe">College of Engineering</option> 
        </select>
        
        <input type="submit" class="btn mt-3" name="schedSubmit" value="submit" id="allSettingButtons">
        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#scheduleModal" id="allSettingButtons">View all created schedules here</button>
    </form>

    </div>
    <!--SCHEDULE MODAL-->
    <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalTitle">Schedules and Interviewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table class="table table-sm table-striped table-bordered table-hover">
                        <thead class="thead">
                        <?php $results = mysqli_query($db, "SELECT * FROM interviewertbl"); ?>
                            <tr class="bg-danger" style="color: white;">
                                <th>Interviewer</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="tbody">
                            <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td><?php echo $row['ic_name']; ?></td>
                                <td><?php echo $row['ic_date']; ?></td>
                                <td><?php echo $row['ic_timefrom']; ?> -- <?php echo $row['ic_timeto']; ?></td>
                                <td>
                                <a class="btnDelete" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                    </table>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" id="allSettingButtons">Close</button>
                </div>
            </div>
            </div>
    </div>

</div>
                
<!--CREATE ACCOUNT-->
<div class="tab-pane fade" id="list-account" role="tabpanel" aria-labelledby="list-account-list">
    <div class="schedule mt-5" id="setting-content-container">
        <h4 class="sett-name mb-2 mt-4">Create Account
        <?php if (isset($account_message1)): ?>
        <span class="message" id="message"><?php echo $account_message1; ?></span>
        <?php endif ?>
        <?php if (isset($account_message2)): ?>
        <span class="warning" id="warning"><?php echo $account_message2; ?></span>
        <?php endif ?>
        </h4>
        <form action="admin.php" method="POST" name="createAccount">
            <div class="row">
            <div class="col-6">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Full Name" required>
            </div>
            <div class="col-6">
                <label for="username" class="form-label">Username</label>
                <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
                <input type="text" class="form-control mb-3" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                <?php if (isset($name_error)): ?>
                <span><?php echo $name_error; ?></span>
                <?php endif ?>
                </div>
            </div>
            
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
                <input type="email" class="form-control mb-3" id="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>" required>
                <?php if (isset($email_error)): ?>
                <span><?php echo $email_error; ?></span>
                <?php endif ?>
                </div>
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <div class="col-6">
                <label class="control-label mt-3" for="college">College:</label>
                <select class="form-control input-sm mb-3" name="college" id="college" required>
                <option value="ics">Institute of Computer Studies</option>
                <option value="coe">College of Engineering</option> 
                </select>
            </div>

            <div class="col-6">
                <label class="control-label mt-3" for="role">Role:</label>
                <select class="form-control input-sm" name="role" id="role">
                <option value="admin">Administrator</option>
                <option value="ao">Admission Officer</option>
                <option value="evaluator">Evaluator</option>
                <option value="ic">Interviewer</option> 
                </select>
            </div>
            
            <div class="col-12">
                <input type="submit" class="btn mt-3" name="accountSubmit" value="submit" id="allSettingButtons">
            </div>
            
            </div>
        </form>
        
            
    </div>
</div>
