<?php  
if(isset($_SESSION['user'])){
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <nav class="navbar navbar-default" role="navigation" >
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">FILM STORE</a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
            <li ><a href="#" style="text-transform: uppercase; color:black;">WELCOME <?php  $username=$_SESSION['name']; echo $username; ?></a></li>
                <li class="active"><a href="logout.php" style="color: red;">LOGOUT</a></li>
                
            </ul>
        </div>
    </nav>

</body>

</html>
<?php
}else{
    header("location:../index.php");
}
?>
