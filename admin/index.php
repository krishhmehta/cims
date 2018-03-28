<?php
    include("connection.php");
    if(isset($_REQUEST['login'])=='true'){
        extract($_POST);
        //$password=hash('sha512',$pwd);
        $query=mysqli_query($conn,"select * from cims_admin where username='$uname' and password='$pwd' ")or die('error');        
        if(mysqli_num_rows($query)>0){
            $res= mysqli_fetch_array($query);                   //echo "<pre>";print_r($res);exit();            session_start();
            $_SESSION['adminsess']=$res['username'];           // echo $_SESSION['adminsess'];exit();
            header('Location:dashboard.php ');
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
        <form action="" method="post">
            <div class="imgcontainer">
                <img src="../images/logo.jpg" alt="Avatar" class="avatar" height="10%" width="10%">
            </div>
            <br>
            <div class="container">
              <label for="uname"><b>Username</b></label>
              <input type="text" name="uname" id="uname" placeholder="Enter Username"  required>
              <br>
              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="pwd" id="pwd" required>
              <br><br><br>
              <button type="submit" name="login" value="true">Login</button><br>
<!--              <button type="submit" name="signup" value="true">Sign up</button><br>-->
             
            </div>
            
            <div  style="background-color:#f1f1f1">              
              <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </center>
    </body>
</html>
