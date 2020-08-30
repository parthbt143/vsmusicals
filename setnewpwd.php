<?php
$msg="";
$headermsg ="Set New Password";
$connection = mysqli_connect("localhost", "root", "", "db_vsm") or die(mysqli_error("connection"));
if(!isset($_COOKIE['email']))
{
    header("location:login.php");
}
if (isset($_POST['change'])) {

    $npwd = mysqli_real_escape_string($connection,$_POST['npwd']);
    $cpwd = mysqli_real_escape_string($connection,$_POST['cpwd']);
    if ($npwd == $cpwd) {
        $q = mysqli_query($connection, "update tbl_admin set ad_password='{$npwd}' where ad_email = '{$_COOKIE['email']}' ") or die(mysqli_error($connection));

        if ($q) {


            header("location:login.php");
            setcookie('email','',time()-300);
        }
    }else
    {
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> New Password Does Not Match With Confirm Password ! </div>";
   
    }
}
?>
<html class="no-js" lang="en">

    <!-- Mirrored from pratham.theironnetwork.org/demo/default/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Oct 2018 07:46:30 GMT -->
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" />
        <meta name="description" content="type_your_description_here">
        <meta content="" name="author" />
        <link rel="shortcut icon" type="image/png" href="images/logo.png">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" href="assets/plugins/animate/animate.min.html" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/css/pratham.min.css">
        <title>Forgot Password</title>
    </head>
    <body>
        <div class="prtm-wrapper">
            <div class="login-banner"></div>
            <div class="login-form-wrapper mrgn-b-lg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 col-md-8 col-lg-5 center-block">
                            <div class="prtm-form-block prtm-full-block overflow-wrappper">
                                <div class="login-bar"> <img src="assets/img/login-bars.png" class="img-responsive" alt="login bar" width="743" height="7"> </div>
                                <div class="prtm-block-title text-center">
                                    <div class="mrgn-b-lg">
                                        <a href="javascript:;"> <img src="images/logo.png" alt="login logo" class="img-responsive display-ib" width="218" height="23"> </a>
                                    </div>
                                    <hr>
                                    <div class="login-top mrgn-b-lg">
                                        <div class="mrgn-b-md">
                                            <h2 class="text-capitalize base-dark font-1x fw-normal">Set New Password</h2> </div>

                                    </div>
                                </div>
                                <div class="prtm-block-content">
                                    <form class="login-form"   method="post">


                                        <div class="form-group has-feedback">
                                            <input class="form-control" name="npwd" aria-describedby="user-pwd" type="password" placeholder="Set New Password" required> 
                                            <span class="glyphicon glyphicon-user form-control-feedback fa-lg" aria-hidden="true"></span> 
                                        </div>
                                        <div class="form-group has-feedback">
                                            <input class="form-control" name="cpwd" aria-describedby="user-pwd" type="password" placeholder="Confirm Password" required> 
                                            <span class="glyphicon glyphicon-user form-control-feedback fa-lg" aria-hidden="true"></span> 
                                        </div>
<?php echo $msg; ?>

                                        <div class="mrgn-b-lg">
                                            <input type="submit" value="Change Password" name="change" class="btn btn-success btn-block font-2x" >
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

</div>
</div>

<script type="text/javascript" src="../../../www.gstatic.com/charts/loader.js"></script>
<script src="assets/js/vendor.min.js" type="text/javascript"></script>
<script src="assets/js/plugins.min.js" type="text/javascript"></script>
<script src="assets/js/pratham.min.js" type="text/javascript"></script>
</body>

<!-- Mirrored from pratham.theironnetwork.org/demo/default/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Oct 2018 07:46:31 GMT -->
</html>