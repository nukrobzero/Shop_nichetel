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

      <title>Nichetel Communications - Deliverys</title>

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
              <h4 class="m-0 font-weight-bold text-primary">หน้าจัดการการส่งสินค้า</h4>
            </div>
            <div class="card-body">
             <?php
             $sql ="SELECT * FROM bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id INNER JOIN users ON cart.cart_user_id = users.user_id INNER JOIN address ON ad_user_id = users.user_id WHERE status = 2 or status = 3 GROUP BY bill_products.bp_id  ORDER BY bill_products.b_date DESC";
             $result = $conn->query($sql);
             ?>   
             <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>คำสั่งซื้อ</th>
                    <th>ชื่อ - นามสกุล</th>
                    <th>วันที่ทำรายการ</th>
                    <th>สถานะ</th>
                    <th>หมายเลขพัสดุ</th>
                    <th>จัดการหมายเลขพัสดุ</th>
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
                       $status_bill = "<p class='btn btn-info'>โอนเงินแล้ว</p>";
                     }else if ($row["status"]== 2) {
                      $status_bill = "<p class='btn btn-warning'>กำลังเตรียมจัดส่ง</p>";
                    }else if ($row["status"]== 3) {
                      $status_bill = "<p class='btn btn-success'>จัดส่งเรียบร้อยแล้ว</p>";
                    }else{
                     $status_bill = "<p class='btn btn-danger'>รอตรวจสอบ</p>";
                   }
                   echo '
                   <tr>
                   <td>'.$i.'</td>
                   <td><a href="./admin_delivery_detail.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&b_date='.$row["b_date"].'&delivery_number='.$row["delivery_number"].'&bp_id='.$row["bp_id"].'">'.$cart_code.'</a></td>
                   <td>'.$row["ad_name"].'</td>
                   <td>'.$row["b_date"].'</td>
                   <td>'.$status_bill.'</td>
                   <td>'.$row["delivery_number"].'</td>
                   <td><a href="./admin_delivery_addpost.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&b_date='.$row["b_date"].'&delivery_number='.$row["delivery_number"].'">เพิ่ม/แก้ไขหมายเลขพัสดุ</a></td>
                   </tr>

                   <div class="modal fade" id="deleteModal'.$row["bp_id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                   <div class="modal-content">
                   <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">คุณต้องการจะลบข้อมูล  :: '.$cart_code.' ?</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
                   </button>
                   </div>
                   <div class="modal-body">โปรดเลือก "ตกลง" เพื่อทำการลบข้อมูล.</div>
                   <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                   <a class="btn btn-danger" href="./process/admin_uploadslip-delete.php?bp_id='.$row["bp_id"].' ">ตกลง</a>
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
        <a class="btn btn-primary" href="./process/logout.php">ตกลง</a>
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
<?php } ?>

</html>
