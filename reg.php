<?php
session_start();
require_once "class.user.php";

if(isset($_POST['submit-form'])) 
    {
    $user= new User();
    $db= new DB();
    
    $login = trim($_POST['username']);
    $pass = trim($_POST['password']);
    $real_name = trim($_POST['real_name']);
    $email = trim($_POST['email']);
    $birth= "{$_POST['year']}-{$_POST['month']}-{$_POST['day']}";
    $country = $_POST['country'];
    

    $adduser=$user->RegUser($login,$pass,$email,$birth,$country,$real_name);
    if($adduser=='0')
        {
        $user->Login($login,$pass); 
        header ("Location: protected.php");
        exit();
        }
    }

?>
	


<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <div class="wrapper">
        <?php 
        if($adduser!=='0') echo '<h1><font color=red>'.$adduser.'<font/><h1><br/>';
        ?>
        <form action="reg.php" class="login-form" method="post">
            <h1>E-Mail:</h1> 
            <input type="text" class="input-reg" value="<? echo $email; ?>" name="email" />
            <h1>Login:</h1> 
            <input type="text" class="input-reg" value="<? echo $login; ?>" name="username" />
            <h1>Real Name:</h1>
            <input type="text" class="input-reg" value="<? echo $real_name; ?>" name="real_name" />
            <h1>Password:</h1>
            <input type="password" class="input-reg" value="" name="password" />
            <h1>Birthdate</h1><br/>
            <center>
                Year <select name="year" class="openlist">
                    <?
                    for ($x = 2015; $x > 1950; $x--)
                    {
                        echo "<option value=$x>$x</option>";
                    } 
                    ?>

                </select>
                
                Month <select name="month" class="openlist">
                    <?
                    for ($x = 1; $x <= 12; $x++)
                    {
                        echo "<option value=$x>$x</option>";
                    } 
                    ?>
                </select>
                
                Day <select name="day" class="openlist">
                    <?
                    for ($x = 1; $x <= 31; $x++)
                    {
                        echo "<option value=$x>$x</option>";
                    } 
                    ?>
                </select>
                <h1>Contry: </h1>
                 <select name="country" class="opencountrylist">
                     <?
                     $db = new DB();
                     $db->ChoseCountry();
                     ?>
                 </select>
            
            </center><br/>
 
            <h1>I agree with site rules    
                <input type="checkbox" onclick="document.getElementById('submit').disabled=!document.getElementById('submit').disabled;"/><br/>
                <button id="submit" class="submit" name="submit-form" type="submit" disabled="disabled">Send</button></h1>
        </form>
    </div>
        <center>
            [<a href="index.php">AUTH</a>]
            [<a href="reg.php">REGISTRATION</a>]
            [<a href="protected.php">PROTECTED PAGE</a>]
        </center>
</body>
</html>
