<?php include('partials/header.php')?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<div class="main-content">
    <h2 style="font-weight: 600">update admin</h2>
    <?php 
//get id of the admin selected
$id = $_GET['id'];
// echo $id;
//sql querry to get the id
$sql = "select * from tbl_admin where id=$id";

$res = mysqli_query($conn, $sql);

if($res == true){
    $count = mysqli_num_rows($res);
    if($count ==1){
        // echo 'admin availables';
        $row = mysqli_fetch_assoc($res);
        $fulname = $row['fullname'];
        $username = $row['username'];
    }else{
        header('Location: manage-admin.php');
    }
}



?>
</div>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Enter fullname: </label>
                    
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="enter fullname" value="<?php echo $fulname ?>">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Enter username: </label>
                    
                    <input type="text" class="form-control" name="username" id="username" placeholder="enter username" value="<?php echo $username; ?>">
                </div>
                <!-- <div class="mb-3">
                    <label for="password" class="form-label">Enter password: </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="enter password">
                </div> -->
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="submit" class="btn btn-primary mb-3">update admin</button>
            </form>
        </div>
    </div>
</div>



<?php 
 if(isset($_POST['submit'])){
    // echo 'button clicked';
    // get all values from the form
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];

    // sql statement to update the querry
    $sql = "update tbl_admin SET
    fullname = '$fullname',
    username = '$username'  
    WHERE id = '$id' 
    ";
    
    $res = mysqli_query($conn, $sql);
 
    //check whether admin updated successfully
    if($res == true){
       $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
       header('Location: manage-admin.php');
    }else{
        //admin failed to update
        header('Location: manage-admin.php');
    }
 }
?>
<?php  include('partials/footer.php') ?>