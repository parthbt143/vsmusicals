<?php
function checkuniqueoffer($connection,$pro,$offer){
    $uniqueq = mysqli_query($connection, "select * from tbl_pro_offer where pro_id='{$pro}' && of_id='{$offer}' ") or die(mysqli_error($connection));

    $count = mysqli_fetch_array($uniqueq);

    if ($count > 0) {
        return false;
    } else {
        return true;
    }
};