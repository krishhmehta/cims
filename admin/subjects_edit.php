<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){       
        if(isset($_REQUEST['eid'])){
            $subject_id= $_REQUEST['eid'];
            $equery=mysqli_query($conn,"select * from cims_subjects where subject_id=$subject_id");
            $eres= mysqli_fetch_assoc($equery);
        }
        
        if(isset($_REQUEST['update'])=='edit'){
            $subject_id= $_REQUEST['eid'];
            extract($_POST);
            //echo $fees;exit();
            $query=mysqli_query($conn,"update cims_subjects set cource_id='$courceid',subject_name='$subject_name' where subject_id=$subject_id")or die('error.!');
            if($query){
                echo "<script> window.location.href='subjects.php'; alert('update sucessfully');</script>";
                //header('Location:cources.php');
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
        <h2>Subject</h2>        
        <form id="form-search" method="post" >    
            
            <table>
                <tr>
                    <td>select cource</td><td>
                        <select name="courceid" id="courceid">
                            <option value="" disabled="" selected="">Select cource</option>
                            <?php $query= mysqli_query($conn, "select * from cims_cources");
                                while($res=mysqli_fetch_assoc($query)){?>
                            <option <?php if($eres['cource_id']== $res['cource_id']) { ?>selected=""<?php } ?> value="<?php echo $res['cource_id']; ?>"><?php echo $res['cource_name']; ?></option>
                            <?php } ?>
                        </select></td></tr>
                <tr><td>Sub name</td><td><input type="text" name="subject_name" id="subject_name" value="<?php echo $eres['subject_name']; ?>"> </td></tr>
            </table>            
            <input type="submit" id="update" name="update" value="edit">
        </form>
        <br>
        <div id="result">
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
        </div>        
    </center>
    </body>
</html>

