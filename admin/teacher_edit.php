<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){       
        if(isset($_REQUEST['eid'])){
            $teacher_id= $_REQUEST['eid'];
            $equery=mysqli_query($conn,"select * from cims_teacher where teacher_id=$teacher_id");
            $eres= mysqli_fetch_assoc($equery);
        }
        
        if(isset($_REQUEST['update'])=='edit'){
            $teacher_id= $_REQUEST['eid'];
            extract($_POST);
            //echo $fees;exit();
            $query=mysqli_query($conn,"update cims_teacher set name='$name' where teacher_id=$teacher_id")or die('error.!');
            if($query){
                echo "<script> window.location.href='teacher.php'; alert('update sucessfully');</script>";
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
        <h2>Teacher</h2>        
        <form id="form-search" method="post" >                
            <table>                
                <tr><td>teacher name</td><td><input type="text" name="name" id="name" value="<?php echo $eres['name']; ?>" required=""> </td></tr>
            </table>            
            <input type="submit" id="button" name="update" value="edit">
        </form>
        <br>
        <div id="result">
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
        </div>        
    </center>
    </body>
</html>
