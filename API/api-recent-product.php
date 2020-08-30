<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student

$query = mysqli_query($connection, "SELECT
    `tbl_company`.`com_name`
    , `tbl_sub_category`.`sc_name`
    , `tbl_product`.`pro_id`
    , `tbl_product`.`pro_name`
    , `tbl_product`.`pro_details`
    , `tbl_product`.`pro_price`
    , `tbl_product`.`pro_warranty`
    , `tbl_product`.`pro_service`
    , `tbl_product`.`pro_service_price`
    , `tbl_product`.`pro_photo`
    , `tbl_product`.`pro_stock`
FROM
    `db_vsm`.`tbl_company`
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_company`.`com_id` = `tbl_product`.`com_id`)
    INNER JOIN `db_vsm`.`tbl_sub_category` 
        ON (`tbl_sub_category`.`sc_id` = `tbl_product`.`sc_id`) where `tbl_product`.`is_delete` = '0' order by `tbl_product`.`pro_id` DESC ") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["pro_id"] = $row["pro_id"];
         $tmp["pro_photo"] = "http://localhost/admin/". $row["pro_photo"];
         $tmp["pro_name"] = $row["pro_name"];
         $tmp["sc_name"] = $row["sc_name"];
         $tmp["com_name"] = $row["com_name"];
         $tmp["pro_price"] = $row["pro_price"];
         $tmp["pro_warranty"] = $row["pro_warranty"];
         $tmp["pro_service"] = $row["pro_service"];
         $tmp["pro_service_price"] = $row["pro_service_price"];
         $tmp["pro_stock"] = $row["pro_stock"];
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
