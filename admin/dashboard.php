<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){        
        if(isset($_REQUEST['logout'])=='true'){            
            unset($_SESSION['adminsess']);
            session_destroy();
        }
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <center>
        <h2>Dashboard</h2><br>
        <h2><a href="adminprofile.php">Admin</a></h2>
        <h2><a href="admin_forgot_pwd.php">forget password</a></h2>
        <h2><a href="student_register.php">Student Reg</a></h2>
        <h2><a href="cources.php">Cources</a></h2>
        <h2><a href="batches.php">Batch</a></h2>
        <h2><a href="subjects.php">Subject</a></h2>
        <h2><a href="teacher.php">Teacher</a></h2>
        <h2><a href="class_teacher.php">Class Teacher Allocation</a></h2>
        <h2><a href="category.php">Category</a></h2>
        <h2><a href="exams.php">Exam</a></h2>
        <form action="" method="post">
            
            <div class="container">              
              <br><br><br>
              <button type="submit" name="logout" value="true">Logout</button><br>             
            </div>            
        </form>
    </center>
    </body>
</html>
