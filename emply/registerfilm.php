<?php
include "mysql-proc.php";
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
            <H1>ADD FILMS</H1>
            <?php
            if (isset($_SESSION['pop1'])) {
                $mess = $_SESSION['pop1'];
                unset($_SESSION['pop1']);
                echo $mess;
            }

            ?>
            <div class="cont">
                <div class="right" style="width: 50%;">
                    <label for="">TITLE</label>
                    <input type="text" name="uname" id="" autocomplete="off">
                    <label for="">PRODUCER</label>
                    <input type="text" name="pro" id="" autocomplete="off">

                    <label for="">PRODUCTION YEAR</label>
                    <input type="date" name="produ" id="" autocomplete="off">

                    <label for="">PRICE</label>
                    <input type="text" name="price" id="" autocomplete="off">

                    <label for="">THEME</label>
                    <select name="theme" id="">
                        <option value="drama">DRAMA</option>
                        <option value="comed">COMEDY</option>
                        <option value="adventure">Adventure</option>
                        <option value="advocay">Edvocay</option>
                        <option value="education">Eduction</option>
                    </select>

                </div>

            </div>

            <button type="submit" name="Register" class="btn">Register</button>
        </form>
    </div>
</body>





<?php


if (isset($_POST['Register'])) {
    $name = addslashes($_POST['uname']);
    $pro = addslashes($_POST['pro']);
    $produ = addslashes($_POST['produ']);
    $price = addslashes($_POST['price']);
    $theme = addslashes($_POST['theme']);


    $error = array();

    if (empty($name)) {
        $error['err'] = "Title Can't be blank ";
        $_SESSION['uname'] = $error['err'];
    }
    if (empty($pro)) {
        $error['err'] = "Producer  Can't be blank";
        $_SESSION['pro'] = $error['err'];
    }
    if (empty($produ)) {
        $error['err'] = "Production year Can't be blank ";
        $_SESSION['produ'] = $error['err'];
    }
    if (empty($price)) {
        $error['err'] = "Price  Can't be blank ";
        $_SESSION['price'] = $error['err'];
    }

    if (empty($theme)) {
        $error['err'] = "Theme  Can't be blank ";
        $_SESSION['theme'] = $error['err'];
    }


    if (count($error) == 0) {

        $checkuser1 = "SELECT * FROM film WHERE Title='$name'";
        $exc = mysqli_query($conn,  $checkuser1);
        if (mysqli_num_rows($exc) > 0) {
            $_SESSION['pop1'] = "Film is arledy registed";
        } else {

            $checkuser = "INSERT INTO `film` (`Title`, `producer`, `theme`, `year_prod`, `price`, `status`) VALUES ('$name', '$pro', '$theme', '$produ', '$price','Available')";

            $exc = mysqli_query($conn,  $checkuser);
            if ($exc) {
                $msg = '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">
                &times;
                </button>
                Film registed succefull.....!
               </div>
                ';
                $pop = $_SESSION['pop1'] = $msg;
            } else {
                $pop1 = '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">
                &times;
                </button>
                Film unsuccesfull registed.....!
               </div>
                ';
                $pop = $_SESSION['pop1'] = $pop1;
            }
        }
    }
}

?>