<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){  
            $equery=mysqli_query($conn,"select * from cims_admin");
            $eres= mysqli_fetch_assoc($equery);
           
        if(isset($_REQUEST['update'])=='edit'){            
            extract($_POST);           
            $adminid= $_REQUEST['adminid'];
            $password=hash('sha512',$pwd);             //echo $password;exit();
            $query=mysqli_query($conn,"update cims_admin set password='$password' where admin_id=$adminid")or die('error.!');
            if($query){                
                echo "<script> window.location.href='dashboard.php'; alert('update sucessfully');</script>";
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
        <h2>Reset password</h2>        
        <form id="form-search" method="post" >    
            <input type="hidden" name="adminid" value="<?php echo $eres['admin_id']; ?>">
            <table>
                <tr><td>New Password</td><td><input type="password" name="pwd" id="pwd"  required=""> </td></tr>                
                <tr><td>Retype Password</td><td><input type="password" name="rpwd" id="rpwd" required="" > </td></tr>                 
            </table> 
            <span id="error" style="color: red"></span><br>
            
            <input type="submit" id="update" name="update" value="edit" onclick="return compareval();"> 
        </form>
        <br>       
    </center>
    </body>
</html>
<script type="text/javascript">
    function compareval(){
        var pass=document.getElementById('pwd').value;
        var repass=document.getElementById('rpwd').value;
        
        if(pass != repass){
            document.getElementById('error').innerHTML='Both password are not same';
            return false;
        }else{
           alert('New password has been updated successfully,you can login with new password ..!!');
            return true;
        }
    }
</script>
