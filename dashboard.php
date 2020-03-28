<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Profile</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include 'base_navbar.php';?>
  <?php include 'base_sidebar.php';?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php 
                  if($_SESSION['user_image'] == "") 
                      $image_path = "dist/img/user.png";
                  else
                      $image_path = $_SESSION['user_image'];
                  ?>
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo $image_path?>"
                       alt="User profile picture">
                  <br><br>
                  <form action="updateImage.php" method="post" enctype="multipart/form-data"> 
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-label" id="exampleInputFile" name="user_image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        <input type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" style="display: none;">
                      </div>
                      <div class="input-group-append">
                        <input class="input-group-text" type="submit" value="Upload Image" name="submit">
                      </div>
                    </div>
                  </form>
                    
                </div>
                <br>
                <ul class="list-group list-group-unbordered mb-3">
                  <form action="updateInfo.php" method="post">
                    <li class="list-group-item">
                      <b>Name</b> 
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $_SESSION['user_name']; ?>" value="<?php echo $_SESSION['user_name']; ?>" required="" name="user_name">
                    </li>
                    <li class="list-group-item">
                      <b>Email</b> 
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $_SESSION['user_email']; ?>" value="<?php echo $_SESSION['user_email']; ?>" required="" name="user_email">
                    </li>
                    <li class="list-group-item">
                      <b>Phone Number</b>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $_SESSION['user_phone']; ?>" value="<?php echo $_SESSION['user_phone']; ?>" required="" name="user_phone">
                    </li>
                    <li class="list-group-item">
                      <b>Password</b>
                      <input type="password" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $_SESSION['user_password']; ?>" value="<?php echo $_SESSION['user_password']; ?>" required="" name="user_password">
                    </li>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <?php include 'base_footer.php';?>
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'base_footer_scripts.php';?>
</body>
</html>
