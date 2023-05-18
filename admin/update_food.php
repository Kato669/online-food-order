<?php include_once('partials/header.php') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "select * from tbl_food where id=$id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count ==1){
        $row= mysqli_fetch_assoc($res);
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    }
}else{
    header('Location: manage-food.php');
}
 ?>

<div class="main-content">
    <div class="wrapper">
        <table>
        <form action="" method="POST" enctype="multipart/form-data">
            <tr>
                <td><label for="">Title</label></td>
                <td>
                    <input type="text" name="title" class="form-group" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td><label for="">Description</label></td>
                <td>
                    <input type="text" name="description" class="form-group" value="<?php echo $description; ?>">
                </td>
            </tr>
            <tr>
                <td><label for="">Price</label></td>
                <td>
                    <input type="text" name="price" class="form-group" value="<?php echo $price; ?>">
                </td>
            </tr>
            <br>
            <tr>
                <td>
                    <label for="">Current image</label>
                </td>
                <td>
                    <?php
                        if($image !=''){
                            ?>
                            <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image?>" alt="" style="width: 150px; height: 70px;">
                            <?php
                        }else{
                            echo 'image not found';
                        }
                    ?>
                </td>
            </tr>
            <br>
            <tr>
                <td><label for="">new image</label></td>
                <td>
                    <input type="file" name="image_name" id="">
                </td>
            </tr>
            <br>
            <tr>
                <td>
                    <label for="">featured</label>
                </td>
                <td>
                    <input <?php if($featured == 'yes'){ echo "checked"; }?> type="radio" name="featured" id="yes" value="yes"><label for="yes">Yes</label>
                    <input <?php if($featured == 'no'){ echo "checked"; }?> type="radio" name="featured" id="no" value="no"><label for="no">no</label>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">active</label>
                </td>
                <td>
                    <input type="radio" <?php if($active == 'yes'){ echo "checked"; }?> name="active" id="Yes" value="yes"><label for="Yes">Yes</label>
                    <input type="radio" <?php if($active == 'no'){ echo "checked"; }?> name="active" id="No" value="no"><label for="No">No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $image ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="submit" class="btn btn-success" value="update category" name="submit">
                </td>
            </tr>
        </form>
        </table>
        
    </div>
</div>
<?php

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $title1 = $_POST['title'];
        $description1 = $_POST['description'];
        $price1 = $_POST['price'];
        $featured1 = $_POST['featured'];
        $active1 = $_POST['active'];
        // $image_name = $_POST['image_name'];
        $current_image = $_POST['current_image'];
        //working on the image
        if(isset($_FILES['image_name']['name'])){
            //the data i need
            //1. image name, 
            //2. image source 
            //3. destination

            //image name
            $image_name = $_FILES['image_name']['name'];
            if($image_name !=""){
                //rename image
                $ext = end(explode('.', $image_name));
                $image_name = "food_image". rand(000, 999). '.'.$ext;
                //2. image source
                $img_src = $_FILES['image_name']['tmp_name'];
                //3. destination
                $img_destination = '../images/food/'.$image_name;
                //upload image
                $upload = move_uploaded_file($img_src, $img_destination);
                if($upload == false){
                    $_SESSION['failed'] = "image failed to upload";
                    header("Location: manage-food.php");
                    die();
                }
                if($current_image != ''){
                    //delete image if exits
                    //image path
                    $path = "../images/food/".$current_image;
                    $remove = unlink($path);
                    if($remove == false){
                        $_SESSION['imgfailed'] = 'image failed';
                        header("manage-category.php");
                        die();
                    }

                }
            }else{
                $image_name = $current_image;
            }

        }else{
            $image_name = $current_image;
        }
        //working on the image ends

        $sql1 = "update tbl_food SET
        title = '$title1',
        description = '$description1',
        price = '$price1',
        title = '$title1',
        image_name = '$image_name',
        featured = '$featured1',
        active = '$active1'
        WHERE
        id = '$id'
        ";
        //execute the querry
        $res1 = mysqli_query($conn, $sql1);
        if($res1 == true){
            $_SESSION['category'] = "<div class='success'>Admin updated successfully</div>";
            header('Location: manage-food.php');
        }else{
            $_SESSION['failedcategory'] = "food failed to food";
            header('Location: manage-food.php');
        }
    }

?>

<?php include_once('partials/footer.php') ?>