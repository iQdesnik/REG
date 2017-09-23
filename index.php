<?php
session_start();
require_once "class.user.php";
$user= new User();

if(isset($_GET['logout'])) 
    { 
    $user->Logout();
    }

if(isset($_POST['submit-form'])) 
    {
    $login = $_POST['username'];
    $pass = $_POST['password'];
    $auth=$user->Login($login,$pass);
        if($auth=='0')
            {
            header("Location: protected.php");
            }
    }

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Auth</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <div class="wrapper">
        <?php 
        if($auth!=='0') echo '<h1><font color=red>'.$auth.'<font/><h1><br/>';
        ?>
        <form action="index.php" class="login-form" method="post"/>
        <h1>Login or Email:<h1/>
            <div>
                <input type="text" class="input" value="" name="username" />
            </div>
        <h1>Password:<h1/>
                <div>
                    <input type="password" class="input" value="" name="password" />
                </div>
        <input type="submit" class="submit" value="Auth" name="submit-form" />
        </form>
		</div>

        <center>
            [<a href="index.php">AUTH</a>]
            [<a href="reg.php">REGISTRATION</a>]
            [<a href="protected.php">PROTECTED PAGE</a>]
        </center>


</body>
</html>

