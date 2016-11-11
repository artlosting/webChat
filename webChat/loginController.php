<?php
    //接收用户名和密码
    $password=$_POST['password'];
    $username=$_POST['username'];
    if($password==123){
        header("Location:chatView.php?username=$username");
    }else{
        header("Location:login.php");
    }
    
    
?>