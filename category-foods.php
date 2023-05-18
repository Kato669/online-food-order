<?php
    include_once('frontend_partials/header.php')
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
           <?php 
           if(isset($_GET['category_id'])){
            $id = $_GET['category_id'];
            
            $sql = "select title from tbl_category where id = $id";
            $res = mysqli_query($conn, $sql);
            $fetch = mysqli_fetch_assoc($res);
           }
           ?>
            <h2>Foods on <a href="#" class="text-white">"<?php echo $fetch['title'] ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
           <?php
                $select = "select * from tbl_food where category_id = $id";
                $execute = mysqli_query($conn, $select);
                $count = mysqli_num_rows($execute);
                if($count > 0){
                    while($row = mysqli_fetch_assoc($execute)){
                        $id1 = $row['id'];
                        $image = $row['image_name'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image == ''){
                                            echo "no image";
                                        }else{
                                            ?>
                                             <img src="<?php echo SITEURL; ?>images/food/<?php echo $image ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                   
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title ?></h4>
                                    <p class="food-price">$<?php echo $price ?></p>
                                    <p class="food-detail">
                                       <?php echo $description ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?order_id=<?php echo $id1 ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
           ?>
            

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php
    include_once('frontend_partials/footer.php')
?>