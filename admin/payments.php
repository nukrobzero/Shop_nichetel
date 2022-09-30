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

      <title>Nichetel Communications - Admin Payments</title>

      <!-- Custom fonts for this template -->
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="css/sb-admin-2.min.css" rel="stylesheet">

      <!-- Custom styles for this page -->
      <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

      <!-- Page Wrapper -->
      <div id="wrapper">

        <?php include "../components/allMenu.php";?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary">หน้าจัดการการโอนเงิน</h4>
              <a href="../process/admin_payments_checkdate.php"><button class="btn btn-success  mb-4 mt-4" type="button">
                เช็คกำหนดสั่งซื้อ
              </button></a>  
            </div>
            <div class="card-body">
             <?php
             $sql ="SELECT * FROM bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id INNER JOIN users ON cart.cart_user_id = users.user_id INNER JOIN address ON ad_user_id = users.user_id WHERE status = 0 or status = 1 GROUP BY bill_products.bp_id ORDER BY bill_products.bp_date_startorder ASC";
             $result = $conn->query($sql);
             ?>   
             <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>หลักฐาน</th>
                    <th>คำสั่งซื้อ</th>
                    <th>ชื่อ - นามสกุล</th>
                    <th>วันที่ทำรายการ</th>
                    <th>วันที่อัพโหลดหลักฐาน</th>
                    <th>สถานะ</th>
                    <th>ดำเนินการ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                    $i = 1;
                        // output data of each row
                    while($row = $result->fetch_assoc()) {
                      $cart_code = "C-".str_pad($row["cart_id"], 6, "0", STR_PAD_LEFT);
                      $status_bill;
                      if ($row["status"]== 1) {
                       $status_bill = "<p class='btn btn-info'>อัพโหลดสลิป</p>";
                     }else if ($row["status"]== 2) {
                       $status_bill = "<p class='btn btn-success'>ชำระเงินแล้ว</p>";
                     }else{
                       $status_bill = "<p class='btn btn-warning'>รอชำระเงิน</p>";
                     }

                     $status_upload;
                     if ($row["bp_date_uploadpayment"]== "0000-00-00 00:00:00") {
                       $status_upload = "ยังไม่มีการทำรายการ";
                     }
                     else{
                      $status_upload = $row["bp_date_uploadpayment"];
                     }

                     $image_upload;
                     if ($row["b_img"] !='') {
                       $image_upload = '<a href="../image/uploads/uploadslip/'.$row["b_img"].'" target="_blank"><img src="../image/uploads/uploadslip/'.$row["b_img"].'"class="img-responsive img-thumbnail" width="100" height="100" ></a>';
                     }else{
                       $image_upload = '<a href="../image/emptyimg.jpg" target="_blank"><img src="../image/emptyimg.jpg"class="img-responsive img-thumbnail" width="100" height="100" ></a>';
                     }
                     echo '
                     <tr>
                     <td>'.$i.'</td>
                     <td>'.$image_upload.'</td>
                     <td><a href="./admin_payments_detail.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&bp_date_startorder='.$row["bp_date_startorder"].'&bp_id='.$row["bp_id"].'">'.$cart_code.'</a></td>
                     <td>'.$row["ad_name"].'</td>
                     <td>'.$row["bp_date_startorder"].'</td>
                     <td>'.$status_upload.'</td>
                     <td>'.$status_bill.'</td>
                     <td class="row">&nbsp;<a href="../process/admin_payments_delete.php?bp_id='.$row["bp_id"].'&cart_id='.$row["cart_id"].'"data-toggle="modal" data-target="#deleteModal'.$row["bp_id"].'" class="btn btn-danger btn-circle" placeholder="ลบ"><i class="fas fa-trash"></i></a>&nbsp;
                     <a href="../process/admin_payments_confirm.php?bp_id='.$row["bp_id"].'"data-toggle="modal" data-target="#confirmModal'.$row["bp_id"].'"class="btn btn-success btn-circle"><i class="fa fa-check"></i>&nbsp;</a>&nbsp;
                     </td>
                     </tr>

                     <div class="modal fade" id="deleteModal'.$row["bp_id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                     <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">คุณต้องการจะลบคำสั่งซื้่อ  :: '.$cart_code.' ?</h5>
                     <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                     </button>
                     </div>
                     <div class="modal-body">โปรดเลือก "ตกลง" เพื่อทำการลบข้อมูล.</div>
                     <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                     <a class="btn btn-danger" href="../process/admin_payments_delete.php?bp_id='.$row["bp_id"].'&cart_id='.$row["cart_id"].' ">ตกลง</a>
                     </div>
                     </div>
                     </div>
                     </div>

                      <div class="modal fade" id="confirmModal'.$row["bp_id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                     <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">คุณต้องการจะอนุมัติคำสั่งซื้่อ  :: '.$cart_code.' ?</h5>
                     <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                     </button>
                     </div>
                     <div class="modal-body">โปรดเลือก "ตกลง" เพื่อทำการอนุมัติข้อมูล.</div>
                     <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                     <a class="btn btn-success" href="../process/admin_payments_confirm.php?bp_id='.$row["bp_id"].'">ตกลง</a>
                     </div>
                     </div>
                     </div>
                     </div>
                     ';
                     $i++;                     
                   } 
                 } else {
                  echo "0 results";
                }
                $conn->close();
                ?>
              </tbody>
            </table>
          </div>
          <br>
          <br>
        </div>
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
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>
<?php } ?>
