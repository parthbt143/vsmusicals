<?php

//Connection
require 'connection.php';
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['order_details']) && isset($_POST['order_id'])) {

    $order = mysqli_real_escape_string($connection, $_POST['order_id']);
    $detailsjson = $_POST['order_details'];
    $detail_obj = json_decode($detailsjson, true);
    $dataarray = $detail_obj["details"];
    foreach ($dataarray as $key => $value) {

       $insertdetails= mysqli_query($connection, "insert into tbl_order_details (order_id,pro_id,pro_quantity,pro_price,pro_discount,od_total) values('{$order}','{$value['pro_id']}','{$value['pro_quantity']}','{$value['pro_price']}','{$value['pro_discount']}','{$value['od_total']}' )") or die(mysqli_error($connection));
    }

    if ($insertdetails) {
        $response['flag'] = 1;
        $response['order_id'] = $order;
        $response['message'] = "Order Placed Successfully";
    }
} else {

    $response['flag'] = 0;
    $response['message'] = "Required fields missing";
}
echo json_encode($response);
