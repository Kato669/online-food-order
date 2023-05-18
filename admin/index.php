<?php include('partials/header.php') ?>
    <div class="main-content">
        <div class="wrapper">
            <h2 style="font-weight: 900">DASHBOARD</h2>
           <main>
                <?php
                    $sql = "select * from tbl_category";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>
                <div class="col-4">
                    <h1><?php echo $count ?></h1>
                    <h3>Categories</h3>
                </div>
                <div class="col-4">
                <?php
                    $sql1 = "select * from tbl_admin";
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_num_rows($res1);
                ?>
                    <h1><?php echo $count1 ?></h1>
                    <h3>Admin</h3>
                </div>
                <div class="col-4">
                <?php
                    $sql2 = "select * from tbl_order";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                ?>
                    <h1><?php echo $count2 ?></h1>
                    <h3>Orders</h3>
                </div>
                <div class="col-4">
                    <h1>
                        <?php
                            $select = "select SUM(total) As Total from tbl_order where status='delivered'";
                            $execute = mysqli_query($conn, $select);
                            $fetch = mysqli_fetch_assoc($execute);
                            echo number_format($fetch['Total'], 0);
                        ?>
                    </h1>
                    <h3>Revenues</h3>
                </div>
           </main>
        </div>
    </div>
    <?php include('partials/footer.php') ?>