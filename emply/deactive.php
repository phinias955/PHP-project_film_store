<?php
include("mysql-proc.php");
session_start();
$deactive = $_GET['deactive'];
$sql = "UPDATE users set `status`='Sleep' WHERE email='$deactive'";
$excute = mysqli_query($conn, $sql);
if ($excute) {
    header("location:index.php?pages=staffs");
    $msg = '<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert"
    aria-hidden="true">
    &times;
    </button>
    Deactived Process Success!....
   </div>
    ';
    $pop = $_SESSION['pop'] = $msg;
} else {
    $msg='<script>
    alert("USER NOT UNACTIVETED");
    </script> ';
    $pop=$_SESSION['pop']= $msg;
}
