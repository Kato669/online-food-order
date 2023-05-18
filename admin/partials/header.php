<?php
    include('constant.php');
    include('not-loggedin.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>food order- admin panel</title>
    <link rel="stylesheet" href="../css/admin.css">
     <!-- toast code -->
     <link rel="stylesheet" href="../toarst/toastr.min.css">
    <link rel="icon" href="../images/adminlogo.png">
</head>
<body>
    <div class="menu">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">home</a></li>
                <li><a href="manage-admin.php">admin</a></li>
                <li><a href="manage-category.php">category</a></li>
                <li><a href="manage-food.php">food</a></li>
                <li><a href="manage-order.php">order</a></li>
                <li><a href="<?php echo SITEURL ?>">frontend</a></li>
                <li><a href="<?php echo SITEURL ?>admin/logout.php">logout</a></li>
            </ul>
        </div>
    </div>

    <!-- toastr -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../toarst/toastr.min.js"></script>