<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){       
        if(isset($_REQUEST['eid'])){
            $courceid= $_REQUEST['eid'];
            $query=mysqli_query($conn,"select * from cims_cources where cource_id=$courceid");
            $res= mysqli_fetch_assoc($query);
        }
        
        if(isset($_REQUEST['update'])=='edit'){
            $courceid= $_REQUEST['eid'];
            extract($_POST);
            $query=mysqli_query($conn,"update cims_cources set cource_code='$code',cource_name='$cource',total_attandance_per='$tot_att',total_working_days='$wdays' where cource_id=$courceid")or die('error)');
            if($query){
                echo "<script> window.location.href='cources.php'; alert('update sucessfully');</script>";
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
        <h2>Edit Cources</h2>        
        <form id="form-search" method="post" action="">    
            
            <br><br> cource_code
            <input type="text" name="code" id="code" value="<?php echo $res['cource_code']; ?>" required=""><br>
            Cource Name<input type="text" name="cource" id="cource" value="<?php echo $res['cource_name']; ?>" required=""><br>              
            total_attandance_per<input type="text" name="tot_att" id="tot_att" value="<?php echo $res['total_attandance_per']; ?>" required=""><br>
            total_working_days <input type="text" name="wdays" id="wdays" value="<?php echo $res['total_working_days']; ?>" required=""><br>
            <input type="submit" id="button" name="update" value="edit">                              
        </form><br>
        <table border="1">
            <tr>
                <td>cource_code</td>
                <td>cource name</td>
                <td>total_attandance_per</td>
                <td>total_working_days</td>
                <td>status</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_cources");
                while($res=mysqli_fetch_assoc($query)){
            ?>
                <tr>
                    <td><?php echo $res['cource_code']; ?></td>
                    <td><?php echo $res['cource_name']; ?></td>
                    <td><?php echo $res['total_attandance_per'].' %'; ?></td>
                    <td><?php echo $res['total_working_days']; ?></td>
                    <td><?php echo $res['status']; ?></td>
                    <td><a href="cources.php?actid=<?php echo $res['cource_id'] ?>">Active</a>
                        <a href="cources.php?dactid=<?php echo $res['cource_id'] ?>">Deactive</a>
                        <a href="cources_edit.php?eid=<?php echo $res['cource_id'] ?>">Edit</a>
                        <a href="cources.php?did=<?php echo $res['cource_id'] ?>">Delete</a>
                    </td>
                </tr>            
            <?php } ?>
        </table>
    </center>
    </body>
</html>
