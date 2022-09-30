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

  <title>Nichetel Communications - Category</title>

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
        <h4 class="m-0 font-weight-bold text-primary">ประเภทสินค้า</h4>
      </div>
      <div class="card-body">
       <?php
       $sql ="SELECT * FROM category ORDER BY cg_id DESC";
       $result = $conn->query($sql);
       ?>   
       <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ลำดับที่</th>
              <th>ประเภทสินค้า</th>
              <th>ลบ</th>
              <th>แก้ไข</th>
            </tr>
          </thead>
          <!-- <tfoot>
            <tr>
              <th>ลำดับที่</th>
              <th>ชื่อข่าวสาร</th>
              <th>รายละเอียด</th>
              <th>วันที่โพส</th>
              <th>รูป</th>
              <th>ชื่อผู้โพส</th>
              <th>ลบ</th>
              <th>แก้ไข</th>
            </tr>
          </tfoot> -->
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              $i = 1;
                        // output data of each row
              while($row = $result->fetch_assoc()) {
                echo '
                <tr>
                <td>'.$i.'</td>
                <td>'.$row["cg_name_type"].'</td>
                <td><a href="../process/category_delete.php?cg_id='.$row["cg_id"].'"data-toggle="modal" data-target="#deleteModal'.$row["cg_id"].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a></td>
                <td><a href="./category_edit.php?cg_id='.$row["cg_id"].'"class="btn btn-success btn-circle"><i class="fas fa-exclamation-triangle"></i></a></td>
                </tr>
                <div class="modal fade" id="deleteModal'.$row["cg_id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">คุณต้องการจะลบข้อมูล :: '.$row["cg_name_type"].' ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">โปรดเลือก "ตกลง" เพื่อทำการลบข้อมูล.</div>
                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                <a class="btn btn-danger" href="../process/category_delete.php?cg_id='.$row["cg_id"].' ">ตกลง</a>
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
      <a href="./category_add.php"><button class="btn btn-success btn-user btn-block" type="button">
        เพิ่มประเภทสินค้า
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