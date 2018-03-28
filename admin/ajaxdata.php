<?php include("connection.php");   
//echo "val=".$_POST['val'];echo "batchval = ".$_POST['batchval'];exit();
// cource data CRUD
if(isset($_POST['val'])=="cource"){
    extract($_POST);
    if((isset($_POST['code']) && !empty($_POST['code'])) && (isset($_POST['cource']) && !empty($_POST['cource']))&& (isset($_POST['tot_att']) && !empty($_POST['tot_att']))
             && (isset($_POST['wdays']) && !empty($_POST['wdays'])) ){
        $query= mysqli_query($conn, "insert into cims_cources(cource_code,cource_name,total_attandance_per,total_working_days)values('$code','$cource','$tot_att','$wdays')")or die('error');  //mysqli_error($conn);
    }else{
            echo '<h2 style="color:red"> All Fields are required..!!</h2>';
    }    
    //if($query){ ?>
        <table border="1">
            <tr>
                <td>cource_code</td>
                <td>cource name</td>
                <td>total_attandance_per</td>
                <td>total_working_days</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_cources");
                while($res=mysqli_fetch_assoc($query)){
            ?>
                <tr>
                    <td><?php echo $res['cource_code']; ?></td>
                    <td><?php echo $res['cource_name']; ?></td>
                    <td><?php echo $res['total_attandance_per']; ?></td>
                    <td><?php echo $res['total_working_days']; ?></td>
                    <td><a href="cources.php?actid=<?php echo $res['cource_id'] ?>">Active</a>
                        <a href="cources.php?dactid=<?php echo $res['cource_id'] ?>">Deactive</a>
                        <a href="cources_edit.php?eid=<?php echo $res['cource_id'] ?>">Edit</a>
                        <a href="cources.php?did=<?php echo $res['cource_id'] ?>">Delete</a>
                    </td>
                </tr>            
            <?php } ?>
        </table>
<?php  //} 
} 


//batch data CRUD 
if(isset($_POST['batchval'])=="batch"){
    extract($_POST);
    //&& (isset($_POST['yearduration']) && !empty($_POST['yearduration']))
    if((isset($_POST['courceid']) && !empty($_POST['courceid'])) && (isset($_POST['time']) && !empty($_POST['time']))&& (isset($_POST['total_seat']) && !empty($_POST['total_seat'])) && (isset($_POST['startdate']) && !empty($_POST['startdate'])) && (isset($_POST['enddate']) && !empty($_POST['enddate']))
              && (isset($_POST['monduration']) && !empty($_POST['monduration'])) && (isset($_POST['fees']) && !empty($_POST['fees']))){
        $yearduration=$_POST['yearduration'];
        $monduration=$_POST['monduration'];
        $duration=$yearduration.'.'.$monduration;
        $query= mysqli_query($conn, "insert into cims_batches(cource_id,time,session,total_seat,startdate,enddate,duration,fees)"
            . "values('$courceid','$time','$session','$total_seat','$startdate','$enddate','$duration','$fees')")or die('error');  //mysqli_error($conn);
    } else{
            echo '<h2 style="color:red"> All Fields are required..!!</h2>';
    }
    
    //if($query){ ?>
    <table border="1">
            <tr>
                <td>cource</td>
                <td>time</td>
                <td>session</td>
                <td>total_seat</td>
                <td>startdate</td>
                <td>enddate</td>
                <td>duration</td>
                <td>fees</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_batches");
                while($res=mysqli_fetch_assoc($query)){
                    $cource_id=$res['cource_id'];
                    $query1=mysqli_query($conn,"select * from cims_cources where cource_id='$cource_id'");
                    $res1= mysqli_fetch_assoc($query1); 
            ?>
                <tr>
                     <td><?php echo $res1['cource_name']; ?></td>
                    <td><?php echo $res['time']; ?></td>
                    <td><?php echo $res['session']; ?></td>
                    <td><?php echo $res['total_seat']; ?></td>
                    <td><?php echo $res['startdate']; ?></td>
                    <td><?php echo $res['enddate']; ?></td>
                    <td><?php echo $res['duration']; ?></td>
                    <td><?php echo $res['fees']; ?></td>
                    <td><a href="batches.php?actid=<?php echo $res['batch_time_id'] ?>">Active</a>
                        <a href="batches.php?dactid=<?php echo $res['batch_time_id'] ?>">Deactive</a>
                        <a href="batches_edit.php?eid=<?php echo $res['batch_time_id'] ?>">Edit</a>
                        <a href="batches.php?did=<?php echo $res['batch_time_id'] ?>">Delete</a>
                    </td>
                </tr>            
            <?php } ?>
        </table>        
    <?php //} 
    
}


