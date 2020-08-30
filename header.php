<?php
include 'connection.php';

$selectq = mysqli_query($connection, "select * from tbl_admin where ad_id= {$_COOKIE['adminid']}")or die(mysqli_error($connection));
$row = mysqli_fetch_array($selectq);
$name = $row['ad_name'];
?>


<header class="prtm-header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <button class="c-hamburger c-hamburger--htra prtm-bars pull-right"> <span>toggle menu</span> </button>
                <div class="prtm-logo">
                    <a class="navbar-brand" href="index.php"> VS Musicals </a> 
                </div>
            </div>  
            <div id="navbar" class="navbar-collapse collapse" data-hover="dropdown">
                <div class="col-md-8">
                    <br>
                    <center><label style="background:none;border: none;font-size: 20pt; color: white;"> <?php echo $headermsg; ?></label></center>
                </div>
                <ul class="nav navbar-nav navbar-right">
                 
                    <li class="dropdown"> <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $row['ad_name']; ?>
                          <span class="caret"></span></a>
                        <ul class="dropdown-menu">  
                            <li><a href="change-password.php"><i class="fa fa-gears"></i> Change Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-power-off"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>