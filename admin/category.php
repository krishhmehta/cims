<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){        
        if(isset($_REQUEST['did'])){
            $category_id= $_REQUEST['did'];
            $query=mysqli_query($conn,"delete from cims_category where category_id=$category_id");
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
        <h2>Category</h2>        
        <form id="form-search" method="post" >    
            <input type="hidden" name="catval" value="category">
            <table>
                
                <tr><td>category_name</td><td><input type="text" name="category_name" id="category_name"> </td></tr>
            </table>            
            <input type="button" id="button" value="add">
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#button").click(function(){
            var data = $("#form-search").serialize();        
            if(data==''){
                alert('fill all fields');
            }else{
                $.ajax({
                    data:data,
                    type:"post",
                    url: "ajaxdata.php",                    
                    success: function(r) {//success(result,status,xhr)
                        $("#result").html(r);
                    },
                    error: function(e) {//error(xhr,status,error)
                        alert("ERROR: " + e.status + " " + e.statusText);
                    }
                });
            }
        });
    });
</script>