//Subject data CRUD
if(isset($_POST['subval'])=="subject"){
    extract($_POST);
    if((isset($_POST['courceid']) && !empty($_POST['courceid'])) && (isset($_POST['subject_name']) && !empty($_POST['subject_name'])) ){
        $query= mysqli_query($conn, "insert into cims_subjects(cource_id ,subject_name)values('$courceid','$subject_name')")or die('error');  //mysqli_error($conn);
    } else {
        echo '<h2 style="color:red"> All Fields are required..!!</h2>';
    }       
    //if($query){ ?>
        <table border="1">
            <tr>
                <td>cource name</td>
                <td>Subject name</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_subjects");
                while($res=mysqli_fetch_assoc($query)){
                     $cource_id=$res['cource_id'];
                    $query1=mysqli_query($conn,"select * from cims_cources where cource_id='$cource_id'");
                    $res1= mysqli_fetch_assoc($query1);    
            ?>
                <tr>
                    <td><?php echo $res1['cource_name']; ?></td>
                    <td><?php echo $res['subject_name']; ?></td>
                    <td><a href="subjects_edit.php?eid=<?php echo $res['subject_id'] ?>">Edit</a>
                        <a href="subjects.php?did=<?php echo $res['subject_id'] ?>">Delete</a></td>
                </tr>            
            <?php } ?>
        </table>

    <?php //}
}
    
    //Subject data CRUD
if(isset($_POST['teacherval'])=="teacher"){
    extract($_POST);
    if(isset($_POST['name']) && !empty($_POST['name'])){
        $query= mysqli_query($conn, "insert into cims_teacher(name)values('$name')")or die('error');  //mysqli_error($conn);
    } else {
        echo '<h2 style="color:red"> All Fields are required..!!</h2>';
    }    
    //if($query){ ?>
        <table border="1">
            <tr>
                <td>Teacher name</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_teacher");
                while($res=mysqli_fetch_assoc($query)){                      
            ?>
                <tr>
                    <td><?php echo $res['name']; ?></td>
                    <td><?php echo $res['status']; ?></td>
                    <td><a href="teacher.php?actid=<?php echo $res['teacher_id'] ?>">Active</a>
                        <a href="teacher.php?dactid=<?php echo $res['teacher_id'] ?>">Deactive</a>
                        <a href="teacher_edit.php?eid=<?php echo $res['teacher_id'] ?>">Edit</a>
                        <a href="teacher.php?did=<?php echo $res['teacher_id'] ?>">Delete</a>
                    </td>
                </tr>            
            <?php } ?>
        </table>
    <?php //}
    }
    
    //get batchdata from cource
    if(isset($_POST['cource_id']) && !empty($_POST['cource_id'])){
        $cource_id=$_POST['cource_id'];
        $query=mysqli_query($conn,"select * from cims_batches where cource_id=$cource_id and status='Active' order by batch_time_id asc");
        if(mysqli_num_rows($query)>0){ 
            while($res=mysqli_fetch_assoc($query)){?>
                <option value="<?php echo $res['batch_time_id']; ?>"><?php echo $res['time'].' - '.$res['session']; ?></option>            
            <?php }             
            }else{
                echo '<option value="">No Batch data</option>';
            }
    }
    
    //Class teacher allocation
    if(isset($_POST['classteacherval'])=='classteacher'){
        extract($_POST);
        if((isset($_POST['cource']) && !empty($_POST['cource'])) && (isset($_POST['batch']) && !empty($_POST['batch'])) && (isset($_POST['teacherid']) && !empty($_POST['teacherid']))){
            $query= mysqli_query($conn, "insert into cims_class_teacher(cource_id,batch_time_id,faculty_id)values('$cource','$batch','$teacherid')")or die('error');  //mysqli_error($conn);
        }else{
            echo '<h2 style="color:red"> All Fields are required..!!</h2>';
        }
        //if($query){ ?>
             <table border="1">
            <tr>
                <td>course</td>
                <td>Batch</td>
                <td>Teacher</td>                
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_class_teacher");
                while($res=mysqli_fetch_assoc($query)){
                    $batch_time_id=$res['batch_time_id'];       $cource_id=$res['cource_id'];
                    $query1=mysqli_query($conn,"select c.cource_id,c.cource_name,b.batch_time_id,b.time from cims_batches b ,cims_cources c where b.batch_time_id='$batch_time_id' and c.cource_id='$cource_id'");
                    $res1= mysqli_fetch_assoc($query1);                   // print_r($res1);exit();
            ?>
                <tr>
                    <td><?php echo $res1['cource_name']; ?></td>
                    <td><?php echo $res1['time']; ?></td>
                    <td><?php $teacherid=$res['faculty_id']; $teacher_query=mysqli_query($conn,"select * from cims_teacher where teacher_id=$teacherid"); 
                                $tres1= mysqli_fetch_assoc($teacher_query);
                    echo $tres1['name']; ?></td>                   
                     <td>
                        <a href="class_teacher_edit.php?eid=<?php echo $res['class_teacher_id'] ?>">Edit</a>
                        <a href="class_teacher.php?did=<?php echo $res['class_teacher_id'] ?>">Delete</a>
                    </td>
                </tr>            
            <?php } ?>
        </table>
        <?php //}
        
    }
    
