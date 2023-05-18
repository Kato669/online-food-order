<?php
   include_once('partials/constatnt.php');
   session_destroy();

   header('Location: login.php');
?>