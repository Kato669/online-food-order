<?php
session_start();
//creating constants
    define('SITEURL', 'http://localhost/web-design-course-restaurant-master/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD','');
    define('DB_NAME','food_order');

   //execute database
   $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
   $dbname = mysqli_select_db($conn, DB_NAME) or die(mysql_error());

?>