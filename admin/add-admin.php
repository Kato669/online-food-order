
<link rel="stylesheet" href="../css/style.css">

<?php include('partials/header.php') ?>

<?php
$errors = [];
if(isset($_POST['submit'])){
    
    $fullname = $_POST["fullname"];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    if(!$fullname){
        $errors[] = 'fill before proceeding';
        return false;
    }

    $sql = "insert into tbl_admin SET
    fullname = '$fullname',
    username = '$username',
    password = '$password'

    ";
    

    $res = mysqli_query($conn, $sql) or die(mysql_error());
    

   //check if data is submitted
   if($res === true){
    $_SESSION['addAdmin'] = "<div class='success'>Admin added successfully</div>";
    header("Location: manage-admin.php");
   }else{
    $_SESSION['addAdmin'] = "addition failed";
   }
    
}
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/admin.css"> 


 <div class="container">
    <div class="row">
        <div class="col-lg-6">
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger">
                    <?php echo $error?>
                </div>
            <?php  endforeach?>
        <form action="add-admin.php" method="POST">
        <div class="mb-3">
            <label for="fullname" class="form-label">Enter fullName</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullName">
            
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Enter username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Enter password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" autocomplete='off'>
            </div>
            <div class="mb-3">
                <input type="checkbox" name="" id="checkbox"><label for="checkbox" style="padding: 0 10px">Show password</label>
            </div>

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
        <br><br>
        </div>
    </div>
 </div>
<?php include('partials/footer.php') ?>
<script>
    let password = document.getElementById('password');
    let checkbox = document.getElementById('checkbox');
    checkbox.addEventListener('click', ()=>{
        // console.log('hello world')
        if(checkbox.checked){
            if(password.type ="password"){
                password.type = "text";
            }
        }else{
                password.type = "password";
            }
        
    })
</script>

