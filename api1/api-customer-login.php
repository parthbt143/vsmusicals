<?php

include 'connection.php';

$response = array();

if (isset($_POST['cust_email']) && !empty($_POST['cust_email']) && isset($_POST['cust_password']) && !empty($_POST['cust_password'])) {

    $email = mysqli_real_escape_string($connection, $_POST['cust_email']);
    $password = mysqli_real_escape_string($connection, $_POST['cust_password']);

    $loginquery = mysqli_query($connection, "select * from tbl_customer where cust_email='{$email}' and cust_password='{$password}'") or die(mysqli_error($connection));
    $fetchrow = mysqli_fetch_array($loginquery);

    $count = mysqli_num_rows($loginquery);

    if ($count > 0) {
        $response['success'] = 1;
        $response['userdata'] = $fetchrow;
        $response['message'] = "Login Success";
    } else {

        $response['success'] = 0;
        $response['message'] = "Login Failed";
    }
} else {

    $response['success'] = 0;
    $response['message'] = "Required fields missing";
}
echo json_encode($response);