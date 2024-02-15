<?php
session_start();
if (isset($_SESSION['user'])) {
?>

<?php
$user = $_SESSION['user'];

include("mysql-proc.php");

if (isset($_GET['delete'])) {
    $del = $_GET['delete'];
    if ($user == $del) {
        echo "Cat delete active user";
    } else {
        $sql = "SELECT * FROM users where email='$del'";
        $excute = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($excute);

        echo '<center><h4>Do you want to delete user ' . $row["username"] . '</h4></center>'

?>
        <form action="#" method="POST">
            <center>
                <input type="submit" name="yes" id="" value="YES">
                <button type="submit" name="no">NO</button>
            </center>

        </form>
<?php
        if (isset($_POST['yes'])) {
            $sql2 = $conn->query("DELETE FROM users where email='$del'");
            $msg = "user was deleted succefully.....";
            header("location:index.php?pages=staffs");
        } elseif (isset($_POST['no'])) {
            header("location:index.php?pages=staffs");
            $msg = "deleted process was terminted by you.....";
        }
    }
}
?>
<?php
}else{
    header("location:../index.php");
}
?>