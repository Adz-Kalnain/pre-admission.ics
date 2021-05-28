    
//     <!--SCRIPT for quota options-->
//     <script>
//         $(document).ready(function() {
//           $("#college_dept").change(function(){ 
//               var val = $(this).val();
//               <?php  
//                   $query1 = "SELECT * FROM coursestbl WHERE college_id = '1'";
//                   $result1 = mysqli_query($db, $query1);
//                   $options = "";
//                   while ($row1 = mysqli_fetch_array($result1)){
//                     $options = $options."<option>$row1[1]</option>";
//                   }
//               ?>
//               <?php  
//                   $query2 = "SELECT * FROM coursestbl WHERE college_id = '2'";
//                   $result2 = mysqli_query($db, $query2);
//                   $options2 = "";
//                   while ($row1 = mysqli_fetch_array($result2)){
//                     $options2 = $options2."<option>$row1[1]</option>";
//                   }
//               ?>
//                   if (val == "1") {
//                     $("#course_sel").html("<?php echo $options; ?>");
//                   } else if(val == "2") {
//                     $("#course_sel").html("<?php echo $options2; ?>");
//                   }
              
//           });
//         });
//     </script> 
// <!-- Req Script -->
//     <script>
//         $(document).ready(function() {
//             $("#college_req").change(function(){ 
//                 var val = $(this).val();
//                 //var value = e.options[e.selectedIndex].value;
                
//                 <?php  
//                     //$college_id = "<script>document.write(val);</script>";
//                       $query1 = "SELECT * FROM coursestbl WHERE college_id = '1'";
//                       $result1 = mysqli_query($db, $query1);
//                       $options = "";
//                       while ($row1 = mysqli_fetch_array($result1)){
//                         $options = $options."<option>$row1[1]</option>";
//                       }
//                 ?>
//                   //if (val == "1") {
//                       $("#course_req").html("<?php echo $options; ?>");
//                   //  } else if(val == "2") {
//                   //    $("#course_req").html("<?php echo $options2; ?>");
//                   //  }
                
//             });
//         });     
//     </script>