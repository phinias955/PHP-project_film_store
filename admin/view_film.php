<?php
include("mysql-proc.php");

?>

<head>
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <style>
        input {
            padding: 7px;
            outline: none;
            border-left: none;
            border-right: none;
            border-top: none;
            border-bottom: none;
            background-color: wheat;
            border-radius: 5px;
            margin: 10px;

        }

        .sech {
            display: flex;
            padding: 10px;
            margin: 10px;
        }

        .contq {
            padding: 15px;
        }

        .list {
            padding: 10px;
            margin: 10px;
            border: none;
            text-transform: uppercase;
        }
    </style>
</head>
<h1>VIEW FILMS</h1>
<div class="sech">
    <div class="contq">
        <label for="">SEARCH FILM</label>

    </div>
    <div class="serch">
        <form action="#" method="post">
            <input type="search" name="input" id="">
 
            <button type="submit" name="serch" id="" class="btn btn-success">SEARCH</button>
            <button type="submit" name="alldata" id="" class="btn btn-primary">SHOW ALL DATA</button>
        </form>
    </div>
</div>
<?php

if (isset($_SESSION['pop'])) {
    $mess = $_SESSION['pop'];
    unset($_SESSION['pop']);
    echo $mess;
}
?>
<table class="table table-stripe" style="width:90%; margin-top: 2%;" id="example">
    <thead>
        <tr>
            <th>FILM ID</th>
            <th>TITLE</th>
            <th>PRODUCER</th>
            <th>THEME</th>
            <th>PRODUTION YEAR</th>
            <th>PRICE</th>
            <th>STATUS</th>
            <th colspan="3" class="text-center">ACTIONS</th>
        </tr>
    </thead>
    <?php

    if (isset($_POST['serch'])) {
        $data = mysqli_escape_string($conn, $_POST['input']);
        // $cat = $_POST['cat'];
        if (!empty(trim($data))) {

            $sql2 = "SELECT * FROM `film` WHERE Title='$data' OR producer='$data' OR theme='$data' OR year_prod='$data' OR price='$data'";
            $excut2 = mysqli_query($conn, $sql2);

            if (mysqli_num_rows($excut2) > 0) {
                while ($rows = mysqli_fetch_array($excut2)) {
    ?>
                    <div class="row">
                        <tr>
                            <td class="toUppercase"><?php echo $rows['FilmId'] ?></td>
                            <td class="toUppercase"><?php echo $rows['Title'] ?></td>
                            <td class="toUppercase"><?php echo $rows['producer'] ?></td>
                            <td class="toUppercase"><?php echo $rows['theme'] ?></td>
                            <td class="toUppercase"><?php echo $rows['year_prod'] ?></td>
                            <td class="toUppercase"><?php echo $rows['price'] ?></td>
                            <td class="toUppercase"><?php echo $rows['status'] ?></td>
                            <td><button type="submit" class="btn btn-danger "><a href="Movie_delete.php?delete=<?php echo $rows['FilmId'] ?>" class="text-white">DELETE</a></button></td>
                            <td><button type="submit" class="btn btn-success"><a href="movieActiv.php?active=<?php echo $rows['FilmId'] ?>" class="text-white">ACTIVET</a> </button></td>
                            <td><button type="submit" class="btn btn-primary"><a href="edit.php?edit=<?php echo $rows['FilmId'] ?>" class="text-white">EDIT</a></button></td>
                            <td><button type="submit" class="btn btn-primary"><a href="Moviedeactive.php?deactive=<?php echo $rows['FilmId'] ?>" class="text-white">Diactive</a></button></td>
                        </tr>
                    </div>
                <?php

                }
            } else {
                $msg = '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">
                &times;
                </button>
                No resualt of search in database.
               </div>';
                echo $msg;
            }
        } else {

            $msg = '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">
            &times;
            </button>
            Enter keyword to search please.
           </div>';
            echo $msg;
        }
    } elseif (isset($_POST['alldata'])) {

        $sql = "SELECT * FROM `film`";
        $excut = mysqli_query($conn, $sql);

        if (mysqli_num_rows($excut) > 0) {
            while ($rows = mysqli_fetch_array($excut)) {
                ?>
                <div class="row">
                    <tr>
                        <td class="toUppercase"><?php echo $rows['FilmId'] ?></td>
                        <td class="toUppercase"><?php echo $rows['Title'] ?></td>
                        <td class="toUppercase"><?php echo $rows['producer'] ?></td>
                        <td class="toUppercase"><?php echo $rows['theme'] ?></td>
                        <td class="toUppercase"><?php echo $rows['year_prod'] ?></td>
                        <td class="toUppercase"><?php echo $rows['price'] ?></td>
                        <td class="toUppercase"><?php echo $rows['status'] ?></td>
                        <td><button type="submit" class="btn btn-danger "><a href="Movie_delete.php?delete=<?php echo $rows['FilmId'] ?>" class="text-white">DELETE</a></button></td>
                        <td><button type="submit" class="btn btn-success"><a href="movieActiv.php?active=<?php echo $rows['FilmId'] ?>" class="text-white">ACTIVET</a> </button></td>
                        <td><button type="submit" class="btn btn-primary"><a href="edit.php?edit=<?php echo $rows['FilmId'] ?>" class="text-white">EDIT</a></button></td>
                        <td><button type="submit" class="btn btn-primary"><a href="Moviedeactive.php?deactive=<?php echo $rows['FilmId'] ?>" class="text-white">Diactive</a></button></td>
                    </tr>
                </div>
    <?php

            }
        } else {
            $msg = '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">
            &times;
            </button>
            No data found in database!.
           </div>';
            echo $msg;
        }
    }else{
        $sql = "SELECT * FROM `film`";
        $excut = mysqli_query($conn, $sql);

        if (mysqli_num_rows($excut) > 0) {
            while ($rows = mysqli_fetch_array($excut)) {
                ?>
                <div class="row">
                    <tr>
                        <td class="toUppercase"><?php echo $rows['FilmId'] ?></td>
                        <td class="toUppercase"><?php echo $rows['Title'] ?></td>
                        <td class="toUppercase"><?php echo $rows['producer'] ?></td>
                        <td class="toUppercase"><?php echo $rows['theme'] ?></td>
                        <td class="toUppercase"><?php echo $rows['year_prod'] ?></td>
                        <td class="toUppercase"><?php echo $rows['price'] ?></td>
                        <td class="toUppercase"><?php echo $rows['status'] ?></td>
                  
                        <td><button type="submit" class="btn btn-success"><a href="movieActiv.php?active=<?php echo $rows['FilmId'] ?>" class="text-white">Available</a> </button></td>
                        <td><button type="submit" class="btn btn-primary"><a href="edit.php?edit=<?php echo $rows['FilmId'] ?>" class="text-white">EDIT</a></button></td>
                        <td><button type="submit" class="btn btn-primary"><a href="Moviedeactive.php?deactive=<?php echo $rows['FilmId'] ?>" class="text-white">Unvailable</a></button></td>

                        <td><button type="submit" class="btn btn-danger "><a href="Movie_delete.php?delete=<?php echo $rows['FilmId'] ?>" class="text-white">DELETE</a></button></td>
                    </tr>
                </div>
    <?php
   
}
}}
    ?>
</table>
<?php


?>