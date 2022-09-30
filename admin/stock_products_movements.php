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

  <title>Nichetel Communications - Stock Products Movements</title>

  <!-- Custom fonts for this template -->
  <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="./css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="./vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!--ICON TITLE -->
    <link rel="icon" href="./assets/img/NT-Logosmall.png" type="image/x-icon">

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
        <h4 class="m-0 font-weight-bold text-primary">การเคลื่อนไหวสินค้า</h4>
      </div>
      <div class="card-body">
       <?php
       $sql ="SELECT * FROM products_movement_log INNER JOIN products ON products_movement_log.pd_id = products.pd_id INNER JOIN stock_products ON products.stock_id = stock_products.stock_id ORDER BY products_movement_log.pd_m_id DESC";
       $result = $conn->query($sql);
       ?>   
       <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>รูป</th>
              <th>ชื่อสินค้า</th>
              <th>การเปลี่ยนแปลง</th>
              <th>เพิ่ม/ลด</th>
              <th>สถานะ</th>
              <th>คลังสินค้า</th>
              <th>วันที่ดำเนินการ</th>
              <th>ผู้ดำเนินการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              $i = 1;
                        // output data of each row
              while($row = $result->fetch_assoc()) {
                $status1;
                $status;
                $pd_no = $row["pd_m_no"];
                if ($row["pd_m_status"] == 0) {
                  $status = "เพิ่มจำนวนสินค้า";
                  $status1 = "<p class='btn btn-success'>เพิ่ม</p>";
                  $pd_no  = ''.$row["pd_m_no"].' <i class="fas fa-caret-up text-success"></i>';

                }else if ($row["pd_m_status"] == 1) {
                  $status = "ลดจำนวนสินค้า";
                  $status1 = "<p class='btn btn-danger'>ลด</p>";
                  $pd_no  = ''.$row["pd_m_no"].' <i class="fas fa-caret-down text-danger"></i>';
                }else{
                  $status = "รอตรวจสอบ";
                  $status1 = "รอ";
                }
                echo '
                <tr>
                <td>'.$i.'</td>
                <td><a href="../image/uploads/products/'.$row["pd_img"].'" target="_blank"><img src="../image/uploads/products/'.$row["pd_img"].'" class="img-responsive img-thumbnail" width="100" height="100"></a></td>
                <td>'.$row["pd_name"].'</td>
                <td>'.$status.'</td>
                <td>'.$pd_no.' </td>
                <td>'.$status1.'</td>
                <td>'.$row["stock_name"].'</td>
                <td>'.$row["pd_m_date"].'</td>
                <td>'.$row["pd_m_user"].'</td>
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