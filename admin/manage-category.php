
<link rel="stylesheet" href="./css/admin.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<?php include_once('partials/header.php') ?>
<!-- // datatables -->
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<style>
  .category{
    text-transform: capitalize;
    position: absolute;
    font-size: 1.3rem;
    top: 20%;
    left: 45%;
    transform: translateY(-1000%);
    z-index: 1000;
    color: green;
    transition: all 1s;
  }
  .category.active{
    transform: translateY(-100%);
  }
</style>

<h4 class="category" id="category">
  <?php
  if(isset($_SESSION['success'])){
    echo $_SESSION['success'];
    unset ($_SESSION['success']);
  }?>
</h4>

<?php
if(isset($_POST['submit'])){
  $title = $_POST['title'];

  //fetured
  if(isset($_POST['featured'])){
    $featured = $_POST['featured'];
  }else{
    $featured = 'No';
  }

  //active
  if(isset($_POST['active'])){
    $active = $_POST['active'];
  }else{
    $active = 'No';
  }

  if(isset($_FILES['image_name']['name'])){
    //we need image name, source and destination
    $image = $_FILES['image_name']['name'];
    if($image !=''){
      $ext = explode('.', $image);
      $file_ext = end($ext);

      $image = 'category_image'.time().rand(000, 999). '.'.$file_ext;
      $image_src = $_FILES['image_name']['tmp_name'];
      $image_destination = "../images/category/".$image;

      //upload image
      $upload = move_uploaded_file($image_src, $image_destination);
      if($upload == false){
        $_SESSION['failed'] = 'image failed to upload';
        exit;
      }
    }else{
      // echo 'image not available';
    }

  }else{
    $image = '';
  }

  if(!empty($title) && !is_numeric($title)){
  //sql querry to insert data
    $sql = "
    Insert into tbl_category set
    title = '$title',
    image_name = '$image',
    featured = '$featured',
    active = '$active'
    ";

    //execute the querry
    $res = mysqli_query($conn, $sql);
    //check if the querry is executed
    if($res == true){
      // echo 'hello world';
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
              Command: toastr["success"]("category inserted successfully");
          </script>
          ';
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
          Command: toastr["error"]("category failed");
      </script>
      ';
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
          Command: toastr["error"]("failed to ad!!!!");
      </script>
      ';
      // return false;
  }

}
?>

<body>



<div class="container form" id="form" >
  <div class="row">
    <div class="col-lg-12">
      <h4>add new category</h4>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image_name">
        
      </div>

      <div class="mb-3">
        <label for="featured" class="form-label">Featured</label><br>
        <input type="radio" name="featured" id="yes" value="yes"><span style="padding: 0 4px"></span> <label for="yes">Yes</label>
        <input type="radio" name="featured" id="no" value="no"><span style="padding: 0 4px"></span><label for="no">No</label>
      </div>
      <div class="mb-3">
        <label for="featured" class="form-label">Active</label><br>
        <input type="radio" name="active" value="yes" id="active"><span style="padding: 0 4px"></span> <label for="active">Yes</label>
        <input type="radio" name="active" value="no" id="act"><span style="padding: 0 4px"></span><label for="act">No</label>
      </div>
      
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
  </div>
</div>


    <div class="main-content">
    <h2 style="font-weight: 900">Manage Category</h2>
        <div class="wrapper">
        <table id="example" class="display">
            <button href="" class="btn btn-primary" id="add_category">Add category</button>
            <br>
            <br>
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">Image Name</th>
                <th scope="col">Featured</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
                
              </tr>
            </thead>
            <?php
              //select data from database
              $sql = "select * from tbl_category";
              //execute the querry
              $res = mysqli_query($conn, $sql);
              if($res ==true){
                $sn = 1;
                $count = mysqli_num_rows($res);
                if($count > 0){
                  while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>
                  <tbody>
                    <tr>
                      <th scope="row"><?php echo $sn++ ?></th>
                      <td><?php echo $title; ?></td>
                      <td>
                        <?php
                        if($image !=''){
                          ?>
                          <img src="<?php echo SITEURL ?>images/category/<?php echo $image; ?>" style="width: 60px; height=20px">
                          <?php
                        }else{
                          echo '<p style="color: red;">image not found</p>';
                        }
                        ?>
                      </td>
                      <td><?php echo $featured; ?></td>
                      <td><?php echo $active ?></td>
                      <td>
                        <a href="<?php echo SITEURL;?>/admin/delete_category.php?id=<?php echo $id ?>&image_name=<?php echo $image ?>" class="btn btn-danger">Delete</a>
                        <a href="<?php echo SITEURL; ?>/admin/update_category.php?id=<?php echo $id; ?>" class="btn btn-primary">Edit</a>
                      </td>
                    </tr>
                  
                  </tbody>
                    <?php
                  }
                }
              }
            ?>
            
        </table>
        </div>
    </div>
    <?php include_once('partials/footer.php') ?>
<script>
  let add_category = document.getElementById('add_category')
  let form = document.getElementById('form')
  let body = document.querySelector('body');
  add_category.addEventListener('click', (e)=>{
    // console.log('hello world')
    form.classList.add('active')
    body.classList.add('overflow')
  })
</script>


<!-- <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <script>
      let category = document.getElementById('category');
      window.addEventListener('load', ()=>{
        category.classList.add('active');
      })
      setTimeout(()=>category.remove(), 3000);
    </script>

  
</body>