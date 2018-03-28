<?php
    require_once '../twilio-php/vendor/autoload.php'; // Loads the library
    use Twilio\Rest\Client;

    include("connection.php");       
    if(isset($_REQUEST['signup'])=='true'){
        
        $query= mysqli_query($conn, "select * from cims_students order by student_id desc limit 1")or die("error");
        if(mysqli_num_rows($query)>0){                 
            $res=mysqli_fetch_assoc($query);
            $lastno=$res['enrollment_no'];
            $no=$lastno+1;
            $numbers = generate_numbers($no, 1, 10);                    
        }else{
            $numbers = generate_numbers(0000000001, 1, 10);
        } 
        //echo $numbers;exit();
                
        extract($_POST);;
        $dt = date('Y-m-d', strtotime($dob));        //echo $dt;exit();
        
        $filename = $_FILES["photo"]["name"];
        $path="../images/";
        $rpath=$path.$filename;

        $tmpfilename=$_FILES["photo"]["tmp_name"];
        move_uploaded_file($tmpfilename,$rpath);            //echo $file;exit();
        $enrollment_no=$_POST['enrollno'];  
        $pwd=$_POST['pwd'];
        $password=hash('sha512',$pwd);
        $regdate=date('Y-m-d');
                
        $query= mysqli_query($conn, "insert into cims_students(enrollment_no,firstname,lastname,password,mobile,email,gender,photo,dob,register_date,category_id,cource_id,batch_time_id,question,answer"
        . ")values('$numbers','$firstname','$lastname','$password','$mobile','$email','$gender','$filename','$dob','$regdate','$category_id','$cource','$batch','$question','$answer')")or die('error');  //mysqli_error($conn);
  
        if($query){
            $lastid=mysqli_insert_id($conn);
            $squery= mysqli_query($conn, "select * from cims_students where student_id=$lastid")or die("error");
            if(mysqli_num_rows($squery)>0){                 
                $sres=mysqli_fetch_assoc($squery);
                $username=$sres['enrollment_no'];
                $password=$sres['password'];                
            }
            //send sms logic   
            // Your Account Sid and Auth Token from twilio.com/user/account
            $sid = "AC4867154eb3877022fdd12921d57ca41c";
            $token = "63c01c290a13c7652cf255a7d400513d";
            $client = new Client($sid, $token);
            $val=$client->messages
                ->create(
                    "+919408267404",
                    array(
                        "from" => "+16182484689",
                        "body" => "Scientia login credentials : \n username:".$username."\n password:".$password,
                    )
                );

            echo "<script> window.location.href='student_address.php?val=$lastid'; alert('Student registered sucessfully..!!');</script>";
        }else{
            echo "<script> window.location.href='student_register.php'; alert('Student registration failed..!!');</script>";
        }
        //var_dump($val);exit();
    }
?>
<?php
    function generate_numbers($start, $count, $digits) {
       //$result = array();
       for ($n = $start; $n < $start + $count; $n++) {
          $result = str_pad($n, $digits, "0", STR_PAD_LEFT);                     
       }
       return $result;
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
        <h2><a href="dashboard.php">back</a></h2>
        <form id="form-search" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="studreg" value="studentreg">
           
            <div class="container">
                 <input type="hidden" name="enrollno" value="<?php echo $numbers; ?>">
              <label for="user"><b>firstname</b></label>
              <input type="text" placeholder="Enter firstname" name="firstname" id="firstname" required="">
              <br>
              <label for="user"><b>lastname</b></label>
              <input type="text" placeholder="Enter lastname" name="lastname" id="lastname" required="">
              <br>
              <label for="pass"><b>Password</b></label>
              <input type="text" placeholder="Enter Password" name="pwd" id="pwd" required="">
              <br>
              <label for="mobile"><b>mobile</b></label>
              <input type="text" placeholder="Enter mobile" name="mobile" id="mobile" required="">
              <br>
              <label for="psw"><b>email</b></label>
              <input type="email" placeholder="Enter email" name="email" id="email" required="">
              <br>
              <label for="user"><b>gender</b></label>
                <select name="gender" id="gender" required="">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select><br>
              <label for="user"><b>photo</b></label>
              <input type="file" placeholder="Enter photo" name="photo" id="photo" required="">
              <img id="blah" src="#" alt="your image" width="100px" height="100px"/>
              <br>
              <label for="user"><b>dob</b></label>
              <input type="date" placeholder="Enter dob" name="dob" id="dob" required="">
              <br>
              <label for="user"><b>category_id</b></label>
              <select name="category_id" id="category_id" required="">
                    <option value="General">General</option>
                    <option value="Obc">Obc</option>
                    <option value="Sc">Sc</option>
                    <option value="St">St</option>
                    <option value="Other">Other</option>
                </select>
              <br>
              <label for="user"><b>cource</b></label>
             <select name="cource" id="cource" required="">
                            <option value="0" disabled="" selected="">Select cource</option>
                            <?php $query= mysqli_query($conn, "select * from cims_cources where status='Active'");

                             while($res=mysqli_fetch_assoc($query)){?>
                            <option value="<?php echo $res['cource_id']; ?>"><?php echo $res['cource_code'].' - '.$res['cource_name']; ?></option>
                            <?php } ?>
                        </select>
              <br>
              <label for="user"><b>Batch</b></label>
              <select name="batch" id="batch" required="">
                    <option value="" >Select cource first</option>
                </select>
              <br>
              
              
              <label for="psw"><b>question</b></label>
              <input type="text" placeholder="Enter question" name="question" id="question" required="">
              <br>
              <label for="psw"><b>Answer</b></label>
              <input type="text" placeholder="Enter answer" name="answer" id="answer" required="">
              <br><br><br>              
              <button type="submit" name="signup" value="true">Sign up</button><br>             
<!--            <input type="button" id="button" value="add">-->
            </div>            
        </form><br>
<!--        <div id="result"></div>-->
    </center>
    </body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
//        $("#button").click(function(){
//            var data = $("#form-search").serialize();
//            if(data==''){
//                alert('fill all data');
//            }else{
//                $.ajax({
//                    data:data,
//                    type:"post",
//                    url:"ajaxdata.php",
//                    success:function(msg){
//                        $('#result').html(msg);
//                    },
//                    error:function(e){
//                        alert("ERROR: " + e.status + " " + e.statusText);
//                    }
//                });
//            }
//        });
        
        $("#cource").on('change',function(){
            var cource_id = $(this).val();
            if(cource_id){
                $.ajax({
                    data:{cource_id:cource_id},
                    type:"post",
                    url:"ajaxdata.php",
                    success:function(msg){
                        $('#batch').html(msg);
                    },
                    error:function(e){
                        alert("ERROR: " + e.status + " " + e.statusText);
                    }
                });
            }else{
                $("#batch").html('<option value="">Select cource first</option>');
            }
        });
    });
    
</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#photo").change(function() {
  readURL(this);
});
</script>