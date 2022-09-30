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

  <title>Nichetel Communications - Stock Products</title>

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
        <h4 class="m-0 font-weight-bold text-primary">คลังสินค้า</h4>
      </div>
      <div class="card-body">
       <?php
       $sql ="SELECT * FROM stock_products  ORDER BY stock_id DESC";
       $result = $conn->query($sql);
       ?>   
       <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>ชื่อคลังสินค้า</th>
              <th>เบอร์โทรศัพท์</th>
              <th>รายละเอียด</th>
              <th>สถานะ</th>
              <th>สินค้าในสต๊อก</th>
              <th>วันที่สร้าง</th>
              <th>ดำเนินการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              $i = 1;
                        // output data of each row
              while($row = $result->fetch_assoc()) {
                echo '
                <tr>
                <td>'.$i.'</td>
                <td>'.$row["stock_name"].'</td>
                <td>'.$row["stock_tel"].'</td>
                <td>'.$row["stock_detail"].'</td>
                <td>'.$row["stock_status"].'</td>
                <td>'.$row["stock_status"].'</td>
                <td>'.$row["stock_date"].'</td>
                <td class="row">&nbsp;<a href="../process/stock_products_delete.php?stock_id='.$row["stock_id"].'"data-toggle="modal" data-target="#deleteModal'.$row["stock_id"].'" class="btn btn-danger btn-circle" placeholder="ลบ"><i class="fas fa-trash"></i></a>&nbsp;
                  <a href="./stock_products_edit.php?stock_id='.$row["stock_id"].'"class="btn btn-success btn-circle"><i class="fas fa-edit"></i>&nbsp;</a>&nbsp;
                </td>
                </tr>
                <div class="modal fade" id="deleteModal'.$row["stock_id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">คุณต้องการจะลบข้อมูล :: '.$row["stock_name"].' ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">โปรดเลือก "ตกลง" เพื่อทำการลบข้อมูล.</div>
                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                <a class="btn btn-danger" href="../process/stock_products_delete.php?stock_id='.$row["stock_id"].' ">ตกลง</a>
                </div>
                </div>
                </div>
                </div>';
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
      <a href="./stock_products_add.php"><button class="btn btn-success btn-user btn-block" type="button">
        เพิ่มคลังสินค้า
      </button></a>
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