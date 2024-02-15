<?php
include("mysql-proc.php");

?>

<head>
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
</head>
<h1>MANAGE USERS</h1>
<?php

if (isset($_SESSION['pop'])) {
   $mess= $_SESSION['pop'];
   unset($_SESSION['pop']);
   echo $mess;
}
?>
<table class="table table-stripe" style="width:90%; margin-top: 2%;">
    <thead>
        <tr>
            <th>USERNAME</th>
            <th>EMAIL</th>
            <th>ROLE</th>
            <th>PHONE</th>
            <th>GENDER</th>
            <th>DATE REGISTERED</th>
            <th>STATUS</th>
            <th colspan="3" class="text-center">ACTIONS</th>
        </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM users";
    $excut = mysqli_query($conn, $sql);
    if (mysqli_num_rows($excut) > 0) {
        while ($rows = mysqli_fetch_array($excut)) {
    ?>
            <div class="row">
                <tr>
                    <td class="toUppercase"><?php echo $rows['username'] ?></td>
                    <td class="toUppercase"><?php echo $rows['email'] ?></td>
                    <td class="toUppercase"><?php echo $rows['role'] ?></td>
                    <td><?php echo $rows['phone'] ?></td>
                    <td class="toUppercase"><?php echo $rows['gender'] ?></td>
                    <td class="toUppercase"><?php echo $rows['register_date'] ?></td>
                 
                    <td class="toUppercase"><?php echo $rows['status'] ?></td>
                    <td><button type="submit" class="btn btn-danger "><a href="manadel.php?delete=<?php echo $rows['email'] ?>" class="text-white">DELETE</a></button></td>
                    <td><button type="submit" class="btn btn-success"><a href="manaActive.php?active=<?php echo $rows['email'] ?>" class="text-white">ACTIVET</a> </button></td>
                    <td><button type="submit" class="btn btn-primary"><a href="manaDis.php?deactive=<?php echo $rows['email'] ?>" class="text-white">DISABLE USER</a></button></td>
                </tr>
            </div>
    <?php
        }
    }
    ?>
</table>
<?php


?>