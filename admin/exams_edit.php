<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){        
        if(isset($_REQUEST['eid'])){
            $exam_id= $_REQUEST['eid'];
            $equery=mysqli_query($conn,"select * from cims_exams where exam_id=$exam_id");
            $eres= mysqli_fetch_assoc($equery);
        }   
        if(isset($_REQUEST['update'])=='edit'){
            $exam_id= $_REQUEST['eid'];
            extract($_POST);
            $query=mysqli_query($conn,"update cims_exams set exam_name='$exam_name' where exam_id=$exam_id")or die('error.!');
            if($query){
                echo "<script> window.location.href='exams.php'; alert('update sucessfully');</script>";
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
        <h2>Edit Category</h2>        
        <form id="form-search" method="post" >    
            <input type="hidden" name="catval" value="category">
            <table>
                
                <tr><td>exam_name</td><td><input type="text" name="exam_name" id="exam_name" value="<?php echo $eres['exam_name']; ?>" required=""> </td></tr>
            </table>            
            <input type="submit" id="update" name="update" value="edit">
        </form>
        <br>
        <div id="result">
            <table border="1">
            <tr>
                <td>exam_name</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_exams");
                while($res=mysqli_fetch_assoc($query)){                      
            ?>
                <tr>
                    <td><?php echo $res['exam_name']; ?></td>                    
                    <td>
                        <a href="exams_edit.php?eid=<?php echo $res['exam_id'] ?>">Edit</a>
                        <a href="exams.php?did=<?php echo $res['exam_id'] ?>">Delete</a>
                    </td>
                </tr>            
            <?php } ?>
        </table>
        </div>        
    </center>
    </body>
</html>
