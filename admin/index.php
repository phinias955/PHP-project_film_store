<?php
session_start();
if (isset($_SESSION['user'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <section>
            <div class="natop">
                <?php
                include('nav-bar.php');


                ?>


            </div>
        </section>
        <?php   $email= $_SESSION['user']; echo $email;?>
        <div class="conta" style="margin-top: -1.5%;">
            <div class="sidebar">
                <?php include('side-nav.php');
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
                if ($page == 'staffs') {
                    include('staffs.php');
                }
                if ($page == 'edit') {
                    include('edit.php');
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
                if ($page == 'view_film') {
                    include('view_film.php');
                }
                if ($page == 'register') {
                    include('registerfilm.php');
                }
                if ($page == 'alluser') {
                    include('alluser.php');
                }
                if ($page == 'update') {
                    include('edit.php');
                }


                ?>
            </div>

        </div>

    </body>

    </html>
<?php
} else {
    header("location:../index.php");
}
?>