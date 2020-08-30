<?php
require 'connection.php';
//Create an Blank Array
$response = array(); //Blank Array
$response["data"] = array(); // Two Dim Array Key will be Student
if(isset($_POST['adm_id'])){
            $adm = mysqli_real_escape_string($connection,$_POST['adm_id']); 
        $query = mysqli_query($connection, " SELECT
    `tbl_admission`.`fees_paid`
    , `tbl_admission`.`fees_remaining`
    , `tbl_admission`.`fees_total`
    , `tbl_fees`.`fee_date`
    , `tbl_fees`.`fee_instalment_amt`
    , `tbl_admission`.`adm_id`
FROM
    `db_vsm`.`tbl_admission`
    INNER JOIN `db_vsm`.`tbl_fees` 
        ON (`tbl_admission`.`adm_id` = `tbl_fees`.`adm_id`)where `tbl_admission`.`adm_id` = '{$adm}' ") or die(mysqli_error($connection));
 

}else
{
     $query = mysqli_query($connection, " SELECT
    `tbl_admission`.`fees_paid`
    , `tbl_admission`.`fees_remaining`
    , `tbl_admission`.`fees_total`
    , `tbl_fees`.`fee_date`
    , `tbl_fees`.`fee_instalment_amt`
    , `tbl_admission`.`adm_id`
FROM
    `db_vsm`.`tbl_admission`
    INNER JOIN `db_vsm`.`tbl_fees` 
        ON (`tbl_admission`.`adm_id` = `tbl_fees`.`adm_id`) where `tbl_admission`.`is_delete`=0 ") or die(mysqli_error($connection));
 
}
$count = mysqli_num_rows($query);

// check for empty result
if ($count > 0) {
 

    while ($row = mysqli_fetch_array($query)) {
        $tmp = array();

         $tmp["fee_date"] = $row["fee_date"];
         $tmp["fee_instalment_amt"] = $row["fee_instalment_amt"];
         $tmp["fees_total"] = $row["fees_total"];
         $tmp["fees_paid"] = $row["fees_paid"];
         $tmp["fees_remaining"] = $row["fees_remaining"];
      
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
