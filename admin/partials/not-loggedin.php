<?php

if(!isset($_SESSION['user'])){
    $_SESSION['notLoggedIn'] = 'login first';
    header('Location: login.php');
}
?>