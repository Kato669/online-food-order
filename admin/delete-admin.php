<link rel="stylesheet" href="../css/style.css">
<?php 
    include_once('partials/constant.php');
    //code to get id
    $id = $_GET['id'];

    //sql code to execute the code
    $sql = "delete from tbl_admin where id =$id";

    $res = mysqli_query($conn, $sql);

    if($res == true){
        //echo success message
        $_SESSION['success'] = "<div class='success'>admin deleted successful</div>";
        header("Location: manage-admin.php");
    }else{
        //echo error message
        echo 'admin failed to delete';
    }
    
?>