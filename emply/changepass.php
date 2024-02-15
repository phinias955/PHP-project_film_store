<?php
include "mysql-proc.php";
if (isset($_SESSION['email'])) {
    $id = $_SESSION['email'];
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
            <form action="#" method="post">
                <H1>CHANGE PASSWORD</H1>

                <?php if (isset($_SESSION['pop0'])) {
                    $txt = $_SESSION['pop0'];
                    unset($_SESSION['pop0']);
                    echo $txt;
                } ?>

                <div class="cont">
                    <div class="right" style="width: 50%;">
                        <label for="">OLD PASSWORD</label>
                        <input type="password" name="old" id="" autocomplete="off">
                        <div>
                            <?php if (isset($_SESSION['oldemp'])) {
                                $txt1 = $_SESSION['oldemp'];
                                unset($_SESSION['oldemp']);
                                echo $txt1;
                            } ?>
                        </div>
                        <label for="">NEW PASSWORD</label>
                        <input type="password" name="new" id="" autocomplete="off">
                        <div>
                            <?php if (isset($_SESSION['newemp'])) {
                                $txt2 = $_SESSION['newemp'];
                                unset($_SESSION['newemp']);
                                echo $txt2;
                            } ?>
                        </div>
                        <label for="">REPEAT PASSWORD</label>
                        <input type="password" name="retype" id="" autocomplete="off">
                        <div>
                            <?php if (isset($_SESSION['ret'])) {
                                $txt3 = $_SESSION['ret'];
                                unset($_SESSION['ret']);
                                echo $txt3;
                            } ?>
                        </div>
                    </div>
                </div>
                <button type="submit" name="update" class="btn">CHANGE PASSWORD</button>

                <div>
                    <?php if (isset($_SESSION['mismach'])) {
                        $txt = $_SESSION['mismach'];
                        unset($_SESSION['mismach']);
                        echo $txt;
                    } ?>


                </div>
            </form>
        </div>

    </body>


    <?php

    if (isset($_POST['update'])) {
        //get POST data
        $old = $_POST['old'];
        $new = $_POST['new'];
        $retype = $_POST['retype'];

        //create a session for the data incase error occurs
        $_SESSION['old'] = $old;
        $_SESSION['new'] = $new;
        $_SESSION['retype'] = $retype;

        $erro = array();
        if (empty($old)) {
            $erro['err'] = "OLD PASSWORD FILED IS EMPTY";
            $_SESSION['oldemp'] = $erro['err'];
        }
        if (empty($new)) {
            $erro['err'] = "NEW PASSWORD FILED IS EMPTY";
            $_SESSION['newemp'] = $erro['err'];
        }
        if (empty($retype)) {
            $erro['err'] = "RETYPE PASSWORD FILED IS EMPTY";
            $_SESSION['ret'] = $erro['err'];
        }
        if ($new != $retype) {
            $erro['err'] = "PASSWORD NOT MACH WITH RETYPE";
            $_SESSION['mismach'] = $erro['err'];
        }
        if (count($erro) == 0) {
            $checkquery = "SELECT `password` FROM users WHERE email='$id'";
            $excute = mysqli_query($conn, $checkquery);
            if (mysqli_num_rows($excute) > 0) {
                $rows = mysqli_fetch_array($excute);
                $testpass = $rows['password'];
                $newpass = md5($new);
                if (md5($old) == $testpass) {
                    $sqlupdate = "UPDATE users SET `password`='$newpass' WHERE email='$id'";
                    $queryexcute = mysqli_query($conn, $sqlupdate);
                    if ($queryexcute) {
                        $msg1 = '<div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">
                        &times;
                        </button>
                        Password Success changed......!
                       </div>
                        ';
                        $pop = $_SESSION['pop0'] = $msg1;
                    } else {
                        $msg1 = '<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">
                        &times;
                        </button>
                        Password not changed......!
                       </div>
                        ';
                        $pop = $_SESSION['pop0'] = $msg1;
                    }
                } else {
                    $msg1 = '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                    &times;
                    </button>
                    New Password Not Match Old Password......!
                   </div>
                    ';
                    $pop = $_SESSION['pop0'] = $msg1;
                }
            }
        } else {
            $msg1 = '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                    &times;
                    </button>
                    Found some errors in the input box fill with correct information......!
                   </div>
                    ';
            $pop = $_SESSION['pop0'] = $msg1;
        }
    }
    ?>
<?php
} else {
    header("location:../index.php");
}
?>