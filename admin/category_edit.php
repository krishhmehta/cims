<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){        
        if(isset($_REQUEST['eid'])){
            $category_id= $_REQUEST['eid'];
            $equery=mysqli_query($conn,"select * from cims_category where category_id=$category_id");
            $eres= mysqli_fetch_assoc($equery);
        }   
        if(isset($_REQUEST['update'])=='edit'){
            $category_id= $_REQUEST['eid'];
            extract($_POST);
            $query=mysqli_query($conn,"update cims_category set category_name='$category_name' where category_id=$category_id")or die('error.!');
            if($query){
                echo "<script> window.location.href='category.php'; alert('update sucessfully');</script>";
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
                
                <tr><td>category_name</td><td><input type="text" name="category_name" id="category_name" value="<?php echo $eres['category_name']; ?>" required=""> </td></tr>
            </table>            
            <input type="submit" id="update" name="update" value="edit">
        </form>
        <br>
        <div id="result">
            <table border="1">
            <tr>
                <td>category_name</td>
                <td>Action</td>
            </tr>
            <?php
                $query=mysqli_query($conn,"select * from cims_category");
                while($res=mysqli_fetch_assoc($query)){                      
            ?>
                <tr>
                    <td><?php echo $res['category_name']; ?></td>                    
                    <td>
                        <a href="category_edit.php?eid=<?php echo $res['category_id'] ?>">Edit</a>
                        <a href="category.php?did=<?php echo $res['category_id'] ?>">Delete</a>
                    </td>
                </tr>            
            <?php } ?>
        </table>
        </div>        
    </center>
    </body>
</html>
