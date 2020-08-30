<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$otp = rand(1000, 9999);

require 'connection.php';
$response = array();

if (isset($_POST['email'])) {

    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $otpq = mysqli_query($connection, "update tbl_student set stud_password = '{$otp}' where stud_email = '{$email}'") or die(mysqli_error($connection));


    $selectq = mysqli_query($connection, "select * from tbl_student where stud_email='{$email}'") or die(mysqli_error($connection));
    $row = mysqli_fetch_array($selectq);
    $count = mysqli_num_rows($selectq);
    $name = $row['stud_fname'];
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
            $mail->Subject = 'VS Musicals Login OTP ';
            $mail->Body = "Hello <b> $name </b> Your OTP Is  <b> $otp </b>";
            $mail->AltBody = "Hello $name Your OTP Is $otp";

            $mail->send();
            $response["success"] = 1;
            $response["message"] = "Password Sent on Email Address";
            $response["otp"] = $otp;
        } catch (Exception $e) {
             $response["success"] = 0;
            $response["message"] = "Please Check Your Internet Connection !";
        }
    } else {
          $response["success"] = 0;
        $response["message"] = "Email Address Not registered !";
    }
}
else
{
        $response['flag'] = '0';
    $response["message"] = "Required Field Is Missing ";
}
echo json_encode($response)
?>

