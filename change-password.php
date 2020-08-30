
<html class="no-js" lang="en">
<?php include'headFile.php';
    
   $msg = "";
 
$headermsg ="Change Password";
 include 'connection.php';
 
 if($_POST)
 {
     $npwd=$_POST['npwd'];
     $opwd=$_POST['opwd'];
     $cpwd=$_POST['cpwd'];
     
     $oldpwdq = mysqli_query($connection, "select ad_password from tbl_admin where ad_id={$_COOKIE['adminid']}" ) or die(mysqli_error($connection));
     $oldpwddata= mysqli_fetch_array($oldpwdq);
     
     if($oldpwddata['ad_password'] == $opwd)
     {
         if($npwd == $opwd)
         {
              
             
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> Your New Password Cannot Be Same As Your Old Password </div>";
         }
         else
         {
             if($npwd == $cpwd)
             {
                 $update = mysqli_query($connection, "update tbl_admin set ad_password='{$npwd}' where ad_id={$_COOKIE['adminid']}");
             
                 if($update)
                 {
                     
                    
                    header("location:admin-profile.php");
                 }
                 
                 }
             else
             {
              
                
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> New Password And Confirm Password Do Not Matched. </div>"; 
             }
         }
     }else
     {
         
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> Entered Old Password Is Wrong ! </div>";
     }
     
 }
 
 
 ?>
<body>
<div class="prtm-wrapper">
    <title>Change Password</title>
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
<?php echo  $msg ; ?>
  <form method="post">
       
      <div class="form-group">
<div class="row mrgn-all-none">
    
<label class="col-sm-2 control-label"> Old Password </label>
<div class="col-sm-5">
    <input class="form-control" name="opwd" type="password" placeholder="Enter Old Password" type="text" required="yes">
</div>
</div>
</div>
      
      <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> New Password </label>
<div class="col-sm-5">
<input class="form-control" name="npwd" type="password" placeholder="Enter New Password" type="text" required="yes">
</div>
</div>
</div>
      
      <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Confirm Password </label>
<div class="col-sm-5">
<input class="form-control" name="cpwd" type="password" placeholder="Confirm Password" type="text" required="yes">
</div>
</div>
</div>
      
      
 <input type="submit" class="btn btn-primary btn-rounded" Value="Update Password">
      
  </form>
  
  
</div>
</div>
</div>
</div>
<?php include'script.php'?>
</body>
</html>