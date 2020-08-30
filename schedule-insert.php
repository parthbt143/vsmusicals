<?php
$headermsg ="Insert New Schedule";
include 'connection.php';

if(isset($_POST['insert']))
{
  
    $batch=$_POST['batchname'];
    $day=$_POST['day'];
    $start=$_POST['stime'];
    $end=$_POST['etime'];
    
   
    $q= mysqli_query($connection, "insert into tbl_schedule (batch_id,s_day,s_start,s_end) values('{$batch}','{$day}','{$start}','{$end}')") or die(mysqli_error($connection));
            
    if($q)
    {
        
                    header("location:schedule-display.php") ; 
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
<label class="col-sm-2 control-label"> Batch  </label>
<div class="col-sm-5">
    <select class="form-control" name="batchname" req="yes">
        
        <option> Select Batch   </option>
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_batch where is_delete='0'") or die (mysqli_error($connection));
                           while($cat = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$cat['batch_id']}> {$cat['batch_name']}</option>";
                     }
                    echo "  </select>";
        ?>
        
    </select>
</div>
</div>
</div>
    

  
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Day </label>
<div class="col-sm-5">
<select class="form-control" name="day" placeholder="Day" type="text" required="yes">
    <option > Select Day </option>
    <option value="Sunday"> Sunday </option>
    <option value="Monday"> Monday </option>
    <option value="Tuesday"> Tuesday </option>
    <option value="Wensday"> Wensday </option>
    <option value="Thursday"> Thursday </option>
    <option value="Friday"> Friday </option>
    <option value="Saturday"> Saturday </option>
    
</select>
</div>
</div>
</div>

 
   

<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Select Starting Time</label>
<div class="col-sm-5">
<input class="form-control" name="stime" placeholder="Staring Time" type="time" required="yes">
</div>
</div>
</div>
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Select Ending Time</label>
<div class="col-sm-5">
<input class="form-control" name="etime" placeholder="Ending Time" type="time" required="yes">
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