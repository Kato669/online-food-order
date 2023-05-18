<?php include_once('partials/header.php') ?>



<?php
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image = $_GET['image_name'];

        if($image !=''){
            $path = "../images/category/".$image;
            $remove = unlink($path);

            if($remove ==  false){
                //display session text
                $_SESSION['category'] = 'image failed to delete';
                //redirect to manage_category.php
                header('Location: manage-category.php');
                //stop the session
                die();
            }

        }

        //sql to delete from category table
        $sql = "delete from tbl_category where id=$id";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //check if the query is executed
        if($res){
            $_SESSION['success'] = "category deleted successfuly";
            header('Location: manage-category.php');
        }
        
    }else{
        header('Location: manage-category.php');
    }
?>
