<?php
    include("connection.php");
    if($_SESSION['adminsess']==''){
        header('Location:index.php');
    }
    if($_SESSION['adminsess']!=''){
        if(isset($_REQUEST['actid'])){
            $courceid= $_REQUEST['actid'];
            $query=mysqli_query($conn,"update cims_cources set status='Active' where cource_id=$courceid");
        }
        if(isset($_REQUEST['dactid'])){
            $courceid= $_REQUEST['dactid'];
            $query=mysqli_query($conn,"update cims_cources set status='Deactive' where cource_id=$courceid");
        }
        if(isset($_REQUEST['did'])){
            $courceid= $_REQUEST['did'];
            $query=mysqli_query($conn,"delete from cims_cources where cource_id=$courceid");
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
        <h2>Cources</h2>        
        <form id="form-search" method="post" >    
            <input type="hidden" name="val" value="cource">
            <br><br> cource_code
            <input type="text" name="code" id="code"><br>
            Cource Name<input type="text" name="cource" id="cource"><br>              
            total_attandance_per<input type="text" name="tot_att" id="tot_att">%<br>
            total_working_days <input type="text" name="wdays" id="wdays"><br>
            <input type="button" id="button" value="add">
<!--              <button type="submit" name="add" value="true">Add</button><br>             -->                      
        </form>
        <br>
        <div id="result">
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
