<?php
include("mysql-proc.php");
session_start();
$active=$_GET['active'];
$sql="UPDATE users set `status`='ACTIVE' WHERE email='$active'";
$excute=mysqli_query($conn,$sql);
if($excute){
    header("location:index.php?pages=staffs");
    $msg= '<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert"
    aria-hidden="true">
    &times;
    </button>
    Success! Active.
   </div>
    '
    ;
    $pop=$_SESSION['pop']= $msg;
    
}
    
    
else{
    $pop1 ='<script>
    alert("USER NOT ACTIVETED");
    </script> ';
    $pop=$_SESSION['pop']= $pop1;
}
?>