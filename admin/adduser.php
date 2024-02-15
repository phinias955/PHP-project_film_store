<?php
include "mysql-proc.php";
$_SESSION['user'] = 'phinias';
if (isset($_SESSION['user'])) {
?>

    <head>
        <style>
            .forms input {
                display: block;
                width: 95%;
                padding: 10px;
                outline: none;
            }

            label {
                color: rgb(25, 25, 75);
                font-size: larger;
            }

            select {
                width: 95%;
                padding: 10px;
                outline: none;
                display: block;
            }

            .btn {
                padding: 10px;
                color: white;
                margin-top: 10px;
                background-color: rgb(25, 25, 75);
                outline: none;
                border: none;
            }

            .cont {
                display: flex;
            }
        </style>
    </head>

    <body>
        <div class="forms">
            <?php

            if (isset($_SESSION['match'])) {
                $mess = $_SESSION['match'];
                unset($_SESSION['match']);
                echo $mess;
            }
            ?>

            <form action="#" method="post">
                <H1>REGISTER NEW EMPLOYEE</H1>
                <?php

                if (isset($_SESSION['match'])) {
                    $mess = $_SESSION['match'];
                    unset($_SESSION['match']);
                    echo $mess;
                }
                ?>
                <div class="cont">
                    <div class="right" style="width: 50%;">
                        <label for="">USERNAME</label>
                        <div>
                            <input type="text" name="uname" id="" autocomplete="off" value="<?php
                                                                                            if (isset($_POST['uname']))
                                                                                                echo $_POST['uname'];
                                                                                            ?>">

                        </div>
                        <label for="">Email</label>
                        <input type="email" name="email" id="" autocomplete="off" value="<?php
                                                                                            if (isset($_POST['email']))
                                                                                                echo $_POST['email'];
                                                                                            ?>">
                        <div>
                            <?php if (isset($_SESSION['ema'])) {
                                $txt = $_SESSION['ema'];
                                unset($_SESSION['ema']);
                                echo $txt;
                            } ?>
                        </div>
                        <label for="">Role</label>
                        <select name="role" id="">
                            <option value="">--------</option>
                            <option value="Employee">Employee</option>
                            <option value="Admin">Admin</option>
                        </select><br>
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="" autocomplete="off" value="<?php
                                                                                        if (isset($_POST['phone']))
                                                                                            echo $_POST['phone'];
                                                                                        ?>">
                        <label for="">Gender</label>
                        <select name="sex" id="">
                            <option value="">--------</option>
                            <option value="Male">MALE</option>
                            <option value="Female">FEMALE</option>
                        </select><br>
                        <label for="">AGE</label>
                        <input type="text" name="age" id="" autocomplete="off" value="<?php
                                                                                        if (isset($_POST['age']))
                                                                                            echo $_POST['age'];
                                                                                        ?>">

                    </div>
                    <div class="left" style="width: 50%;">
                        <label for="">Password</label>
                        <input type="password" name="pass" id="" placeholder="username is default password" disabled>

                    </div>

                </div>

                <button type="submit" name="Register" class="btn">Register</button>
                <?php
                //insert process stating over here

                if (isset($_POST['Register'])) {

                    $uname = $_POST['uname'];
                    $email = $_POST['email'];
                    $role = $_POST['role'];
                    $phone = $_POST['phone'];
                    $sex = $_POST['sex'];
                    $aged = $_POST['age'];
                    

                    $error = array();

                    if (empty($uname)) {
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
                    if (empty($sex)) {
                        $error['err'] = "Gender  Can't be blank ";
                        $_SESSION['sex'] = $error['err'];
                    }
                    if (empty($aged)) {
                        $error['err'] = "Age  Can't be blank ";
                        $_SESSION['age'] = $error['err'];
                    }

                    if (empty($role)) {
                        $error['err'] = "Password  Can't be blank ";
                        $_SESSION['role'] = $error['err'];
                    }

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $error['err'] =  '<h6 style="color:red;">Inviled email formart</h6>';
                        $_SESSION['ema'] = $error['err'];
                    }

                    if (isset($uname)) {
                        $namep = $uname;
                    }

                    if (count($error) == 0) {
                        $checkuser = "SELECT * FROM users WHERE email='$email' or phone='$phone'";
                        $exc = mysqli_query($conn,  $checkuser);
                        if (mysqli_num_rows($exc) > 0) {
                            $_SESSION['match'] = '<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true"  style="margin: 10px;">
                            &times;
                            </button>
                            Email or Phone used is arledy registed
                           </div>
                            '
                            ;

                        } else {
                            $status = "Active";
                            $pass = md5($namep);
                            $sql = "INSERT INTO `users` 
                            (`username`, `password`, `role`, `phone`, `gender`, `age`, `email`, `status`) 
                            VALUES ('$uname','$pass','$role','$phone','$sex','$aged','$email','$status')";
                            $excute = mysqli_query($conn, $sql);
                            if ($excute) {
                                $_SESSION['match'] = "Employee user is registed";
                            } else {
                                 $_SESSION['match'] = '<div class="alert alert-success alert-dismissable">
                                 <button type="button" class="close" data-dismiss="alert"
                                 aria-hidden="true"  style="margin-top: 10px;">
                                 &times;
                                 </button>
                                 User not Found.....
                                </div>
                                 '
                                 ;
                            }
                        }
                    }
                }


                ?>
            </form>
        </div>

    </body>
<?php
} else {
    header("location:../index.php");
}
?>