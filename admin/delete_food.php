<?php
include_once("./partials/constant.php");
if(isset($_GET['id']) && isset($_GET['image_name'])){
    $id = $_GET['id'];
    $image = $_GET['image_name'];

    if($image !=""){
        $path = "../images/food/$image";
        $remove = unlink($path);
        if($remove == false){
            header('Location: manage-food.php');
            die();
        }
    }

    $sql = "delete from tbl_food where id = $id";
    $res = mysqli_query($conn, $sql);
    if($res == true){
        $_SESSION['deleted'] = "food deleted successfully";
        header('Location: manage-food.php');
        
    }else{
        $_SESSION['deletefailed'] = "food failed to delete";
        header('Location: manage-food.php');
    }
}

?>