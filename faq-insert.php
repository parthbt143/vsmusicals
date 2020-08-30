<?php
include 'connection.php';

$headermsg ="Insert New FAQ";
if (isset($_POST['insert'])) {

    $product = mysqli_real_escape_string($connection, $_POST['product']);
    $que = mysqli_real_escape_string($connection, $_POST['question']);
    $ans = mysqli_real_escape_string($connection, $_POST['answer']);
    $q = mysqli_query($connection, "insert into tbl_faq (pro_id,faq_que,faq_ans) values('{$product}','{$que}','{$ans}')") or die(mysqli_error($connection));



    if ($q) {

        header("location:faq-display.php");
    }
}
?>
<html class="no-js" lang="en">
    <?php include'headFile.php' ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>

            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">

                     
                        <form class="form-group"  method="post">
   <div class="form-group">
                            <div class="row mrgn-all-none">
                                <label class="col-sm-2 control-label"> Product </label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="product" req="yes">

                                        <option> Select Product  </option>


                                     
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_product where is_delete='0' ") or die (mysqli_error($connection));
                           while($cat = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$cat['pro_id']}> {$cat['pro_name']}</option>";
                     }
                    echo "  </select>";
        ?>

                                    </select>
                                </div>
                            </div>
                        </div>




                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label  class="col-sm-2 control-label">Question </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="question" placeholder="Question" type="text" required="yes">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label  class="col-sm-2 control-label">Answer </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="answer" placeholder="Answer" type="text" required="yes">
                                    </div>
                                </div>
                            </div>


                            <input type="submit" class="btn btn-primary btn-rounded" name="insert">
                            <input type="Reset" class="btn btn-primary btn-rounded" name="reset">


                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include'script.php' ?>
    </body>
</html>