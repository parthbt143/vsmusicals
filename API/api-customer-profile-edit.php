<?php

require 'connection.php';

$response = array();

if (isset($_POST['cust_fname']) && isset($_POST['cust_lname']) && isset($_POST['cust_gender']) && isset($_POST['cust_mobile']) && isset($_POST['cust_email']) && isset($_POST['cust_address']) && isset($_POST['area_id'])) {

 $fname = mysqli_real_escape_string($connection, $_POST['cust_fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['cust_lname']);
    $gender = mysqli_real_escape_string($connection, $_POST['cust_gender']);
    $mobile = mysqli_real_escape_string($connection, $_POST['cust_mobile']);
    $email = mysqli_real_escape_string($connection, $_POST['cust_email']);
    $address = mysqli_real_escape_string($connection, $_POST['cust_address']);
    $area = mysqli_real_escape_string($connection, $_POST['area_id']);

//Check ID Record is Present or not 
    $selectquery = mysqli_query($connection, "select * from tbl_customer where cust_email= '{$email}'") or die(mysqli_error($connection));
    $count = mysqli_num_rows($selectquery);

	//If Record Present then Fire Update Query
    if ($count > 0) {

        $updatequery = mysqli_query($connection,"update tbl_customer set  `cust_fname`='{$fname}',`cust_lname`='{$lname}',`cust_gender`='{$gender}',`cust_mobile`='{$mobile}',`cust_address`='{$address}',`area_id`='{$area}' where cust_email ='{$email}'") or die(mysqli_error($connection));
        if ($updatequery) {
            $response['flag'] = '1';
            $response["message"] = "Profile Updated Succesfully !";
        } else {
            $response['flag'] = '0';
            $response["message"] = "Error in Query ";
        }
    } else {
        $response['flag'] = '0';
        $response["message"] = "Record Not Found ";
    }
 
}
else {
    $response['flag'] = '0';
    $response["message"] = "Required Field Is Missing ";
}

echo json_encode($response);
