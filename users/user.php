<?php
session_start();
?>
<?php
include "../admin/mysql-proc.php";
if (isset($_SESSION['user'])) {
?>
     <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../admin/plugins/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="../admin/style.css">
    </head>

    <body>
        <section>
            <div class="natop">
                <?php
                include('nav-bar.php');
                ?>
            </div>
        </section>
        <div class="conta" style="margin-top: -1.5%;">
            <div class="sidebar">
                <?php include('sidebar.php');
                ?>
            </div>

            <div class="main-center">
                <?php

                @$page = $_GET['pages'];

                if ($page == "mysql-proc.php" || $page == 'ini.php') {
                    echo "Access denied for the page requested <br>";
                }
                if ($page == 'dashbord') {
                    include('dashbord.php');
                }
                if ($page == 'view') {
                    include('view_film.php');
                }
                if ($page == 'update') {
                    include('update.php');
                }
                if ($page == 'adduser') {
                    include('adduser.php');
                }
                if ($page == 'profile') {
                    include('update_profile.php');
                }
                if ($page == 'password') {
                    include('changepass.php');
                }


                ?>
            </div>

        </div>

    </body>

    </html>
<?php
} else {
    header("location:../admin/login.php");
}
?>