<link rel="stylesheet" href="style.css">

<style>
    body {
        background-color: whitesmoke;
    }

    .back {
        background-color: wheat;
        width: 50%;
        transform: translate(50%);
        padding: 20px;
        margin-top: 10%;
        border-radius: 10px;
        height: 50vh;
    }

    label {
        font-family: sans-serif;
        font-weight: bold;
        text-transform: uppercase;
        padding: 10px;
    }

    input{
        padding: 10px;
        display: block;
        outline: none;
        width: 100%;
        border: none;
        font-family: sans-serif;
    }
    .pass {
        display: flex;
    }
    .email{

        width: 20%;
        padding: 10px;
    }
    .inp{

        width: 80%;
    }
    .btn{
        margin-top: 30px;
        margin-left: 30%;
        padding: 10px;
        width: 35%;
        outline: none;
        border: none;
        font-size: large;
        color: blue;
    }
    .select{
        width: 80%;
        padding: 10px;
        border: none;
        outline: none;
    }
</style>
<?php
include "admin/mysql-proc.php";
session_start();
?>
<div class="back">
    <form action="#" method="post" class="form">

        <h1 style="color: blue; text-align: center; margin: 15px 10px; text-transform: uppercase;">LOGIN portal</h1>
        <div class="pass">
            <div class="email">
                <label for="" class="lab">email</label>
            </div>
            <div class="inp">
                <input type="text" name="email" id="" class="inp" autocomplete="off" placeholder="user@gmail.com"><br>
            </div>
        </div>

        <div class="pass">
            <div class="email">
                <label for="" class="lab">password</label>
            </div>
            <div class="inp">
                <input type="password" name="pass" id="" class="inp"><br>
            </div>
        </div>
<!-- 
        <div class="pass">
            <div class="email">
                <label for="" class="lab">ROLE</label>
            </div>
            <div class="inp">
            <select name="utype" id="" class="select">
                <option value="Admin">Admin</option>
                <option value="Employee">Employee</option>
                <option value="Client">Client</option>
            </select>
            </div>
        </div> -->
        <button type="submit" name="login" id="" value="login" class="btn">LOGIN</button><br><br>
        <a href="registration.php" style="margin-left: 20px;">Register an account to login</a>
    </form>
</div>
<?php
if (isset($_POST['login'])) {
    $email = addslashes(mysqli_real_escape_string($conn, $_POST['email']));
    $itype = mysqli_real_escape_string($conn, $_POST['utype']);
    $pass = addslashes(md5(mysqli_real_escape_string($conn, $_POST['pass'])));


    $sql = $conn->query("SELECT * FROM users WHERE email='$email' and `password`='$pass'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_array($sql);
        $user1 = $row["email"];
        $user2 = $row["username"];
        $role = $row["role"];
        $status = $row['status'];
        $_SESSION['id']=$row["email"];

        if ($_SESSION['user'] = $user1 && $role == "Admin") {

            if ($status == "Active" || $status == "ACTIVE") {
                $_SESSION['name'] = $user2;
                $_SESSION['email']=  $user1 ;
                header("location:admin/index.php?pages=dashbord");
            } else {
                echo '<script>alert("Contact Admin to Activet"); </script> ';
                exit();
            }
        }
        if ($_SESSION['user'] = $user1 && $role == "Client") {
            if ($status == "Active" || $status == "ACTIVE") {
                $_SESSION['name'] = $user2;
                $_SESSION['email']=  $user1 ;
                header("location:users/user.php?pages=dashbord");
            } else {
                echo '<script> alert("Contact Admin to Activet"); </script> ';
                exit();
            }
        }
        if ($_SESSION['user'] = $user1 && $role == "Employee") {
            if ($status == "Active" || $status == "ACTIVE") {
                $_SESSION['name'] = $user2;
                $_SESSION['email']=  $user1 ;
                header("location:emply/index.php?pages=dashbord");
            } else {
                echo '<script>alert("Contact Admin to Activet");</script> ';
                exit();
            }
        }
    } else {
        echo '<script>
        alert("USER NAME AND PASSWORD THEY NOT MATCH");
        </script> ';
        exit();
    }
    mysqli_close($conn);
}
?>