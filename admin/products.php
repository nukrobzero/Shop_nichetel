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

  <title>Nichetel Communications - Products</title>

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
   <div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">สินค้า</h4>
      </div>
      <div class="card-body">
       <?php
       $sql ="SELECT * FROM products INNER JOIN gallery_products ON products.pd_id = gallery_products.pd_id INNER JOIN brand_products ON products.brand_id = brand_products.brand_id INNER JOIN category ON brand_products.cg_id = category.cg_id  GROUP BY products.pd_id ORDER BY products.pd_id DESC";
       $result = $conn->query($sql);
       ?>   
       <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>รูป</th>
              <th>รหัสสินค้า</th>
              <th>ชื่อสินค้า</th>
              <th>ราคาขาย</th>
              <th>วันที่เพิ่มเข้าคลังสินค้า</th>
              <th>แก้ไขล่าสุด</th>
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
                <td><a href="../image/uploads/products/'.$row["pd_img"].'" target="_blank"><img src="../image/uploads/products/'.$row["pd_img"].'" class="img-responsive img-thumbnail" width="100" height="100"></a></td>
                <td>'.$row["pd_id"].'</td>
                <td>'.$row["pd_name"].'</td>
                <td>'.$row["pd_price"].'</td>
                <td>'.$row["pd_date_from_user"].'</td>
                <td>'.$row["pd_date"].'</td>
                <td class="row">&nbsp;<a href="../process/products_delete.php?pd_id='.$row["pd_id"].'"data-toggle="modal" data-target="#deleteModal'.$row["pd_id"].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>&nbsp;
                  <a href="./products_edit.php?pd_id='.$row["pd_id"].'"class="btn btn-success btn-circle"><i class="fas fa-edit"></i>&nbsp;&nbsp;</a>
                </td>

                </tr>
                <div class="modal fade" id="deleteModal'.$row["pd_id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">คุณต้องการจะลบข้อมูล :: '.$row["pd_name"].' ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">โปรดเลือก "ตกลง" เพื่อทำการลบข้อมูล.</div>
                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                <a class="btn btn-danger" href="../process/products_delete.php?pd_id='.$row["pd_id"].' ">ตกลง</a>
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
      <a href="./products_add.php"><button class="btn btn-success btn-user btn-block" type="button">
        เพิ่มสินค้า
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