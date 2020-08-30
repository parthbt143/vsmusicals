
<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student
if(isset($_POST['order_id']))
 {
    $order= mysqli_real_escape_string($connection,$_POST['order_id']);
$query = mysqli_query($connection, "SELECT
    `tbl_order_details`.`order_id`
    , `tbl_order_details`.`od_id`
    , `tbl_product`.`pro_name`
    , `tbl_order_details`.`pro_quantity`
    , `tbl_order_details`.`pro_price`
    , `tbl_order_details`.`pro_discount`
    , `tbl_order_details`.`od_total`
FROM
    `db_vsm`.`tbl_order_details`
    INNER JOIN `db_vsm`.`tbl_order` 
        ON (`tbl_order_details`.`order_id` = `tbl_order`.`order_id`)
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_product`.`pro_id` = `tbl_order_details`.`pro_id`) where `tbl_order_details`.`order_id`='{$order}' AND `tbl_order_details`.`is_delete`=0 ") or die(mysqli_error($connection));
}
else
{
 $query = mysqli_query($connection, "SELECT
    `tbl_order_details`.`order_id`
    , `tbl_order_details`.`od_id`
    , `tbl_product`.`pro_name`
    , `tbl_order_details`.`pro_quantity`
    , `tbl_order_details`.`pro_price`
    , `tbl_order_details`.`pro_discount`
    , `tbl_order_details`.`od_total`
FROM
    `db_vsm`.`tbl_order_details`
    INNER JOIN `db_vsm`.`tbl_order` 
        ON (`tbl_order_details`.`order_id` = `tbl_order`.`order_id`)
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_product`.`pro_id` = `tbl_order_details`.`pro_id`) where `tbl_order_details`.`is_delete`=0 ") or die(mysqli_error($connection));
   
}
$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["order_id"] = $row["order_id"];
         $tmp["od_id"] = $row["od_id"];
         $tmp["pro_name"] = $row["pro_name"];
         $tmp["pro_quantity"] = $row["pro_quantity"];
         $tmp["pro_price"] = $row["pro_price"];
         $tmp["pro_discount"] = $row["pro_discount"];
         $tmp["od_total"] = $row["od_total"];
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
