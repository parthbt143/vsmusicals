<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student
if(isset($_POST['cust_id']))
 {
    $cust= mysqli_real_escape_string($connection,$_POST['cust_id']);
$query = mysqli_query($connection, "SELECT
    `tbl_customer`.`cust_fname`
    ,`tbl_customer`.`cust_lname`
    , `tbl_area`.`area_name`
    , `tbl_order`.`order_date`
    , `tbl_order`.`receiver_name`
    , `tbl_order`.`order_id`
    , `tbl_order`.`receiver_address`
    , `tbl_order`.`receiver_mobile`
    , `tbl_order`.`order_status`
    , `tbl_order`.`order_total`
FROM
    `db_vsm`.`tbl_area`
    INNER JOIN `db_vsm`.`tbl_order` 
        ON (`tbl_area`.`area_id` = `tbl_order`.`area_id`)
    INNER JOIN `db_vsm`.`tbl_customer` 
        ON (`tbl_order`.`cust_id` = `tbl_customer`.`cust_id`)  where `tbl_order`.`cust_id`='{$cust}' AND `tbl_order`.`is_delete`=0 ") or die(mysqli_error($connection));
}
else
{
 $query = mysqli_query($connection, "SELECT
    `tbl_customer`.`cust_fname`
    , `tbl_order`.`order_id`
    ,`tbl_customer`.`cust_lname`
    , `tbl_area`.`area_name`
    , `tbl_order`.`order_date`
    , `tbl_order`.`receiver_name`
    , `tbl_order`.`receiver_address`
    , `tbl_order`.`receiver_mobile`
    , `tbl_order`.`order_status`
    , `tbl_order`.`order_total`
FROM
    `db_vsm`.`tbl_area`
    INNER JOIN `db_vsm`.`tbl_order` 
        ON (`tbl_area`.`area_id` = `tbl_order`.`area_id`)
    INNER JOIN `db_vsm`.`tbl_customer` 
        ON (`tbl_order`.`cust_id` = `tbl_customer`.`cust_id`) where `tbl_order`.`is_delete`=0 ") or die(mysqli_error($connection));
   
}
$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["order_id"] = $row["order_id"];
         $tmp["cust_name"] = $row["cust_fname"] . " ". $row["cust_lname"] ;
         $tmp["order_date"] = $row["order_date"];
         $tmp["receiver_name"] = $row["receiver_name"];
         $tmp["receiver_address"] = $row["receiver_address"];
         $tmp["area_name"] = $row["area_name"];
         $tmp["receiver_mobile"] = $row["receiver_mobile"];
         $tmp["order_status"] = $row["order_status"];
         $tmp["order_total"] = $row["order_total"];
		 //Array Append
        array_push($response["data"], $tmp);
    }
    // success
    $response["flag"] = 1;
    $response["message"] = "$count Record Found";
    // echoing JSON response

} else {
    // success
    $response["flag"] = 0;
    $response["message"] = "No Record Found";
    // echoing JSON response
    
}
//echo "<pre>";
//print_r($response);
echo json_encode($response);