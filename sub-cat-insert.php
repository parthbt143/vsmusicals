s<?php
include 'connection.php';
$headermsg ="Insert New Sub category";
include 'check-unique.php';
$msg ="";

$headermsg ="Insert Sub Category";
if(isset($_POST['insert']))
{
  
    $cat = mysqli_real_escape_string($connection,$_POST['category']);
    $name = mysqli_real_escape_string($connection,$_POST['subcatname']);
   
    
    $check = checkunique($connection, "tbl_sub_category", "sc_name", $name);

    if ($check) {
        $q= mysqli_query($connection, "insert into tbl_sub_category (cat_id,sc_name) values('{$cat}','{$name}')") or die(mysqli_error($connection));
            
    if($q)
    {
        
                    header("location:sub-cat-display.php") ; 
    }
       
    } else {   
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";
    }
   
}



?>
<html class="no-js" lang="en">
<?php include'headFile.php'?>
<body>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>
<title> Insert Sub Category </title>
<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
    

      <?php echo $msg; ?>  
<form class="form-group"  method="post">
    
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Category </label>
<div class="col-sm-5">
    <select class="form-control" name="category" req="yes">
        
        <option> Select Category   </option>
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_category where is_delete='0'") or die (mysqli_error($connection));
                           while($cat = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$cat['cat_id']}> {$cat['cat_name']}</option>";
                     }
                    echo "  </select>";
        ?>
        
    </select>
</div>
</div>
</div>
    
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Sub Category Name</label>
<div class="col-sm-5">
    <input class="form-control" name="subcatname" placeholder="Sub Category Name" type="text" required="yes">

  
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
