<?php
    include_once('frontend_partials/header.php')
?>
<style>
    .ordered{
        color: green;
        text-transform: capitalize;
        font-size: 1rem;
        position: absolute;
        left: 45%;
        top: 20%;
        z-index: 1000;
        transform: translateY(-2000%);
        transition: 1s;
    }
    .ordered.active{
        transform: translateY(-20%);
    }
</style>
<h4 class="ordered" id="ordered">
    <?php
        if(isset($_SESSION['ordered'])){
            echo $_SESSION['ordered'];
            unset($_SESSION['ordered']);
        }

    ?>
</h4>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." autoComplete="off" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <!-- work on categories -->
            <?php
                $sql = "select * from tbl_category where active ='yes' and featured='yes' limit 3";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $image = $row['image_name'];
                        $title = $row['title'];
                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image !=''){
                                            ?>
                     <img src="<?php echo SITEURL; ?>images/category/<?php echo $image; ?>" alt="Pizza" class="img-responsive img-curve" height="400px">
                                            <?php
                                        }else{
                                           ?>
                                <span>image not available</span>
                                           <?php
                                        }
                                    ?>
                                   

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
            ?>
            <!-- work on categories ends -->
            



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
                <!-- php  code to fetch data from database starts -->
                <?php
                    $sql1 = "select * from tbl_food where active='yes' and featured='yes'";
                    //execute the query
                    $execute = mysqli_query($conn, $sql1);
                    //count rows
                    $number = mysqli_num_rows($execute);
                    if($number>0){
                        //fetch data from db
                        while($rows = mysqli_fetch_assoc($execute)){
                            $id = $rows['id'];
                            $head = $rows['title'];
                            $description = $rows['description'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name'];
                            ?>
                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                            if($image_name == ''){
                                                echo "no image found!!";
                                            }else{
                                                ?>
                                                    <img src="<?php SITEURL; ?>images/food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                <?php
                                            }
                                        ?>
                                       
                                    </div>

                                    <div class="food-menu-desc">
                                        <h4><?php echo $head; ?></h4>
                                        <p class="food-price">$<?php echo $price ?></p>
                                        <p class="food-detail">
                                            <?php echo $description; ?>
                                        </p>
                                        <br>

                                        <a href="<?php echo SITEURL; ?>order.php?order_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
                            <?php

                        }
                    }

                ?>
                <!-- php  code to fetch data from database ends-->
         

           


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php
    include_once('frontend_partials/footer.php')
?>

<script>
  let ordered = document.getElementById('ordered');
  window.addEventListener('load',()=>{
    ordered.classList.add('active');
  })
  setTimeout(()=> ordered.remove(), 3000);
</script>