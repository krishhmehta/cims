<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){  
            $equery=mysqli_query($conn,"select * from cims_admin");
            $eres= mysqli_fetch_assoc($equery);
           
        if(isset($_REQUEST['update'])=='edit'){
            $adminid= $_REQUEST['adminid'];
            extract($_POST);
            $query=mysqli_query($conn,"update cims_admin set username='$username',email='$email',mobile='$mobile',question='$question',answer='$answer' where admin_id=$adminid")or die('error.!');
            if($query){
                echo "<script> window.location.href='adminprofile.php'; alert('update sucessfully');</script>";
            }
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
    <center><h2><a href="dashboard.php">back</a></h2>
        <h2>Update main Admin profile</h2>        
        <form id="form-search" method="post" >    
            <input type="hidden" name="adminid" value="<?php echo $eres['admin_id']; ?>">
            <table>
                <tr><td>username</td><td><input type="text" name="username" id="username" value="<?php echo $eres['username']; ?>" required=""> </td></tr>                
                <tr><td>email</td><td><input type="email" name="email" id="email" value="<?php echo $eres['email']; ?>" required=""> </td></tr>
                <tr><td>mobile</td><td><input type="text" name="mobile" id="mobile" value="<?php echo $eres['mobile']; ?>" required=""> </td></tr>
                <tr><td>question</td><td><input type="text" name="question" id="question" value="<?php echo $eres['question']; ?>" required=""> </td></tr>
                <tr><td>answer</td><td><input type="text" name="answer" id="answer" value="<?php echo $eres['answer']; ?>" required=""> </td></tr>
            </table>            
            <input type="submit" id="update" name="update" value="edit">
        </form>
        <br>       
    </center>
    </body>
</html>
