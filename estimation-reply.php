<?php


$headermsg ="Send Reply To Estimation";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'connection.php';
include 'check-unique.php';
$msg = "";
if (!isset($_GET['eid']) || empty($_GET['eid'])) {

    header("location:estimation.php");
}

$editid = $_GET['eid'];
$selectq = mysqli_query($connection, " SELECT
    `tbl_product`.`pro_name`
    , `tbl_customer`.`cust_fname`
    , `tbl_customer`.`cust_lname`
    , `tbl_customer`.`cust_email`
    , `tbl_estimation`.`est_id`
    , `tbl_estimation`.`est_title`
    , `tbl_estimation`.`est_description`
    , `tbl_estimation`.`est_photo1`
    , `tbl_estimation`.`est_photo2`
    , `tbl_estimation`.`est_reply`
FROM
    `db_vsm`.`tbl_estimation`
    INNER JOIN `db_vsm`.`tbl_customer` 
        ON (`tbl_estimation`.`cust_id` = `tbl_customer`.`cust_id`)
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_product`.`pro_id` = `tbl_estimation`.`pro_id`) where tbl_estimation.est_id='{$editid}'") or die(mysqli_error($connection));
$selectrow = mysqli_fetch_array($selectq);
$email = $selectrow['cust_email'];
$name = $selectrow['cust_fname']." ".$selectrow['cust_lname'];
if (isset($_POST['insert'])) {

    $ID = mysqli_real_escape_string($connection, $_POST['estid']);
    $reply = mysqli_real_escape_string($connection, $_POST['reply']);

    $q = mysqli_query($connection, "update tbl_estimation set est_reply = '{$reply}' where est_id='{$ID}' ") or die(mysqli_error($connection));
    if ($q) { 
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
            $mail->Subject = 'VS Musical Estimation Reply ';
            $mail->Body = "Hello <b> $name </b> <br> Your Request For Estimation ID :- $ID has been reviewed . <br> And We can say $reply ";
            $mail->AltBody = " Hello  $name Your Request For Estimation ID :- $ID has been reviewed . And We can say $reply ";

            $mail->send();
            echo "<script>alert('Email Sent');</script>";
            header("Location:estimation.php");
        } catch (Exception $e) {
            $msg2= 
                    "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> Message could not be sent. Mailer Error:  Check Your Connection </div>";
            
        }
    }
}
?>
<html class="no-js" lang="en">
    <?php include'headFile.php' ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>
            <title> Estimation Reply </title>
            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">

                        <?php
                        echo $msg;
                        ?>

                        <form class="form-group"  method="post">

                            <input type="hidden" value="<?php echo $selectrow['est_id']; ?>" name="estid">

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Customer Name </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['cust_fname'] . " " . $selectrow['cust_lname'] ?> </label>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Product  </label>
                                    <div class="col-sm-10">
                                        <label class="col-sm-10 control-label"><?php echo $selectrow['pro_name'] ?> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Title </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['est_title'] ?> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Description </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['est_description'] ?> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mrgn-all-none">
                                <label class="col-sm-2 control-label"> Photo </label>
                                <div class="col-sm-5">
                                    <img src="<?php echo $selectrow['est_photo1'] ?>" height="100" width="100">
                                </div>
                            </div>
                            <br>
                            <div class="row mrgn-all-none">
                                <label class="col-sm-2 control-label"> Photo </label>
                                <div class="col-sm-5">
                                    <img src="<?php echo $selectrow['est_photo2'] ?>" height="100" width="100">
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Reply</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="reply" placeholder="Enter Reply " type="text" required="yes">
                                    </div>
                                </div>
                            </div>



                            <input type="submit" class="btn btn-primary btn-rounded" Value ="Send Reply" name="insert">
                            <input type="Reset" class="btn btn-primary btn-rounded" name="reset">


                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include'script.php' ?>
    </body>
</html>

