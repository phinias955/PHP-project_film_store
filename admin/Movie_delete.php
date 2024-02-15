<?php
session_start();
$user = $_SESSION['user'];
include("mysql-proc.php");
if (isset($_GET['delete'])) {
    $del = $_GET['delete'];
    $sql = "SELECT * FROM film where FilmId='$del'";
    $excute = mysqli_query($conn, $sql);

    $row=mysqli_fetch_array($excute);

    echo '<center><h4>Do you want to delete user? ' . $row["Title"] . '</h4></center>'

?>
    <form action="#" method="POST">
        <center>
            <input type="submit" name="yes" id="" value="YES">
            <button type="submit" name="no">NO</button>
        </center>
    </form>
<?php
    if (isset($_POST['yes'])) {
        $sql2 = $conn->query("DELETE FROM film where FilmId='$del'");
        $msg = "user was deleted succefully.....";
        header("location:index.php?pages=view_film");
    } elseif (isset($_POST['no'])) {
        header("location:index.php?pages=view_film");
        $msg = "deleted process was terminted by you.....";
    }
}
?>