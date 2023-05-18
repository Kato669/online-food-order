<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<?php include_once('partials/header.php') ?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "select * from tbl_order where id = $id";
        $res = mysqli_query($conn, $sql);
        if($res){
            $count = mysqli_num_rows($res);
            if($count == 1){
                $row = mysqli_fetch_assoc($res);
                // $qty = $row['qty'];
                $status = $row['status'];
            }
        }
    }else{
        header('Location: manage-order.php');
    }
 ?>

<div class="main-content">
    
    <div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-6">
            <h2 style="font-weight: 900">Update order</h2>
                <form action="" method="post">
                <div class="mb-3">
                    <select class="form-select" name="status">
                        <option selected disabled> <?php echo $status ?></option>
                        <option value="delivered">delivered</option>
                        <option value="on-delivery">on-delivery</option>
                        <option value="ordered">ordered</option>
                        <option value="cancelled">Cancelled</option>
                       
                    </select>
                </div>
                <!-- <input type="hidden" name='total' > -->
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <button type="submit" name="update"  class="btn btn-primary">Update order</button>
             </form>
            </div>
        </div>
    </div>
    </div>
</div>
<?php
    if(isset($_POST['update'])){
        $sn = $_POST['id'];
        // $number = $_POST['qty'];
        $status1 = $_POST['status'];
        // $total = 

        $sql1 = "Update tbl_order SET
        
        status = '$status1'
        WHERE
        id = '$sn'
        ";
        $execute = mysqli_query($conn, $sql1);
        if($execute == true){
            $_SESSION['updated'] = "order updated successfully";
            header('Location: manage-order.php');
        }
    }
    

?>