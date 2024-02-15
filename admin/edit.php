<?php
session_start();
if (isset($_SESSION['user'])) {
?>
    <section>

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
                    <?php include('side-nav.php');
                    ?>
                </div>

                <div class="main-center">
                    <?php
                    include("mysql-proc.php");

                    $edit = $_GET['edit'];
                    $lookup = "SELECT * FROM film WHERE FilmId='$edit'";
                    $excute = mysqli_query($conn, $lookup);
                    if (mysqli_num_rows($excute) > 0) {
                        $rowcatch = mysqli_fetch_array($excute);
                        $tit = $rowcatch['Title'];
                        $prod = $rowcatch['producer'];
                        $them = $rowcatch['theme'];
                        $yea = $rowcatch['year_prod'];
                        $pric = $rowcatch['price'];
                        $statu = $rowcatch['status'];
                    }
                    ?>

                    <div class="form container-fluid">

                        <form action="" method="post">
                            <h1>UPDATE FILM</h1>
                            <hr>
                            <div class="form-group row">
                                <?php  
                                if(isset($_SESSION['msg'])){
                                    $messout=$_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                    echo $messout;
                                    // session_destroy($messout);
                                    
                                }
                                
                                ?>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">TITLE</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="USERNAME" name="title" value="<?php echo $tit ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">PRODUCER</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="USERNAME" name="producer" value="<?php echo $prod ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">THEME</label>
                                <div class="col-sm-10">
                                    <select name="theme" id="" style="text-transform: uppercase;" class="form-control">
                                        <option value="<?php echo $them ?>"><?php echo $them ?></option>
                                        <option value="drama">DRAMA</option>
                                        <option value="comed">COMEDY</option>
                                        <option value="adventure">Adventure</option>
                                        <option value="advocay">Edvocay</option>
                                        <option value="education">Eduction</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">YEAR OF PRODUCTION</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="inputEmail3" placeholder="USERNAME" name="year" value="<?php echo $yea ?>">
                                </div>
                            </div>

                            <div class="form-group row" >
                                <label for="inputEmail3" class="col-sm-2 col-form-label">PRICE</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="USERNAME" name="price" value="<?php echo $pric ?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">STATUS</label>
                                <div class="col-sm-10">
                                    <select name="status" id="" class="form-control">
                                        <option value="<?php echo $statu ?>"><?php echo $statu ?></option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" name="update" class="btn btn-primary col-sm-2" style="margin-left: 17%;">UPDATE</button>
                        </form>
                    </div>

                    <?php
                    if (isset($_POST['update'])) {
                        $title = addslashes($_POST['title']);
                        $producer = addslashes($_POST['producer']);
                        $theme = addslashes($_POST['theme']);
                        $year =addslashes( $_POST['year']);
                        $price = addslashes($_POST['price']);
                        $status = addslashes($_POST['status']);

                        $update_film = "UPDATE `film` SET `Title` = '$title', `producer` = '$producer', `price` = '$price ', `status` = '$status',`theme` = '$theme',`year_prod`='$year' WHERE `film`.`FilmId` = $edit;";

                        $excute_insert = mysqli_query($conn, $update_film);
                        if ($excute_insert) {
                            $_SESSION['msg']=
                            '<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">
                            &times;
                            </button>
                            Film update successfully
                           </div>
                            '
                            ;
                            $test=$_SESSION['msg'];
                            
                        } else {
                           
                            $_SESSION['msg']=
                            '<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">
                            &times;
                            </button>
                            Film not update
                           </div>
                            '
                            ;
                            $test=$_SESSION['msg'];
                            
                        }
                    }

                    ?>



                </div>

            </div>

        </body>











    </section>
<?php
} else {
    header("location:../index.php");
}
?>