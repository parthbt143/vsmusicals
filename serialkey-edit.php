<?php
include 'connection.php';
$headermsg ="Edit Serial Key";
if(!isset($_GET['eid']) || empty($_GET['eid']) )  
{
       
        header("location:serialkey-display.php") ;  
}
if($_POST)
{
    $id = $_POST['snid'];
    $a1=$_POST['pro'];
  $a2=$_POST['num'];
  $a3=$_POST['sold'];
  
    $q = mysqli_query($connection, "update tbl_serial_no set sn_num='{$a2}',pro_id='{$a1}',sn_sold='{$a3}' where sn_id='{$id}'")or die(mysqli_error($connection));
    if($q)
    {
        header("location:serialkey-display.php") ;   
    }
}
$editid =$_GET['eid'];
 $selectq = mysqli_query($connection," SELECT
    `tbl_product`.`pro_name`
    , `tbl_serial_no`.`sn_id`
    , `tbl_serial_no`.`sn_num`
    , `tbl_serial_no`.`sn_sold`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_serial_no` 
        ON (`tbl_product`.`pro_id` = `tbl_serial_no`.`pro_id`) where `tbl_serial_no`.`sn_id` = '{$editid}' ")or die(mysqli_errno($connection));
$selectrow = mysqli_fetch_array($selectq);

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
  <!-- Contents Ahiya Lkhvana -->

  <form class="form-horizontal"  method="post">
    
<input type="hidden" value="<?php echo $selectrow['sn_id'];?>" name="snid">

<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Product </label>
<div class="col-sm-5">
    <select class="form-control"  name="pro" req="yes">
        
        <option> Select Product </option>
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_product where is_delete = '0' ") or die (mysqli_error($connection));
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
    <input class="form-control" value="<?php echo $selectrow['sn_num'];?>" name="num" placeholder="Serial Key" type="text" required="yes">

  </div>
</div>
</div>
    
    
    
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Sold </label>
<div class="col-sm-5">
<select class="form-control" name="sold"  placeholder="Gender" type="text" required="yes">
    <option > -- </option>
    <option value="1"> Yes </option>
    <option value="0"> No </option>
    
</select>
</div>
</div>
</div>
  
    
<input type="submit" class="btn btn-primary btn-rounded" value="Update" name="update">



</form>
</div>
</div>
</div>
</div>
<?php include'script.php'?>
</body>
</html>