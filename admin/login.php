<?php include('partials/constant.php') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body{
        background-image: linear-gradient(rgba(0,0,0,.5),rgba(0,0,0,.5)), url('https://cdn.pixabay.com/photo/2016/01/22/02/13/meat-1155132_1280.jpg');
        background-position: center;
        background-size: center;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100%;
    }
    .login{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 1px 1px 3px 3px #000;
        background-color: #fff;
        width: 500px;
        padding: 1%;
        border-radius: 10px;
    }
    .failed{
        color: red;
        font-size: .9rem;
        transition: 1s;
        position: absolute;
        top: 20%;
        left: 35%;
        transform: translateY(-2000%);
    }
    .failed.active{
        transform: translateY(-20%);
    }
</style>
<body>
<div class="container mt-5 login">
    <div class="row">
        <div class="col-lg-12">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Enter username</label>
                <input type="text" class="form-control" id="username" name="username">
                
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3">
                <input type="checkbox" name="" id="check">
                <label for="check" class="form-label">Show Password</label>
                
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Login</button>
        </form>
        </div>
    </div>
</div>
    <?php
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $sql = "select * from tbl_admin where username='$username' and password='$password'";
            $execute = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($execute);
            if($count == 1){
                header('Location: index.php');
                $_SESSION['user'] = $username;
            }else{
                echo "<span class='failed'>Wrong username or password</span>";

            }
        }
    ?>
</body>
<script>
    let check = document.getElementById('check');
    let pass = document.getElementById('exampleInputPassword1');
    check.addEventListener('click', ()=>{
        // console.log('hi')
        if(pass.type == 'password'){
            pass.type='text';
        }else{
            pass.type='password';
        }
    })
</script>
<script>
    let failed = document.querySelector('.failed')
    failed.classList.add('active');
    setTimeout(()=> failed.remove(), 3000);
</script>