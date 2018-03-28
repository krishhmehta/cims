<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
                
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){  
        $equery=mysqli_query($conn,"select * from cims_admin");
        $eres= mysqli_fetch_assoc($equery);
            
        if(isset($_REQUEST['forgot_pass'])){
            $sendemail = $_REQUEST['sendemail'];
            $adminid=$_REQUEST['adminid'];
            $emailquery=mysqli_query($conn,"select * from cims_admin where admin_id=$adminid and email='$sendemail'")or die('error.!');
            if(mysqli_num_rows($emailquery)>0){
                //send mail
                //Load Composer's autoloader
                require '../library/src/Exception.php';
                require '../library/src/PHPMailer.php';
                require '../library/src/SMTP.php';
                
                $mail = new PHPMailer;                        // Passing `true` enables exceptions
                try {
                    $mail->setFrom('krishnamehta.scientia@gmail.com', 'Your Name');
                    $mail->addAddress($sendemail, 'My Friend');
                    $mail->Subject  = 'First PHPMailer Message';
                    $mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer.';
                    if(!$mail->send()) {
                      echo 'Message was not sent.';
                      echo 'Mailer error: ' . $mail->ErrorInfo;
                    } else {
                      echo 'Message has been sent.';
                    }
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
                
            }else{
                echo "<script> window.location.href='admin_forgot_pwd.php'; alert('Email not sent');</script>";exit();
            }
        }
            
        if(isset($_REQUEST['update'])=='edit'){            
            extract($_POST);           
            $adminid= $_REQUEST['adminid'];
            $query=mysqli_query($conn,"select * from cims_admin where admin_id=$adminid and answer='$answer'")or die('error.!');
            print_r($query);exit();
            if(mysqli_num_rows($query)>0){
                echo "<script> window.location.href='admin_reset_password'; alert('update sucessfully');</script>";
            } else {
                echo "<script> window.location.href='admin_forgot_pwd.php'; alert('answer is wrong');</script>";
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
            <input type="hidden" name="adminid" id="adminid" value="<?php echo $eres['admin_id']; ?>">
            
            <table>
                <tr><td>Question</td><td><input type="text" name="pwd" id="pwd" value="<?php echo $eres['question']; ?>" readonly=""> </td></tr>                
                <tr><td>Answer</td><td><input type="text" name="answer" id="answer" required="" > </td></tr>    
                
            </table> 
            <span id="error" style="color: red"></span><br>            
             <input type="button" id="button" value="add">
        </form>
        <br>  
        <div id="result">
            
        </div>
        
    </center>
    </body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#button").click(function(){
            var ans=$("#answer").val();
            var adminid=$("#adminid").val();             
            
            $.ajax({
                data:{ans:ans,adminid:adminid},
                type:'post',
                url:'ajaxdata.php',
                success:function(msg){
                    $("#result").html(msg);
                }
            });
        });       
        
    });
</script>
