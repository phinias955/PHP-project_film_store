<head>
    <link rel="stylesheet" href="style.css">
</head>
<?php
include "mysql-proc.php";
if (isset($_SESSION['user'])) {
?>
    <h3 style="color: blue; margin-top: 10px; text-align: center;font-size: x-large; text-transform: uppercase;"><?php $username = $_SESSION['name'];
                                                                                                                    echo $username; ?> THIS IS ADMIN PANEL FOR ADMINISTRATION ONLY</h3>
    <div class="main-cards">

        <div class="admins">
            <center><img src="image/icons8-staff-64.png" alt=""></center>
            <h5>registed admins</h5>
            <?php
            $count = "SELECT * FROM `users` WHERE `role`='Admin'";
            $cout = mysqli_query($conn, $count);
            $showrows = mysqli_num_rows($cout);
            echo " <h5>$showrows</h5>";
            ?>
        </div>
        <div class="admins">
            <center><img src="image/icons8-student-male-48.png" alt=""></center>
            <h5>EMPLOYEE REGISTED</h5>
            <?php
            $count = "SELECT * FROM `users` WHERE `role`='Employee'";
            $cout = mysqli_query($conn, $count);
            $showrows = mysqli_num_rows($cout);
            echo " <h5>$showrows</h5>";
            ?>
        </div>
        <div class="admins">
            <center><img src="image/icons8-staff-64.png" alt=""></center>
            <h5><a href="index.php?pages=staffs">CLIENT MEMBERS</a></h5>
            </a>
            <?php

            $count = "SELECT * FROM users WHERE `role`='Client'";
            $cout = mysqli_query($conn, $count);
            $showrows = mysqli_num_rows($cout);
            echo " <h5>$showrows</h5>";
            ?>
        </div>
        <div class="admins">

            <center><img src="image/icons8-request-48.png" alt=""></center>
            <h5>STORED MOVIES </h5>
            <?php
             $count = "SELECT * FROM film";
             $cout = mysqli_query($conn, $count);
             $showrows = mysqli_num_rows($cout);
             echo " <h5>$showrows</h5>";
            ?>
        </div>
    </div>
<?php
} else {
    header("location:../index.php");
}
?>