<?php
session_start();
$pwd = "57bazen";
if($_SESSION['loggedin'] != $pwd){
        if ($_POST['login'] == $pwd){
                $_SESSION['loggedin'] = $pwd;
        }
        else {
                die("<form method='post' ><input type='password' name='login' /><input type='submit' /></form>");
        }
}



?>