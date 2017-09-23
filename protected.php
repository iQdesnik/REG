<?php
session_start();

require_once "class.user.php";

$user= new User;
$data= new DB();
$user->UsersOnly();
$info=$data->select("users","id='{$_SESSION['id']}'", "0");

 ?>

<html>
    <head>
    <meta charset="UTF-8">
    <title>Protected</title>
    <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <div class="wrapper">
        <?
        echo "Hello {$info['username']} ! Your email - {$info['email']}!";
        echo '<br/><a href="index.php?logout">Logout</a><br/>'; 
        ?>
    </div>
        <center>
            [<a href="index.php">AUTH</a>]
            [<a href="reg.php">REGISTRATION</a>]
            [<a href="protected.php">PROTECTED PAGE</a>]
        </center>
</body>
</html>
