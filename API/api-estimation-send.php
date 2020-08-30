<?php

require 'connection.php';
$response = array();

if (isset($_POST['cust_id']) && isset($_POST['pro_id']) && isset($_POST['est_title']) && isset($_POST['est_description'])) {
    $custid = mysqli_real_escape_string($connection, $_POST['cust_id']);
    $proid = mysqli_real_escape_string($connection, $_POST['pro_id']);
    $title = mysqli_real_escape_string($connection, $_POST['est_title']);
    $description = mysqli_real_escape_string($connection, $_POST['est_description']);

    if (isset($_FILES['file1']['name'])) {
        $filepath = "../estimages/" . time() . $_FILES['file1']['name'];
        $query = mysqli_query($connection,"insert into tbl_estimation(cust_id,pro_id,est_title,est_description,est_photo1) values('{$custid}','{$proid}','{$title}','{$description}','{$filepath}')") or die(mysqli_error($connection)) or die(mysqli_error($connection));
        if ($query) {
            $file = move_uploaded_file($_FILES['file1']['tmp_name'], $filepath);

            if ($file) {
                $response['flag'] = '1';
                $response["message"] = "Record Inserted ";
            } else {
                $response['flag'] = '0';
                $response["message"] = "Error in Query";
            }
        }
    } elseif (isset($_FILES['file1']['name']) && isset($_FILES['file2']['name'])) {
        $filepath1 = "../estimages/" . time() . $_FILES['file1']['name'];
        $filepath2 = "../estimages/" . time() . $_FILES['file2']['name'];
        $query = mysqli_query($connection,"insert into tbl_estimation(cust_id,pro_id,est_title,est_description,est_photo1,est_photo2) values('{$custid}','{$proid}','{$title}','{$description}','{$filepath1}','{$filepath2}')") or die(mysqli_error($connection));
        if ($query) {
            $file1 = move_uploaded_file($_FILES['file1']['tmp_name'], $filepath1);
            $file2 = move_uploaded_file($_FILES['file2']['tmp_name'], $filepath2);

            if ($file1 && $file2) {
                $response['flag'] = '1';
                $response["message"] = "Record Inserted ";
            } else {
                $response['flag'] = '0';
                $response["message"] = "Error in Query";
            }
        }
    } else {
        $query = mysqli_query($connection,"insert into tbl_estimation (cust_id,pro_id,est_title,est_description) values('{$custid}','{$proid}','{$title}','{$description}')")  or die(mysqli_error($connection));
        if ($query) {
            $response['flag'] = '1';
            $response["message"] = "Record Inserted ";
        } else {
            $response['flag'] = '0';
            $response["message"] = "Error in Query";
        }
    }

    if ($query) {
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