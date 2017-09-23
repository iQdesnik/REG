<?php
require_once "class.db.php";
class User 
{


    public function Login($login,$pass) 
    {
        $db = new DB();
        $log_err='0';
        if(($db->select("users","username='{$db->filter($login)}' and password='{$db->filter($pass)}' or email='{$db->filter($login)}' and password='{$db->filter($pass)}'","1"))==0)
            { 
                $log_err='Wrong Login or Password'; 
            }

                if($log_err=='0') 
                    {
                    $userid=$db->select("users","username='$login' or email='$login'","0");
                    $_SESSION['id'] = $userid['id'];
                    $_SESSION['auth']='1';
                    }
        return $log_err;
                
    }
    
        
    public function RegUser($login,$pass,$email,$birth,$country,$real_name)
    {
        $db = new DB();
        $reg_err='0';
        $time= time();
        
        if(strlen($login)<4 or strlen($login)>15)  $reg_err='Error: login length 4-15 characters';
        if(strlen($pass)<4 or strlen($login)>15)  $reg_err='Error: password length 4-15 characters'; 
        if(strlen($real_name)<3 or strlen($real_name)>20)  $reg_err='Error: real name length 3-20 characters';
        if($db->select("users","username='{$db->filter($login)}'",'1')!==0)  $reg_err='Error: login already exist';
        if($db->select("users","email='{$db->filter($email)}'",'1')!==0)  $reg_err='Error: email already exist';
        if(!preg_match("/^[-_a-zA-Z0-9]{1,20}$/",$login)) $reg_err='Error: Restircted symbols in login';
        if(!preg_match("/^[-_a-zA-Z0-9]{1,20}$/",$real_name)) $reg_err='Error: Restircted symbols in real name';
        if(!preg_match("/^[-_a-zA-Z0-9]{1,20}$/",$pass)) $reg_err='Error: Restircted symbols in password';
        if(filter_var($email, FILTER_VALIDATE_EMAIL)==false) $reg_err='Error: wrong email format';
        
        if($reg_err=='0')
            {
            $db->insert( "users" , 'username,password,email,timestamp,birthday,country_id,real_name' , " '$login' , '$pass' , '$email' ,'$time' ,'$birth', '$country' , '$real_name'");
            }
        return $reg_err;
        
    }


    public function UsersOnly () 
    {
        if(!isset($_SESSION['auth']) or $_SESSION['auth']!=='1') 
            {
            echo "This page is for registered users only! You have to  <a href='reg.php'>be registered</a>";
            exit();
            }
    }
            


    public function Logout() 
    {
        unset($_SESSION['id']);
        unset($_SESSION['auth']);
        session_destroy();
    }

}
	
?>