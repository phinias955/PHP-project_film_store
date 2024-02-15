<?php
session_start();
include "admin/mysql-proc.php";


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER-USER</title>
    <link rel="stylesheet" href="style.css">
</head>





<body style="background-color: whitesmoke;"></body>
<div class="container">
    <form action="#" method="post" class="form">
        <br>
        <center>
            <h2 class="title">REGISTER TO VIEW FILM</h2>
            <center>
                <?php if (isset($_SESSION['match'])) {
                    $txt =  $_SESSION['match'];
                    unset($_SESSION['match']);
                    echo $txt;
                } ?>
            </center>
        </center>
        <div class="main">
            <div class="label">
                <label for="">USERNAME</label>
            </div>
            <div class="input">
                <input type="text" name="uname" id="" value="<?php
                                                                if (isset($_POST['uname']))
                                                                    echo $_POST['uname'];
                                                                ?>">

                <?php if (isset($_SESSION['uname'])) {
                    $txt = $_SESSION['uname'];
                    unset($_SESSION['uname']);
                    echo $txt;
                } ?>


            </div>
        </div>

        <div class="main">
            <div class="label">
                <label for="">EMAIL</label>
            </div>
            <div class="input">
                <input type="text" name="email" id="" value="<?php
                                                                if (isset($_POST['email']))
                                                                    echo $_POST['email'];
                                                                ?>">
                <?php if (isset($_SESSION['email'])) {
                    $txt = $_SESSION['email'];
                    unset($_SESSION['email']);
                    echo $txt;
                } ?>
            </div>
        </div>

        <div class="main">
            <div class="label">
                <label for="">PHONE</label>
            </div>
            <div class="input">
                <input type="text" name="phone" id="" value="<?php
                                                                if (isset($_POST['phone']))
                                                                    echo $_POST['phone'];
                                                                ?>">
                <?php if (isset($_SESSION['phone'])) {
                    $txt = $_SESSION['phone'];
                    unset($_SESSION['phone']);
                    echo $txt;
                } ?>
            </div>
        </div>

        <div class="main">
            <div class="label">
                <label for="">GENDER</label>
            </div>
            <div class="input">
                <select name="gender" id="">
                    <option value=""><?php if (isset($_POST['gender'])) echo $_POST['gender']; ?></option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                </select>
                <?php if (isset($_SESSION['gender'])) {
                    $txt = $_SESSION['gender'];
                    unset($_SESSION['gender']);
                    echo $txt;
                } ?>
            </div>
        </div>

        <div class="main">
            <div class="label">
                <label for="">AGE</label>
            </div>
            <div class="input">
                <input type="text" name="age" id="" value="<?php
                                                            if (isset($_POST['age']))
                                                                echo $_POST['age'];
                                                            ?>">
                <?php if (isset($_SESSION['age'])) {
                    $txt = $_SESSION['age'];
                    unset($_SESSION['age']);
                    echo $txt;
                } ?>
            </div>
        </div>


        <div class="main">
            <div class="label">
                <label for="">PASSWORD</label>
            </div>
            <div class="input">
                <input type="password" name="pass" id="">
                <?php if (isset($_SESSION['pas1'])) {
                    $txt = $_SESSION['pas1'];
                    unset($_SESSION['pas1']);
                    echo $txt;
                } ?>
            </div>
        </div>

        <div class="main">
            <div class="label">
                <label for="">RETYPE PASSWORD</label>
            </div>
            <div class="input">
                <input type="password" name="pass2" id="">
                <?php if (isset($_SESSION['pas'])) {
                    $txt = $_SESSION['pas'];
                    unset($_SESSION['pas']);
                    echo $txt;
                } ?>
            </div>
        </div>

        <div class="main">

            <div class="input">
                <button type="submit" class="btn1" name="sub">REGISTER</button><br>
                <br>
                <a href="index.php" style="color: blue; text-decoration: none; font-weight: bolder;">Click Login</a>
            </div>
        </div>
    </form>
</div>

</body>

</html>

<?php


if (isset($_POST['sub'])) {
    $name = addslashes($_POST['uname']);
    $email = addslashes($_POST['email']);
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];

    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];

    $error = array();

    if (empty($name)) {
        $error['err'] = "Username Can't be blank ";
        $_SESSION['uname'] = $error['err'];
    }
    if (empty($email)) {
        $error['err'] = "Email  Can't be blank";
        $_SESSION['email'] = $error['err'];
    }
    if (empty($phone)) {
        $error['err'] = "Phone  Can't be blank ";
        $_SESSION['phone'] = $error['err'];
    }
    if (empty($gender)) {
        $error['err'] = "Gender  Can't be blank ";
        $_SESSION['gender'] = $error['err'];
    }
    if (empty($age)) {
        $error['err'] = "Age  Can't be blank ";
        $_SESSION['age'] = $error['err'];
    }

    if (empty($pass)) {
        $error['err'] = "Password  Can't be blank ";
        $_SESSION['pas1'] = $error['err'];
    }
    if (empty($pass2)) {
        $error['pass'] = "Repeat password  Can't be blank ";
        $_SESSION['pas'] = $error['pass'];
    }
    if ($pass != $pass2) {
        $error['err'] = "Password not match ";
        $_SESSION['match'] = $error['err'];
    }

    if (count($error) == 0) {
        $checkuser = "SELECT * FROM users WHERE email='$email' or phone='$phone'";
        $exc = mysqli_query($conn,  $checkuser);
        if (mysqli_num_rows($exc) > 0) {
            $_SESSION['match'] = "Email or Phone used is arledy registed";
        } else {
            $status = "Active";
            $passmd = md5($pass);
            $sql = "INSERT INTO `users` 
        (`username`, `password`, `role`, `phone`, `gender`, `age`, `email`, `status`) 
        VALUES ('$name','$passmd','Client','$phone','$gender','$age','$email','$status')";

            $excute = mysqli_query($conn, $sql);
            if ($excute) {
                $_SESSION['match'] = "Client user is registed";
                sleep(5);
                header("location:index.php");
            } else {
                $_SESSION['match'] = "Client not registered try again";
            }
        }
    }
}

?>