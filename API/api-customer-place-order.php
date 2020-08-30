<?php

require 'connection.php';
$response = array();



if(isset($_POST['order_date']) && isset($_POST['cust_id']) && isset($_POST['receiver_name']) && isset($_POST['receiver_address']) && isset($_POST['area_id']) && isset($_POST['receiver_mobile']) && isset($_POST['order_total'])){
       
     $date = mysqli_real_escape_string($connection,$_POST['order_date']);
     $cust = mysqli_real_escape_string($connection,$_POST['cust_id']);
     $name = mysqli_real_escape_string($connection,$_POST['receiver_name']);
     $address = mysqli_real_escape_string($connection,$_POST['receiver_address']);
     $area = mysqli_real_escape_string($connection,$_POST['area_id']);
     $mobile = mysqli_real_escape_string($connection,$_POST['receiver_mobile']);
     $total = mysqli_real_escape_string($connection,$_POST['order_total']);

    $query = mysqli_query($connection,"insert into tbl_order(order_date,cust_id,receiver_name,receiver_address,area_id,receiver_mobile,order_status,order_total) values('{$date}','{$cust}','{$name}','{$address}','{$area}','{$mobile}','Pending','{$total}')  ") or die(mysqli_error($connection));

    if ($query) {
        //$last = mysqli_insert_id($connection);
        $lastq = mysqli_query ($connection,"select * from tbl_order ORDER BY(order_id) DESC  ") or die(mysqli_error($connection));
        $last = mysqli_fetch_array($lastq);
        $response['order_id'] = $last['order_id']; 
        $response['flag'] = '1';
        $response["message"] = "Record Inserted ";
    } else {
        $response['flag'] = '0';
        $response["message"] = "Error in Query";
    }
} else {
    $response['flag'] = '0';
    $response["message"] = "Required Field Is Missing ";
}
echo json_encode($response);
?>