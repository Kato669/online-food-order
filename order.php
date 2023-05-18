<?php
    include_once('frontend_partials/header.php')
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            <?php 
            if(isset($_GET['order_id'])){
                $id = $_GET['order_id'];
            }else{
                header('Location'.SITEURL);
            }
            ?>
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend>Selected Food</legend>
                    <?php
                        $sql = "select * from tbl_food where id = $id";
                        //execute the query
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $price = $row['price'];
                       
                        $image = $row['image_name'];
                    ?>
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
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price">$<?php echo $price ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        <input type="hidden" name="title" value='<?php echo $title ?>'>
                        <input type="hidden" name="price" value='<?php echo $price ?>'>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Nampijja Margaret" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 256 788*******" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. food@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
    if(isset($_POST['submit'])){
        $title1 = $_POST['title'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $status = 'ordered';
        $fullName = $_POST['full-name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $total = $price * $qty;

        if(is_numeric($contact) && !is_numeric($fullName)){
            $sql1 = "Insert into tbl_order set
                food = '$title1',
                price = $price,
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$fullName',
                customer_contact = $contact,
                customer_email = '$email',
                customer_address = '$address'
            ";
            $execute = mysqli_query($conn, $sql1);
            if($execute == true){
                $_SESSION['ordered'] = "order submitted successfully";
                header("Location: index.php");
            }
        }else{
            echo '
                <script type="text/javascript">
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"}
                    Command: toastr["error"]("order not submitted, check entries and try again");
                </script>
                ';
        }
    }
    ?>

    <?php
    include_once('frontend_partials/footer.php')
?>