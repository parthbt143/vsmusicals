a<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student

$query = mysqli_query($connection, " SELECT
    `tbl_pro_offer`.`is_active`
    , `tbl_pro_offer`.`po_id`
    , `tbl_product`.`pro_name`
    , `tbl_offer`.`of_name`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_pro_offer` 
        ON (`tbl_product`.`pro_id` = `tbl_pro_offer`.`pro_id`)
    INNER JOIN `db_vsm`.`tbl_offer` 
        ON (`tbl_offer`.`of_id` = `tbl_pro_offer`.`of_id`)") or die(mysqli_error($connection));

$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["po_id"] = $row["po_id"];
         $tmp["pro_name"] = $row["pro_name"];
         $tmp["of_name"] = $row["of_name"];
         $tmp["is_active"] = $row["is_active"];
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


