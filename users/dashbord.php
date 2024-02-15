<head>
    <link rel="stylesheet" href="style.css">
</head>
<?php
include "../admin/mysql-proc.php";
if (isset($_SESSION['user'])) {
?>
    <h3 style="color: blue; margin-top: 10px; text-align: center;font-size: x-large; text-transform: uppercase;"><?php $username = $_SESSION['name'];
                                                                                                                    echo $username; ?> THIS IS CLIENT PANEL FOR FILM </h3>
    <div class="main-cards">

        <div class="admins">
            <center><img src="image/icons8-staff-64.png" alt=""></center>
            <h5>DRAMA MOVIES</h5>
            <?php
            $count = "SELECT * FROM `film` WHERE `theme`='DRAMA'";
            $cout = mysqli_query($conn, $count);
            $showrows = mysqli_num_rows($cout);
            echo " <h5>$showrows</h5>";
            ?>
        </div>
        <div class="admins">
            <center><img src="image/icons8-student-male-48.png" alt=""></center>
            <h5>EDUCATION MOVIES</h5>
            <?php
            $count = "SELECT * FROM `film` WHERE `theme`='Education'";
            $cout = mysqli_query($conn, $count);
            $showrows = mysqli_num_rows($cout);
            echo " <h5>$showrows</h5>";
            ?>
        </div>
        <div class="admins">
            <center><img src="image/icons8-staff-64.png" alt=""></center>
            <h5>COMEDY</h5>
            </a>
            <?php

            $count = "SELECT * FROM film WHERE `theme`='COMEDY'";
            $cout = mysqli_query($conn, $count);
            $showrows = mysqli_num_rows($cout);
            echo " <h5>$showrows</h5>";
            ?>
        </div>
        <div class="admins">

            <center><img src="image/icons8-request-48.png" alt=""></center>
            <h5>ADVOCAY </h5>
            <?php
             $count = "SELECT * FROM film WHERE `theme`='Advocay'";
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