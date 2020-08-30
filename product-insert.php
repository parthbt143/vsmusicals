<?php
include 'connection.php';
$msg="";
include 'check-unique.php';
$headermsg ="Insert New Product";
if(isset($_POST['insert']))
{
    
    $a1= mysqli_real_escape_string($connection, $_POST['proname']);
    $a2=mysqli_real_escape_string($connection,$_POST['subcat']);
    $a3=mysqli_real_escape_string($connection,$_POST['procompany']);
    $a4=mysqli_real_escape_string($connection,$_POST['proprice']);
    $a5=mysqli_real_escape_string($connection,$_POST['prowarranty']);
    $a6=mysqli_real_escape_string($connection,$_POST['proser']);
    $a7=mysqli_real_escape_string($connection,$_POST['serpri']);
    $a8=mysqli_real_escape_string($connection,$_POST['stock']);
    $path="productpics/".time().$_FILES['photo']['name'];
    $a9=mysqli_real_escape_string($connection,$_POST['offer']);
   
    
     $check = checkunique($connection, "tbl_product", "pro_name", $a1);

    if ($check) {
       $q= mysqli_query($connection, "insert into tbl_product (pro_name,sc_id,com_id,pro_price,pro_warranty,pro_service,pro_service_price,pro_stock,pro_photo,of_id) values('{$a1}','{$a2}','{$a3}','{$a4}','{$a5}','{$a6}','{$a7}','{$a8}','{$path}','{$a9}') ") or die(mysqli_error($connection));
            
    if($q)
    {
         $upload = move_uploaded_file($_FILES['photo']['tmp_name'],$path);
         if($upload){
          
                    header("location:product-display.php") ;    
         }
    }
       
    } else {
       
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $a1 Already Exist ! </div>";
        
    }
    
    
    
}



?>
<html class="no-js" lang="en">
    <title>Product Insert</title>
<?php include'headFile.php'?>
<body>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
    <?php echo $msg; ?>
    <form class="form-group"  method="post" enctype="multipart/form-data">
    

    
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Product Name  </label>
<div class="col-sm-5">
<input class="form-control" name="proname" placeholder="Product Name " type="text" required="yes">
</div>
</div>
</div>
   
    
    
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Sub Category </label>
<div class="col-sm-5">
    <select class="form-control" name="subcat" req="yes">
        
        <option> Select Sub Category  </option>
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_sub_category where is_delete='0' ") or die (mysqli_error($connection));
                           while($sel = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$sel['sc_id']}> {$sel['sc_name']}</option>";
                     }
                    echo "  </select>";
        ?>
        
    </select>
</div>
</div>
</div>


<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Company </label>
<div class="col-sm-5">
    <select class="form-control" name="procompany" req="yes">
        
        <option> Select Product Company  </option>
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_company where is_delete='0' ") or die (mysqli_error($connection));
                           while($sel = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$sel['com_id']}> {$sel['com_name']}</option>";
                     }
                    echo "  </select>";
        ?>
        
    </select>
</div>
</div>
</div>

<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Product Price </label>
<div class="col-sm-5">
<input class="form-control" name="proprice" placeholder="Product Price " type="text" required="yes">
</div>
</div>
</div>
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Warranty </label>
<div class="col-sm-5">
<input class="form-control" name="prowarranty" placeholder="Product Warranty" type="text" required="yes">
</div>
</div>
</div>
    
 <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Free Sevices </label>
<div class="col-sm-5">
<input class="form-control" name="proser" placeholder="Free Services" type="text" required="yes">
</div>
</div>
</div>
   
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Paid Service Price </label>
<div class="col-sm-5">
<input class="form-control" name="serpri" placeholder="Paid Service Price" type="text" required="yes">
</div>
</div>
</div>
    
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Stock </label>
<div class="col-sm-5">
<input class="form-control" name="stock" placeholder="Stock" type="text" required="yes">
</div>
</div>
</div>
  
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Photo </label>
<div class="col-sm-5">
    <input class="form-control" name="photo"   type="file" required="yes">
</div>
</div>
</div>
        
  <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Offer </label>
<div class="col-sm-5">
    <select class="form-control" name="offer" req="yes">
        
       
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_offer where is_delete='0' ") or die (mysqli_error($connection));
                           while($sel = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$sel['of_id']}> {$sel['of_name']}</option>";
                     }
                    echo "  </select>";
        ?>
        
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