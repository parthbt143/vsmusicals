`<?php
//Require File Name 
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student
if(isset($_POST['adm_id'])){
            $adm = mysqli_real_escape_string($connection,$_POST['adm_id']); 
        $query = mysqli_query($connection, "SELECT
    `tbl_admission`.`batch_id`
    , `tbl_schedule`.`s_day`
    , `tbl_schedule`.`s_start`
    , `tbl_schedule`.`s_end`
FROM
    `db_vsm`.`tbl_admission`
    INNER JOIN `db_vsm`.`tbl_batch` 
        ON (`tbl_admission`.`batch_id` = `tbl_batch`.`batch_id`)
    INNER JOIN `db_vsm`.`tbl_schedule` 
        ON (`tbl_schedule`.`batch_id` = `tbl_batch`.`batch_id`) where `tbl_admission`.`adm_id` = '{$adm}' ") or die(mysqli_error($connection));
 

}else
{
     $query = mysqli_query($connection, "SELECT
    `tbl_admission`.`batch_id`
    , `tbl_schedule`.`s_day`
    , `tbl_schedule`.`s_start`
    , `tbl_schedule`.`s_end`
FROM
    `db_vsm`.`tbl_admission`
    INNER JOIN `db_vsm`.`tbl_batch` 
        ON (`tbl_admission`.`batch_id` = `tbl_batch`.`batch_id`)
    INNER JOIN `db_vsm`.`tbl_schedule` 
        ON (`tbl_schedule`.`batch_id` = `tbl_batch`.`batch_id`) where `tbl_admission`.`is_delete`=0 ") or die(mysqli_error($connection));
 
}
$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
 

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["batch_id"] = $row["batch_id"];
         $tmp["s_day"] = $row["s_day"];
         $tmp["s_start"] = $row["s_start"];
         $tmp["s_end"] = $row["s_end"];
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