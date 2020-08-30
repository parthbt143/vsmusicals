<?php

require 'connection.php';
$response = array();

if ( isset($_POST['cust_fname']) && isset($_POST['cust_lname']) && isset($_POST['cust_gender']) && isset($_POST['cust_mobile']) && isset($_POST['cust_email']) && isset($_POST['cust_address']) && isset($_POST['area_id'])) {

    $fname = mysqli_real_escape_string($connection, $_POST['cust_fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['cust_lname']);
    $gender = mysqli_real_escape_string($connection, $_POST['cust_gender']);
    $mobile = mysqli_real_escape_string($connection, $_POST['cust_mobile']);
    $email = mysqli_real_escape_string($connection, $_POST['cust_email']);
    $address = mysqli_real_escape_string($connection, $_POST['cust_address']);
    $area = mysqli_real_escape_string($connection, $_POST['area_id']);

    $uniquequery = mysqli_query($connection,"select cust_email from tbl_customer where cust_email='{$email}'");
    $count = mysqli_fetch_array($uniquequery);
    
    if ($count > 0 )
    {
        $response['flag'] = '0';
        $response["message"] = "Account Already Registered";
    }else{
        $query = mysqli_query($connection, "insert into tbl_customer (cust_fname,cust_lname,cust_gender,cust_mobile,cust_email,cust_address,area_id) values('{$fname}','{$lname}','{$gender}','{$mobile}','{$email}','{$address}','{$area}' ) ") or die(mysqli_error($connection));
        
        if ($query) {
            $response['flag'] = '1';
            $response["message"] = "Record Inserted ";
        } else {
            $response['flag'] = '0';
            $response["message"] = "Error in Query";
        }
        
        }
    }
    
    else {
    $response['flag'] = '0';
    $response["message"] = "Required Field Is Missing ";
    }

echo json_encode($response);
?>
