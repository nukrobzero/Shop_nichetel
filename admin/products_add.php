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

      <title>Nichetel Communications - Add Products</title>

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
              <h4 class="m-0 font-weight-bold text-primary">เพิ่มสินค้า</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <form action="../process/products_add.php" method="post" enctype="multipart/form-data">
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label class="m-0 font-weight-bold text-warning">ชื่อสินค้า <span style="color: red;">*</span></label>
                      <input type="text" class="form-control form-control-user" id="exampleInputp_title" placeholder="ชื่อสินค้า" name="pd_name" value="" required="">
                    </div>
                    <div class="col-sm-6">
                      <label class="m-0 font-weight-bold text-warning">แบรนด์ <span style="color: red;">*</span></label>
                      <select  class="form-control form-control-user" name="brand_name" required="">
                        <?php 
                        $sql = "SELECT * FROM brand_products";
                        $result = $conn->query($sql);   
                        if ($result->num_rows > 0) {
                          echo '<option value="0">---เลือกแบรนด์---</option>';
                          while ( $row = $result->fetch_assoc())
                          {
                            echo '<option value="'.$row["brand_id"].'">'.$row["brand_name"].'</option>';
                          }   
                        } else {
                          echo "0 results";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label class="m-0 font-weight-bold text-warning">โปรโมชั่น</label>
                      <select  class="form-control form-control-user" name="p_name">
                        <?php 
                        $sql = "SELECT * FROM promotions";
                        $result = $conn->query($sql);   
                        if ($result->num_rows > 0) {
                          echo '<option value="0">---เลือกโปรโมชั่น---</option>';
                          while ( $row = $result->fetch_assoc())
                          {
                            echo '<option value="'.$row["p_id"].'">'.$row["p_name"].'</option>';
                          }   
                        } else {
                          echo "0 results";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-sm-6 ">
                      <label class="m-0 font-weight-bold text-warning">รูปภาพตัวสินค้าที่จะแสดง <span style="color: red;">*</span></label>
                      <input type="file" class="form-control form-control-user" id="fileToUpload" placeholder="" name="fileToUpload" value="" required="">
                    </div>
                  </div>
                  <!-- <p style="color:red">ลูกค้าสามารถแนบไฟล์เพิ่มเติมได้ที่ด้านล่าง อนุญาติเฉพาะไฟล์รูป ขนาดไม่เกิน 1 MB เท่านั้น!!</p> -->
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label class="m-0 font-weight-bold text-warning">DataSheet Link<span style="color: red;">*</span></label>
                      <input type="text" class="form-control form-control-user" id="exampleInputp_title" placeholder="ลิงค์ DataSheet" name="pd_datasheet">
                    </div>
                    <div class="col-sm-6 ">
                      <label class="m-0 font-weight-bold text-warning">เลือกไฟล์รูปอื่นๆที่จะอัปโหลด <span style="color: red;">*</span> :</label>
                      <input type="file" name="files[]" multiple >
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <label class="m-0 font-weight-bold text-warning">รายละเอียดสินค้า</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="pd_detail" placeholder="รายละเอียดสินค้า....."></textarea>
                  </div>
                  <br>
                  <br>
                  <hr>
                  <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">คลังสินค้า</h4>
                  </div>
                  <div class="card-body">
                   <div class="form-group">
                    <label class="m-0 font-weight-bold text-warning">คลังสินค้า <span style="color: red;">*</span></label>
                    <select  class="form-control form-control-user" name="stock_name" required="">
                      <?php 
                      $sql = "SELECT * FROM stock_products";
                      $result = $conn->query($sql);   
                      if ($result->num_rows > 0) {
                        echo '<option value="0">--- เลือกคลังสินค้า ---</option>';
                        while ( $row = $result->fetch_assoc())
                        {
                          echo '<option value="'.$row["stock_id"].'">'.$row["stock_name"].'</option>';
                        }   
                      } else {
                        echo "0 results";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="m-0 font-weight-bold text-warning">ต้นทุน <span style="color: red;">*</span></label>
                    <input type="number" step="0.01" min="0.00" class="form-control form-control-user" id="exampleInputp_title" placeholder="" name="pd_cost" value="0.00" required="">
                  </div>
                  <div class="form-group">
                    <label class="m-0 font-weight-bold text-warning">ราคาต่อหน่วย <span style="color: red;">*</span></label>
                    <input type="number" step="0.01" min="0.00" class="form-control form-control-user" id="exampleInputp_title" placeholder="" name="pd_price" value="0.00" required="">
                  </div>
                  <div class="form-group">
                    <label class="m-0 font-weight-bold text-warning">จำนวนสินค้า <span style="color: red;">*</span></label>
                    <input type="number"  min="0" class="form-control form-control-user" id="exampleInputp_title" placeholder="" name="pd_Ready" value="0" required="">
                  </div>
                  <br>
                  <br>
                  <button class="btn btn-primary btn-user btn-block" type="submit">
                    เพิ่มสินค้า
                  </button>
                </form>
                <hr>
                <a href="./products.php"><button class="btn btn-success btn-user btn-block" type="button">
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
