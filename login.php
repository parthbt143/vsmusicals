<!Doctype html>
<?php
 $connection = mysqli_connect("localhost", "root","", "db_vsm") or die(mysqli_error("connection"));
   
$headermsg ="Login";
 $msg = "";
 if(isset($_COOKIE['adminid']))
 {
     header("location:index.php");
 }
 
if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    
    $selectquery= mysqli_query($connection, "select * from tbl_admin where ad_email='{$email}' and 
        ad_password='{$password}'") or die(mysqli_error($connection));
    
    $count= mysqli_num_rows($selectquery);
    
    $row=mysqli_fetch_array($selectquery);
     
    if($count>0)    
    {
        setcookie("adminid","{$row['ad_id']}",time()+36000);
        
        header("location:index.php");
    }
    else{
        
       $msg = '<div style="background-color:red;color:white;" class="alert alert-primary" role="alert">
  Invalid Login Details !!
</div>';
    }  
    
}
?>
<html class="no-js" lang="en">
<!-- Mirrored from pratham.theironnetwork.org/demo/default/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Oct 2018 07:46:30 GMT -->
<?php include 'headFile.php'; ?> 
<title>VS Musical | Admin | login</title>

<body>
<div class="prtm-wrapper">
<div class="prtm-main">
<div class="login-banner"></div>
<div class="login-form-wrapper mrgn-b-lg">
<div class="container-fluid">
<div class="row">
<div class="col-xs-12 col-sm-9 col-md-8 col-lg-5 center-block">
<div class="prtm-form-block prtm-full-block overflow-wrappper">
<div class="login-bar"> <img src="assets/img/login-bars.png" class="img-responsive" alt="login bar" width="743" height="7"> </div>
<div class="prtm-block-title text-center">
<div class="mrgn-b-lg">
    <h1>  <img src="images/logo.png" alt="login logo" class="img-responsive display-ib" width="218" height="23"></h1>
</div>

</div>
<div class="prtm-block-content">

<form class="login-form"  method="post">
<div class="form-group has-feedback">
<input class="form-control"   type="text" placeholder="Email Address" name="email" > <span class="glyphicon glyphicon-user form-control-feedback fa-lg" aria-hidden="true"></span> </div>
<div class="form-group has-feedback">
<input class="form-control"   aria-describedby="user-pwd" type="password" placeholder="Password" name="password" > <span class="glyphicon glyphicon-lock form-control-feedback fa-lg" aria-hidden="true"></span> </div>

<?php 

echo $msg;
?>
<div class="mrgn-b-lg">
      <input type="submit" class="btn btn-success btn-block font-2x" name="login" > 
    <br>
    <a href="forgotpwd.php"> Forgot Password ??</a>
</div>

</form>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="../../../www.gstatic.com/charts/loader.js"></script>
<script src="assets/js/vendor.min.js" type="text/javascript"></script>
<script src="assets/js/plugins.min.js" type="text/javascript"></script>
<script src="assets/js/pratham.min.js" type="text/javascript"></script>
</body>
</html>        

