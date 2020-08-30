<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$headermsg ="Forgot Password";
$otp = rand(1000, 9999);

$msg="";
$msg2="";

$connection = mysqli_connect("localhost", "root", "", "db_vsm") or die(mysqli_error("connection"));

if ($_POST) {
    $email = $_POST['email'];


    // setting cookie 

    setcookie("email", "$email", time() + 300);

    $otpq = mysqli_query($connection, "update tbl_admin set ad_password = '{$otp}' where ad_email = '{$email}'") or die(mysqli_error($connection));


    $selectq = mysqli_query($connection, "select * from tbl_admin where ad_email='{$email}'") or die(mysqli_error($connection));
    $row = mysqli_fetch_array($selectq);
    $count = mysqli_num_rows($selectq);
    $name = $row['ad_name'];
    if ($count > 0) {
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings

            $mail->SMTPDebug = 0;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'iosvsm@gmail.com';                 // SMTP username
            $mail->Password = 'vsM@18799';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );



            //Recipients
            $mail->setFrom('iosvsm@gmail.com', 'VS Musicals');
            $mail->addAddress($email, $name);     // Add a recipient
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'VS Musical Password OTP ';
            $mail->Body = "Hello <b> $name </b> Your OTP Is  <b> $otp </b>";
            $mail->AltBody = "Hello $name Your OTP Is $otp";

            $mail->send();
            echo "<script>alert('Email Sent');</script>";
            header("Location:enterotp.php");
        } catch (Exception $e) {
            $msg2= 
                    "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> Message could not be sent. Mailer Error:  Check Your Connection </div>";
            
        }
    } else {
$msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> User Not Found ! </div>";
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
        <?php echo $msg2;?>
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
                                            <h2 class="text-capitalize base-dark font-1x fw-normal">Forgot Password</h2> </div>

                                    </div>
                                </div>
                                <div class="prtm-block-content">
                                    <form class="login-form"   method="post">


                                        <div class="form-group has-feedback">
                                            <input class="form-control" name="email" aria-describedby="user-pwd" type="Email" placeholder="Email" required> 
                                            <span class="glyphicon glyphicon-user form-control-feedback fa-lg" aria-hidden="true"></span> 
                                        </div>
<?php echo $msg ?>

                                        <div class="mrgn-b-lg">
                                            <input type="submit" value="Send OTP" class="btn btn-success btn-block font-2x" >
                                        </div>
                                        <a href="login.php"> Back To Login Page</a>
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