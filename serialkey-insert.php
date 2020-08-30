
<?php
include 'connection.php';
$headermsg ="Insert New Serail Key";

if(isset($_POST['insert']))
{
  
  $a1=$_POST['pro'];
  $a2=$_POST['num'];
  $a3=$_POST['sold'];
  
   
    $q= mysqli_query($connection, "insert into tbl_serial_no (sn_num,pro_id,sn_sold) values('{$a2}','{$a1}','{$a3}')") or die(mysqli_error($connection));
            
    if($q)
    {
        
                    header("location:serialkey-display.php") ; 
    }
}



?>
<html class="no-js" lang="en">
<?php include'headFile.php'?>
<body>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
    
<form class="form-horizontal"  method="post">
    

    
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Product </label>
<div class="col-sm-5">
    <select class="form-control" name="pro" req="yes">
        
        <option> Select Product </option>
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_product where is_delete='0' ") or die (mysqli_error($connection));
                           while($cat = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$cat['pro_id']}> {$cat['pro_name']}</option>";
                     }
                    echo "  </select>";
        ?>
        
    </select>
</div>
</div>
</div>
    
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Serial Key</label>
<div class="col-sm-5">
    <input class="form-control" name="num" placeholder="Serial Key" type="text" required="yes">

  </div>
</div>
</div>
    
    
    
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Sold </label>
<div class="col-sm-5">
<select class="form-control" name="sold" placeholder="Gender" type="text" required="yes">
    <option > -- </option>
    <option value="1"> Yes </option>
    <option value="0"> No </option>
    
</select>
</div>
</div>
</div>
  

    
    
     
 <input type="submit" class="btn btn-primary btn-rounded" name="insert">
 <input type="Reset" class="btn btn-primary btn-rounded" name="reset">


</form>
</div>
</div>
</div>
</div>
<?php include'script.php'?>
</body>
</html>