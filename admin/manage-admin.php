


<link rel="stylesheet" href="../css/admin.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<?php include_once('partials/header.php') ?>
    <div class="main-content">
    <h2 style="font-weight: 900">Manage admin</h2>
        <div class="wrapper">
        <table class="table table-striped table-hover">
      <h5 id="sets">
        <?php 
          if(isset($_SESSION['addAdmin'])){
            echo $_SESSION['addAdmin'];
            unset($_SESSION['addAdmin']);
          }
          if(isset($_SESSION['success'])){
            echo $_SESSION['success'];
            unset($_SESSION['success']);
          }
          if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']); 
          }
          if(isset($_SESSION['psw-not-exist'])){
            echo $_SESSION['psw-not-exist'];
            unset($_SESSION['psw-not-exist']);
          };
          if(isset($_SESSION['pwd-changed'])){
            echo $_SESSION['pwd-changed'];
            unset($_SESSION['pwd-changed']);
          }
          if(isset($_SESSION['pwd-dont-match'])){
            echo $_SESSION['pwd-dont-match'];
            unset($_SESSION['pwd-dont-match']);
          }
        ?>
        
      </h5>
<br><br>

            <a href="add-admin.php" class="btn btn-primary">Add admin</a>
            <br>
            <br>
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">FullName</th>
      <th scope="col">UserName</th>
      <!-- <th scope="col">Password</th> -->
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
$sql = 'select * from tbl_admin';

$res = mysqli_query($conn, $sql);

if($res == true){
  $count = mysqli_num_rows($res);
  if($count > 0){
    $num = 1;
    while($rows = mysqli_fetch_assoc($res)){
      $id = $rows['id'];
      $fullname = $rows['fullname'];
      $username = $rows['username'];

      ?>
        <tr>
          <th scope="row"><?php echo $num++ ?> </th>
          <td><?php echo $fullname ?> </td>
          <td><?php echo $username ?> </td>
          <td>
            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn btn-small btn-primary">change password</a>
            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" type="button" class="btn btn-danger">Delete</a>
            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id ?>"  type="button" class="btn btn-success">Edit</a>
          </td>
        </tr>
 


      <?php
    }
  }
}





?>
    
   
  </tbody>
</table>
        </div>
    </div>
    <?php include_once('partials/footer.php') ?>
    <script src="js/app.js"></script>