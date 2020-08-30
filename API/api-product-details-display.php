<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student
if(isset($_POST['sc_id'])){
   $subcat = mysqli_real_escape_string($connection,$_POST['sc_id']);
$query = mysqli_query($connection, "SELECT
    `tbl_sub_category`.`sc_name`
    , `tbl_product`.`pro_id`
    , `tbl_product`.`pro_name`
    , `tbl_product`.`pro_details`
    , `tbl_company`.`com_name`
    , `tbl_product`.`pro_price`
    , `tbl_product`.`pro_warranty`
    , `tbl_product`.`pro_service`
    , `tbl_product`.`pro_service_price`
    , `tbl_product`.`pro_stock`
    , `tbl_product`.`pro_photo`
    , `tbl_offer`.`of_name`
    , `tbl_offer`.`of_details`
    , `tbl_offer`.`of_discount`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_sub_category` 
        ON (`tbl_product`.`sc_id` = `tbl_sub_category`.`sc_id`)
    INNER JOIN `db_vsm`.`tbl_company` 
        ON (`tbl_company`.`com_id` = `tbl_product`.`com_id`)
    INNER JOIN `db_vsm`.`tbl_offer` 
        ON (`tbl_offer`.`of_id` = `tbl_product`.`of_id`) where `tbl_product`.`sc_id` = '{$subcat}' ") or die(mysqli_error($connection));
 
}else if(isset($_POST['pro_id'])){
   $pro = mysqli_real_escape_string($connection,$_POST['pro_id']);
$query = mysqli_query($connection, "SELECT
    `tbl_sub_category`.`sc_name`
    , `tbl_product`.`pro_id`
    , `tbl_product`.`pro_name`
    , `tbl_product`.`pro_details`
    , `tbl_company`.`com_name`
    , `tbl_product`.`pro_price`
    , `tbl_product`.`pro_warranty`
    , `tbl_product`.`pro_service`
    , `tbl_product`.`pro_service_price`
    , `tbl_product`.`pro_stock`
    , `tbl_product`.`pro_photo`
    , `tbl_offer`.`of_name`
    , `tbl_offer`.`of_details`
    , `tbl_offer`.`of_discount`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_sub_category` 
        ON (`tbl_product`.`sc_id` = `tbl_sub_category`.`sc_id`)
    INNER JOIN `db_vsm`.`tbl_company` 
        ON (`tbl_company`.`com_id` = `tbl_product`.`com_id`)
    INNER JOIN `db_vsm`.`tbl_offer` 
        ON (`tbl_offer`.`of_id` = `tbl_product`.`of_id`)
        where `tbl_product`.`pro_id` = '{$pro}' ") or die(mysqli_error($connection));
}
else if(isset($_POST['of_id'])){
   $offer = mysqli_real_escape_string($connection,$_POST['of_id']);
$query = mysqli_query($connection, "SELECT
    `tbl_sub_category`.`sc_name`
    , `tbl_product`.`pro_id`
    , `tbl_product`.`pro_name`
    , `tbl_product`.`pro_details`
    , `tbl_company`.`com_name`
    , `tbl_product`.`pro_price`
    , `tbl_product`.`pro_warranty`
    , `tbl_product`.`pro_service`
    , `tbl_product`.`pro_service_price`
    , `tbl_product`.`pro_stock`
    , `tbl_product`.`pro_photo`
    , `tbl_offer`.`of_name`
    , `tbl_offer`.`of_details`
    , `tbl_offer`.`of_discount`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_sub_category` 
        ON (`tbl_product`.`sc_id` = `tbl_sub_category`.`sc_id`)
    INNER JOIN `db_vsm`.`tbl_company` 
        ON (`tbl_company`.`com_id` = `tbl_product`.`com_id`)
    INNER JOIN `db_vsm`.`tbl_offer` 
        ON (`tbl_offer`.`of_id` = `tbl_product`.`of_id`)
         where `tbl_product`.`is_delete` = '0' AND  `tbl_product`.`of_id` = '{$offer}'") or die(mysqli_error($connection));
}else
{
$query = mysqli_query($connection, "SELECT
    `tbl_sub_category`.`sc_name`
    , `tbl_product`.`pro_id`
    , `tbl_product`.`pro_name`
    , `tbl_product`.`pro_details`
    , `tbl_company`.`com_name`
    , `tbl_product`.`pro_price`
    , `tbl_product`.`pro_warranty`
    , `tbl_product`.`pro_service`
    , `tbl_product`.`pro_service_price`
    , `tbl_product`.`pro_stock`
    , `tbl_product`.`pro_photo`
    , `tbl_offer`.`of_name`
    , `tbl_offer`.`of_details`
    , `tbl_offer`.`of_discount`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_sub_category` 
        ON (`tbl_product`.`sc_id` = `tbl_sub_category`.`sc_id`)
    INNER JOIN `db_vsm`.`tbl_company` 
        ON (`tbl_company`.`com_id` = `tbl_product`.`com_id`)
    INNER JOIN `db_vsm`.`tbl_offer` 
        ON (`tbl_offer`.`of_id` = `tbl_product`.`of_id`) where `tbl_product`.`is_delete` = '0' ") or die(mysqli_error($connection));
}
$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
  

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();
if ($row["of_discount"] == 0)
{
                      $discountprice = 0;
    $final = $row["pro_price"];
}
else
{
$final = 0;
$price = $row["pro_price"];
$discount = $row["of_discount"];
$discountprice = ($price * $discount ) /100;
$final = $price - $discountprice;
}
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
         $tmp["of_name"] = $row["of_name"];
         $tmp["of_discount"] = $row["of_discount"];
         $tmp["of_details"] = $row["of_details"];
         $tmp["discount_price"] = $discountprice;
         $tmp["final_price"] = $final;
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