//Category data CRUD
    if(isset($_POST['catval'])=="category"){
        extract($_POST);
        if(isset($_POST['category_name']) && !empty($_POST['category_name'])){
            $query= mysqli_query($conn, "insert into cims_category(category_name)values('$category_name')")or die('error');  //mysqli_error($conn);
        } else {
            echo '<h2 style="color:red"> All Fields are required..!!</h2>';
        }   ?>
        <table border="1">
            <tr>
                <td>Category name</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_category");
                while($res=mysqli_fetch_assoc($query)){  ?>
                <tr>
                    <td><?php echo $res['category_name']; ?></td>                    
                    <td>
                        <a href="category_edit.php?eid=<?php echo $res['category_id'] ?>">Edit</a>
                        <a href="category.php?did=<?php echo $res['category_id'] ?>">Delete</a>
                    </td>
                </tr>            
            <?php } ?>
        </table>
    <?php 
}

//Exam data CRUD
    if(isset($_POST['examval'])=="exam"){
        extract($_POST);
        if(isset($_POST['exam_name']) && !empty($_POST['exam_name'])){
            $query= mysqli_query($conn, "insert into cims_exams(exam_name)values('$exam_name')")or die('error');  //mysqli_error($conn);
        } else {
            echo '<h2 style="color:red"> All Fields are required..!!</h2>';
        }   ?>
        <table border="1">
            <tr>
                <td>Exam name</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_exams");
                while($res=mysqli_fetch_assoc($query)){  ?>
                <tr>
                    <td><?php echo $res['exam_name']; ?></td>                    
                    <td>
                        <a href="exams_edit.php?eid=<?php echo $res['category_id'] ?>">Edit</a>
                        <a href="exams.php?did=<?php echo $res['category_id'] ?>">Delete</a>
                    </td>
                </tr>            
            <?php } ?>
        </table>
    <?php 
}
    //forget passeord - question answer
        if(isset($_POST['ans']) && !empty($_POST['ans'])) {
            $adminid= $_POST['adminid'];
            $answer=$_POST['ans'];
            $query=mysqli_query($conn,"select * from cims_admin where admin_id=$adminid and answer='$answer'")or die('error.!');
            if(mysqli_num_rows($query)>0){ 
                $res=mysqli_fetch_assoc($query);
                ?>
                <form method="post" action="">
                    <input type="hidden" name="adminid" id="adminid" value="<?php echo $adminid; ?>">
                <table>
                    <tr><td>Email : </td><td><input type="email" name="sendemail" id="sendemails" required=""> </td></tr>                
                    <tr>
                        <td>Submit</td>
                        <td>
                    <input type="submit" name="forgot_pass" id="forgot_pass" value="submit">
                        </td></tr> 
                </table>  </form>           
            <?php }else{
                echo 'wrong answer';
            }
        }
        
    //Student register
    if(isset($_POST['studreg'])=='studentreg'){
        extract($_POST);
        $file = $_FILES["photo"]["type"];
        echo $file;exit();
        if((isset($_POST['firstname']) && !empty($_POST['firstname'])) && (isset($_POST['lastname']) && !empty($_POST['lastname'])) && (isset($_POST['pwd']) && !empty($_POST['pwd'])) && 
                (isset($_POST['mobile']) && !empty($_POST['mobile'])) && (isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['gender']) && !empty($_POST['gender'])) &&
                (isset($_POST['dob']) && !empty($_POST['dob'])) && (isset($_POST['category_id']) && !empty($_POST['category_id']))&& (isset($_POST['cource']) && !empty($_POST['cource']))
                && (isset($_POST['batch']) && !empty($_POST['batch']))&& (isset($_POST['question']) && !empty($_POST['question']))&& (isset($_POST['answer']) && !empty($_POST['answer']))){
            
            $enrollment_no=$_POST['enrollno'];  
            $pwd=$_POST['pwd'];
            $password=hash('sha512',$pwd);
            $regdate=date('Y-m-d');
            echo $_POST['photo'];
            $fn=$_FILES[$photo]['name'];
            //$query= mysqli_query($conn, "insert into cims_students(enrollment_no,firstname,lastname,password,mobile,email,gender,photo,dob,register_date,category_id,cource_id,batch_time_id,question,answer"
            //. ")values('$enrollment_no','$firstname','$lastname','$password','$mobile','$email','$gender','$fn','$dob','$regdate','$category_id','$cource','$batch','$question','$answer')")or die('error');  //mysqli_error($conn);
        
                echo 'student registered succeessfully..!!';
            
            }else{
            echo '<h2 style="color:red"> All Fields are required..!!</h2>';
        }        
    }
    
    //get state data from country
    if(isset($_POST['country_id']) && !empty($_POST['country_id'])){
        $country_id=$_POST['country_id'];
        $query=mysqli_query($conn,"select * from cims_states where country_id=$country_id order by name asc");
        if(mysqli_num_rows($query)>0){ 
            while($res=mysqli_fetch_assoc($query)){?>
                <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>            
            <?php }             
            }else{
                echo '<option value="">No state data</option>';
            }
    }
    
    //get state data from state
    if(isset($_POST['state_id']) && !empty($_POST['state_id'])){
        $state_id=$_POST['state_id'];
        $query=mysqli_query($conn,"select * from cims_cities where state_id=$state_id order by name asc");
        if(mysqli_num_rows($query)>0){ 
            while($res=mysqli_fetch_assoc($query)){?>
                <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>            
            <?php }             
            }else{
                echo '<option value="">No city data</option>';
            }
    }
    
    //student address register
    if(isset($_POST['studadd'])=='studentadd'){
        extract($_POST);        
        if((isset($_POST['permanent_address']) && !empty($_POST['permanent_address'])) && (isset($_POST['present_address']) && !empty($_POST['present_address']))&& 
                (isset($_POST['country']) && !empty($_POST['country'])) && (isset($_POST['state']) && !empty($_POST['state'])) && (isset($_POST['city']) && !empty($_POST['city'])) 
            ){ 
            $query= mysqli_query($conn, "insert into cims_student_address(student_id,permanent_address,present_address,city,state,country,zipcode"
            . ")values('$studentid','$permanent_address','$present_address','$city','$state','$country','$zipcode')")or die('error');  //mysqli_error($conn);
        
    //header("location:student_register");
                echo "<script> window.location.href='student_register.php'; alert('Student registration inserted..!!');</script>";
            
            }else{
                echo '<h2 style="color:red"> All Fields are required..!!</h2>';
            }        
    }


?>