<link rel="stylesheet" href="../css/admin.css">

<?php include_once('partials/header.php') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
   form{
    margin: 100px;
   }
   td{
    padding: 10px;
   }
   input[type='password']{
        margin-left: 20px;
   }
   input[type='submit']{
    width: 100%;
    padding: 1%;
    border-radius: 10px;
    background-color: deepskyblue;
    border: 0;
    outline: 0;
   }
   span{
    color: red;
   }
</style>

<div class="main-content">
    <h2 style="font-weight: 600">update admin password</h2>
</div>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
?>
<form action="" method="POST">
    <table>
        <tr>
            <td>Enter current password <span>*</span> </td>
            <td><input type="password" name="current_password" id="" class='password'></td>
        </tr>
        <tr>
            <td>Enter new password <span>*</span> </td>
            <td><input type="password" name="new_password" id="" class='password'></td>
        </tr>
        <tr>
            <td>confirm password <span>*</span> </td>
            <td><input type="password" name="confirm_password" id="" class='password'></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="" id="check"><label for="check" style="padding: 0 10px">show password</label></td>
        </tr>
        <tr>
             
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="update">
            </td>
        </tr>
       
    </table>
</form>

<?php
if(isset($_POST['submit'])){
    //echo 'am clicked';
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //sql to select from the table
    $sql = "select * from tbl_admin WHERE id= $id and password = '$current_password'";
    $res = mysqli_query($conn, $sql);

    //check whether password exits
    if($res == true){
        $count = mysqli_num_rows($res);
        if($count == 1){
            //echo 'password exists';
            //check if new password is eqaul to confirm password
            if($new_password == $confirm_password){
                //password match
                //echo 'password match';
                $sql1 = "update tbl_admin set
                password = '$new_password' 
                where id = $id";

                //execute the query
                $res1 = mysqli_query($conn, $sql1);

                //check whether the query was executed
                if($res1 == true){
                    $_SESSION['pwd-changed'] = "<div class='success'>the password is changed successfully</div>";
                    header('Location: manage-admin.php');
                }
            }else{
                //password do not match
                //echo 'password do not match';
                $_SESSION['pwd-dont-match'] = 'password do not match';
                header('Location: manage-admin.php');
            }

        }else{
            $_SESSION['psw-not-exist']= "password does't exist";
            header('Location: manage-admin.php');
        }
    }
}


?>
<script>
    let check = document.getElementById('check');
let passwords = document.querySelectorAll('.password');
check.addEventListener('click',()=>{
    
    passwords.forEach(password=>{
        if(check.checked){
            if(password.type= 'password'){
                password.type = 'text';
            }else{
                password.type = 'text';
            }
        }else{
            password.type = 'text';
        }
    })
})
</script>
<?php include_once('partials/footer.php') ?>