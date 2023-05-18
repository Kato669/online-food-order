<link rel="stylesheet" href="../css/admin.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  .section{
    position: absolute;
    top: -500%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #ffffff !important;
    z-index: 10000;
    width: 50%;
    margin: auto;
    box-shadow: 0 0 5px 5px #000000 !important;
    padding: 1%;
    border-radius: 10px;
    transition: all 1s;
    height: 100vh;
    overflow-y: scroll;
  }
  .section.active{
    top: 50%;
  }
  form label{
    font-weight: bold;
  }
  .overlay{
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: grey;
  }
  .error{
    color: red;
    text-transform: capitalize;
  }
  /* .deleted, .category{
    position: absolute;
    top: 25%;
    left: 45%;
    transform: translateY(-1000%);
    z-index: 1000;
    color: green;
    font-size: 1.4rem;
    background-color: transparent;
    text-transform: capitalize;
    transition: all 1s;
  }
  .deleted.active{
    transform: translateY(-100%);
  }
  .category.active{
    transform: translateY(-100%);
  } */
</style>



<?php include_once('partials/header.php') ?>
    <div class="main-content">
    <h2 style="font-weight: 900">Manage food</h2>
        <div class="wrapper">
        <table class="table table-striped table-hover">
            <!-- <a href="add-admin.php" class="btn btn-primary">Add Food</a> -->
            <button class="btn btn-primary" id="btn">Add Food</button>
             <!-- form -->
             <div class="container section" id="section">
              <div class="row">
                <div class="col-lg-12">
              
                <form action="" method="POST" enctype="multipart/form-data">
                  
                  <div class="mb-3">
                    <label for="title" class="form-label">Enter Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                  </div>
                  <div class="mb-3">
                    <label for="floatingTextarea">Description</label><br>
                    <textarea class="form-control" placeholder="Enter description" id="floatingTextarea" name="description"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="price" class="form-label">Enter price</label>
                    <input type="number" class="form-control" id="price" name="price">
                  </div>
                  
                  <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="image" name="image_name">
                  </div>
                  
                  <div class="mb-3">
                    <label for="id">Select category</label>
                    <select class="form-select" id="id" name="category_id" required>
                      <!-- <option selected>Open this select menu</option> -->
                      <option value="" selected disabled>select</option>
                      <?php
                        $sql = "select * from tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count > 0){
                          while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            ?>
                                <option value="<?php echo $id;?>" style="color: black"><?php echo $title; ?></option>
                            <?php
                          }
                        }
                      ?>

                      
                    </select>
                    
                  </div>


                  <div class="mb-3">
                    <label for="">featured</label>
                    <br>
                    <input type="radio" name="featured" value='yes' id="yes"><span style="padding: 0 5px"></span><label for="yes">Yes</label><br>
                    <input type="radio" name="featured" value='no' id="no"><span style="padding: 0 5px"></span><label for="no">No</label>
                  </div>

                  <div class="mb-3">
                    <label for="">active</label>
                    <br>
                    <input type="radio" name="active" value='yes' id="yes1"><span style="padding: 0 5px"></span><label for="yes1">Yes</label><br>
                    <input type="radio" name="active" value='no' id="no1"><span style="padding: 0 5px"></span><label for="no1">No</label>
                  </div>

                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
                
                </div>
              </div>
            </div>
            <!-- form end -->
            <br>
            <br>
  <thead>
    <tr>
      <th scope="col">Sn</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th scope="col">Featured</th>
      <th scope="col">Active</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
  
   <?php
      $select = "select * from tbl_food";
      $execute = mysqli_query($conn, $select);
      $num = mysqli_num_rows($execute);
      if($num > 0 ){
        $sn = 1;
        while($results = mysqli_fetch_assoc($execute)){
          $id = $results['id'];
          $titled = $results['title'];
          $desc = $results['description'];
          $sell = $results['price'];
          $img = $results['image_name'];
          $featured = $results['featured'];
          $act = $results['active'];
          ?>
          <tr>
            <th scope="row"><?php echo $sn++; ?></th>
            <td><?php echo $titled; ?></td>
            <td><?php echo $desc; ?></td>
            <td><?php echo number_format($sell, 0); ?></td>
            <td>
              <?php
                if($img != ''){
                  ?>
                    <img src="<?php echo "../images/food/$img" ?>" width="90px" height="80px" alt="">
                  <?php
                }else{
                  echo "<span class='error'>no image</span>";
                }
              ?>
            </td>
            <td><?php echo $featured; ?></td>
            <td><?php echo $act; ?></td>
            <td>
            <a href="<?php echo SITEURL;?>/admin/delete_food.php?id=<?php echo $id ?>&image_name=<?php echo $img ?>" class="btn btn-danger">Delete</a>
            <a href="<?php echo SITEURL; ?>/admin/update_food.php?id=<?php echo $id ?>" type="button" class="btn btn-success">Edit</a>
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
    <?php include_once('partials/footer.php') ?>
<?php

      if(isset($_POST['submit'])){
        $title1 = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        if(isset($_POST['featured'])){
          $featured = $_POST['featured'];
        }else{
          $featured = 'no';
        }
        if(isset($_POST['active'])){
          $active = $_POST['active'];
        }else{
          $active = 'no';
        }
        
        //inserting image

        if(isset($_FILES['image_name']['name'])){
          $image_name = $_FILES['image_name']['name'];
          if($image_name != ''){
            $name = explode('.', $image_name);
            $ext = end($name);
            $image_name = "food_image". rand(000, 999). '.'. $ext;

            $image_source = $_FILES['image_name']['tmp_name'];

            $image_destination = "../images/food/".$image_name;

            $upload = move_uploaded_file($image_source, $image_destination);
            if($upload == false){
              $_SESSION['failed'] = "image failed upload";
              // die();
            }
          }else{
            // echo "no image";
          }
        }else{
          $image_name =  "no image";
        }
        
        if(!empty($title1) && !empty($description) && !empty($price)){
          $sql1 = "insert into tbl_food SET
            title = '$title1',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category_id,
            featured = '$featured',
            active = '$active'
          ";
          $res1 = mysqli_query($conn, $sql1);
          if($res1 == true){
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
                Command: toastr["success"]("food added successfully");
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
                Command: toastr["error"]("error failed to add");
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
              Command: toastr["error"]("Please fill in all the fields");
          </script>
          ';
        }




      }

?>
<script>
  let section = document.getElementById('section');
  let btn = document.getElementById('btn');
  btn.addEventListener('click', (e)=>{
    section.classList.add('active')
  })

</script>
<script>
  let deleted = document.getElementById('deleted');
  window.addEventListener('load',()=>{
    deleted.classList.add('active');
  })
  setTimeout(()=> deleted.remove(), 3000);


  let category = document.getElementById('category');
  window.addEventListener('load',()=>{
    category.classList.add('active');
  })
  setTimeout(()=> category.remove(), 3000);
</script>