<?php
    include_once('frontend_partials/header.php')
?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
 <!-- work on categories -->
 <?php
                $sql = "select * from tbl_category where active ='yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $image = $row['image_name'];
                        $title = $row['title'];
                        ?>
                             <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image != ''){
                                            ?>
                                               <img src="<?php echo SITEURL; ?>images/category/<?php echo $image; ?>" alt="Pizza" class="img-responsive img-curve" height="400px">
                                            <?php

                                        }else{
                                            echo "no image";
                                        }
                                    ?>
                                  
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                                </a>
                        <?php
                    }
                }
            ?>
           

           
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php
    include_once('frontend_partials/footer.php')
?>