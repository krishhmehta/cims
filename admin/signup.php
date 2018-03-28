<?php
    include("connection.php");   
    if(isset($_REQUEST['signup'])=='true'){
        extract($_POST);
        $password=hash('sha512',$pwd);
        $query= mysqli_query($conn, "insert into cims_admin(username,password,email,mobile,question,answer)values('$uname','$password','$email','$mobile','$question','$answer')")or mysqli_error($conn);
        if($query==1){
            header('Location:index.php ');
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
              
              <label for="user"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="uname" id="uname" required>
              <br>
              <label for="pass"><b>Password</b></label>
              <input type="text" placeholder="Enter Password" name="pwd" id="pwd" required>
              <br>
              <label for="psw"><b>email</b></label>
              <input type="email" placeholder="Enter email" name="email" id="email" required>
              <br>
              <label for="mobile"><b>mobile</b></label>
              <input type="text" placeholder="Enter mobile" name="mobile" id="mobile" required>
              <br>
              <label for="psw"><b>question</b></label>
              <input type="text" placeholder="Enter question" name="question" id="question" required>
              <br>
              <label for="psw"><b>Answer</b></label>
              <input type="text" placeholder="Enter answer" name="answer" id="answer" required>
              <br><br><br>              
              <button type="submit" name="signup" value="true">Sign up</button><br>             
            </div>
            
        </form>
    </center>
    </body>
</html>
