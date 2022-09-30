<?php session_start();
include "../process/connect.php";
?>
<?php
  if (!isset($_SESSION['user_id'])) { //check session
    echo "
    <script>
    window.location.href='../login.php';
    </script>
    ";
  }else{?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Nichetel Communications - Admins Edits</title>

      <!-- Custom fonts for this template -->
      <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="./css/sb-admin-2.min.css" rel="stylesheet">
      <!--ICON TITLE -->
    <link rel="icon" href="./assets/img/NT-Logosmall.png" type="image/x-icon">

      <!-- Custom styles for this page -->
      <link href="./vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

      <!-- Page Wrapper -->
      <div id="wrapper">

        <?php include "../components/allMenu.php";?>

        <!-- Begin Page Content -->
        <div class="container pl-1">
          <!-- DataTales Example -->
          <div class="card shadow mb-4" width="800">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูลแอดมิน</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <?php 
                $admin_id = htmlspecialchars( isset($_GET['admin_id'])?$_GET['admin_id']:'');
                $sql = "SELECT * FROM administrator WHERE admin_id = '$admin_id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                } else {
                  echo "0 results";
                }
                ?>
                <form action="../process/admins_edit.php?admin_id=<?php echo $admin_id; ?>" method="post">
                  <div class="form-group">
                    <label class="m-0 font-weight-bold text-warning">รหัสผู้ใช้งาน</label>
                    <input type="text" class="form-control form-control-user" id="exampleInputc_name" placeholder="" name="admin_id" disabled="" value="<?php echo $row["admin_id"]; ?>">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label class="m-0 font-weight-bold text-warning">ชื่อผู้ใช้งาน</label>
                      <input type="text" class="form-control form-control-user" id="exampleInputc_name" placeholder="ชื่อผู้ใช้งาน" name="admin_username" value="<?php echo $row["admin_username"]; ?>" required="">
                    </div>
                    <div class="col-sm-6">
                      <label class="m-0 font-weight-bold text-warning">ชื่อ-นามสกุล</label>
                      <input type="text" class="form-control form-control-user" id="exampleInputc_name" placeholder="ชื่อ-นามสกุล" name="admin_name" value="<?php echo $row["admin_name"]; ?>" required="">
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label class="m-0 font-weight-bold text-warning">รหัสผ่าน</label>
                    <input type="password" class="form-control form-control-user" id="exampleInputc_name" placeholder="กรุณาป้อนรหัสผ่านใหม่" name="admin_password" disabled="" value="<?php echo $row["admin_password"]; ?>" required="">
                  </div> -->
                  <div class="form-group">
                    <label class="m-0 font-weight-bold text-warning">ยืนยันรหัสผ่าน</label>
                    <input type="password" class="form-control form-control-user" id="exampleInputc_name" placeholder="ยืนยันรหัสผ่าน" name="admin_repassword" value="" required="">
                  </div>
                  <br>
                  <br>
                  <button class="btn btn-primary btn-user btn-block" type="submit">
                    อัปเดตข้อมูล
                  </button>
                </form>
                <hr>
                <a href="./admins.php"><button class="btn btn-success btn-user btn-block" type="button">
                  ย้อนกลับ
                </button></a>                  

              </div>    
            </div>
            <!-- /.container-fluid -->

          </div>
          <!-- End of Main Content -->

          <!-- Footer -->
          <?php include "../components/footer.php";?>
          <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">คุณต้องการจะออกจากระบบ?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">โปรดเลือก "ตกลง" เพื่อทำการออกจากระบบ.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
              <a class="btn btn-primary" href="../process/logout.php">ตกลง</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap core JavaScript-->
      <script src="./vendor/jquery/jquery.min.js"></script>
      <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Core plugin JavaScript-->
      <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="./js/sb-admin-2.min.js"></script>

      <!-- Page level plugins -->
      <script src="./vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="./vendor/datatables/dataTables.bootstrap4.min.js"></script>

      <!-- Page level custom scripts -->
      <script src="./js/demo/datatables-demo.js"></script>

    </body>

    </html>
  <?php }?>
