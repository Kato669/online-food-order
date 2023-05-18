

<!-- // datatables -->
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="../css/admin.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  .updated{
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
  .updated.active{
    transform: translateY(-20%);
  }
  .delivered{
    color: green;
  }
  .on{
    color: #f39c12;
  }
  .ordered{
    color: #3498db;
  }
  .cancelled{
    color: #e74c3c;
  }
</style>
<?php include_once('partials/header.php') ?>
<h1 class="updated" id="updated">
  <?php
    if(isset($_SESSION['updated'])){
      echo $_SESSION['updated'];
      unset($_SESSION['updated']);
    }
  ?>
</h1>
    <div class="main-content">
    <h2 style="font-weight: 900">Manage order</h2>
        <div class="wrapper">
        <table id="example" class="display" style="font-size: .9rem">
            <!-- <button href="" class="btn btn-p/rimary" id="add_category">Add category</button> -->
            <br>
            <br>
            <thead>
              <tr>
                <th scope="col">Sn.</th>
                <th scope="col">food</th>
                <th scope="col">price</th>
                <th scope="col">qty</th>
                <th scope="col">total</th>
                <th scope="col">order_date</th>
                <th scope="col">status</th>
                <th scope="col">customer_name</th>
                <th scope="col">contacts</th>
                <th scope="col">email</th>
                <th scope="col">address</th>
                <th scope="col">Action</th>
                
              </tr>
            </thead>
            <tbody>
              <?php
                $select = "select * from tbl_order";
                $res = mysqli_query($conn, $select);
                $count = mysqli_num_rows($res);
                if($count > 0){
                  $sn = 1;
                  while($row = mysqli_fetch_assoc($res)){
                      $id = $row['id'];
                      $food = $row['food'];
                      // $total = $row['total'];
                      $price = $row['price'];
                      $qty = $row['qty'];
                      $total = $row['total'];
                      $order_date = $row['order_date'];
                      $status = $row['status'];
                      $customer_name = $row['customer_name'];
                      $customer_contact = $row['customer_contact'];
                      $customer_email = $row['customer_email'];
                      $customer_address = $row['customer_address'];
                      ?>
                        <tr>
                          <th scope="row"><?php echo $sn++ ?></th>
                          <td><?php echo $food ?></td>
                          <td><?php echo $price ?></td>
                          <td><?php echo $qty ?></td>
                          <td><?php echo $total?></td>
                          <td><?php echo $order_date ?></td>
                          <td><?php 
                            if($status == 'delivered'){
                              echo "<span class='delivered'>$status</span>";
                            }elseif($status == 'on-delivery'){
                              echo "<span class='on'>$status</span>";
                            }elseif($status == 'ordered'){
                              echo "<span class='ordered'>$status</span>";
                            }else{
                              echo "<span class='cancelled'>$status</span>";
                            }
                          ?></td>
                          <td><?php echo $customer_name?></td>
                          <td><?php echo $customer_contact?></td>
                          <td><?php echo $customer_email?></td>
                          <td><?php echo $customer_address?></td>
                          <td>
                            <a href="<?php echo SITEURL; ?>admin/update_order.php?id=<?php echo $id ?>" class='btn btn-primary'>Update</a>
                          </td>
                        </tr>
                      <?php
                  }
                }
              ?>
             
            </tbody>
        </table>




        </div>
    </div>
    <!-- <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
<script>
  let updated = document.getElementById('updated');
  window.addEventListener('load',()=>{
    updated.classList.add('active');
  })
  setTimeout(()=> updated.remove(), 3000);
</script>
    <?php include_once('partials/footer.php') ?>