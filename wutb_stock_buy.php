<?php

include "header.php";
include "hdl/wutb.stock.hdl.php";
include "hdl/l.supplier.hdl.php";
include "hdl/l.currency.hdl.php";
?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດການຊື້ເຄື່ອງ</h5>

              <?php if(!empty($_GET['stock_edit_id'])){

                $id =  $_GET['stock_edit_id'];

                $check = mysqli_query($db, "SELECT * FROM wutb_db_expense WHERE id = $id");
                $result_1 = mysqli_fetch_array($check);
                
                ?>

                <form method="post" action="hdl/wutb.stock.hdl.php">

                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['stock_edit_id'];?>">

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <input type="hidden" class="form-control" name="date" value="<?php echo $_GET['date'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລກທີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="ref_no" value="<?php echo $result_1['ref_no'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລາຍການເຄື່ອງ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="item_id" required>
                      
                      <option value="<?php echo $result_1['item_id'];?>"><?php 
                      
                        if(!empty($result_1['item_id'])) {

                          $id_e = $result_1['item_id'];

                          $item_c = mysqli_query($db, "SELECT * FROM wutb_db_list_expense WHERE id = $id_e");

                          $item_r = mysqli_fetch_array($item_c);
                          
                          if($item_r['cat_id'] == 1) {
                            echo "ສ່ວນປະສົມ".' - '.$item_r['desc_la'];
                          } elseif($item_r['cat_id'] == 2) {
                            echo "ຖົງຕ່າງໆ ແລະ​ ເຈ້ຍ".' - '.$item_r['desc_la'];
                          } elseif($item_r['cat_id'] == 3) {
                            echo "ອຸປະກອນເຄັກ".' - '.$item_r['desc_la'];
                          } elseif($item_r['cat_id'] == 4) {
                            echo "ແພັກແກັດຈິງ".' - '.$item_r['desc_la'];
                          } elseif($item_r['cat_id'] == 5) {
                            echo "ບໍລິຫານ".' - '.$item_r['desc_la'];
                          }
                        }

                      ?></option>
                      <option value=""> -------- </option>
                      <?php while($row=mysqli_fetch_array($item_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                        if($row['cat_id'] == 1) {
                          echo "ສ່ວນປະສົມ".' - '.$row['desc_la'];
                        } elseif($row['cat_id'] == 2) {
                          echo "ຖົງຕ່າງໆ ແລະ​ ເຈ້ຍ".' - '.$row['desc_la'];
                        } elseif($row['cat_id'] == 3) {
                          echo "ອຸປະກອນເຄັກ".' - '.$row['desc_la'];
                        } elseif($row['cat_id'] == 4) {
                          echo "ແພັກແກັດຈິງ".' - '.$row['desc_la'];
                        } elseif($row['cat_id'] == 5) {
                          echo "ບໍລິຫານ".' - '.$row['desc_la'];
                        }

                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນເຄື່ອງ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="unit" value="<?php echo $result_1['unit'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນເງິນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control number" name="amount" value="<?php echo $result_1['amount'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ສະກຸນເງິນ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="currency" >
                    
                      <option value="<?php echo $result_1['currency'];?>"><?php 

                      if(!empty($result_1['currency'])) {

                        $id_c = $result_1['currency'];

                          $item_c = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $id_c");

                          $item_r = mysqli_fetch_array($item_c);

                          echo $item_r['currency_la'];
                      }

                      ?></option>
                      <option value=""> -------- </option>

                      <?php while($row=mysqli_fetch_array($currency_view)){?>
                      <option value="<?php echo $row['id'];?>"><?php echo $row['currency_la'];?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ຮ້ານຄ້າ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="supplier_id" >

                      <option value="<?php echo $result_1['supplier_id'];?>"><?php 

                        if(!empty($result_1['supplier_id'])) {

                          $id_s = $result_1['supplier_id'];

                            $item_c = mysqli_query($db, "SELECT * FROM w_db_list_supplier WHERE id = $id_s");

                            $item_r = mysqli_fetch_array($item_c);

                            echo $item_r['location'];
                        }

                      ?></option>
                      <option value=""> -------- </option>

                      <?php while($row=mysqli_fetch_array($supplier_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                      
                      if(!empty($row['country'])){
                      
                      $id = $row['country'];
                      $query = mysqli_query($db, "SELECT * FROM w_db_list_country WHERE id = $id");
                      $result = mysqli_fetch_array($query);

                      echo $row['location']. ' - ' . $result['country_la'];
                      }
                      
                      ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຂໍ້ຄວາມ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="notes" value="<?php echo $result_1['notes'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                    <?php if($_SESSION['role'] == 8){?>
                        <a href="hdl/wutb.stock.hdl.php?stock_del_id=<?php echo $_GET['stock_edit_id'];?>&date=<?php echo $_GET['date'];?>" class="btn btn-outline btn-danger col-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                      <?php }?>
                      <button type="submit" class="btn btn-color col-md-3" name="update_salary" onclick="return confirm_action()">ແກ້ໄຂລາຍການຊື້ເຄື່ອງ</button>
                      <a href="wutb_stock_detail.php?date=<?php echo $_GET['date'];?>" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
                </form>

              <?php } else {?>

              <!-- General Form Elements -->
              <form method="post" action="hdl/wutb.stock.hdl.php">

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="create_date"  value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລກທີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="ref_no">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລາຍການເຄື່ອງ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="item_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($item_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                        if($row['cat_id'] == 1) {
                          echo "ສ່ວນປະສົມ".' - '.$row['desc_la'];
                        } elseif($row['cat_id'] == 2) {
                          echo "ຖົງຕ່າງໆ ແລະ​ ເຈ້ຍ".' - '.$row['desc_la'];
                        } elseif($row['cat_id'] == 3) {
                          echo "ອຸປະກອນເຄັກ".' - '.$row['desc_la'];
                        } elseif($row['cat_id'] == 4) {
                          echo "ແພັກແກັດຈິງ".' - '.$row['desc_la'];
                        } elseif($row['cat_id'] == 5) {
                          echo "ບໍລິຫານ".' - '.$row['desc_la'];
                        }

                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນເຄື່ອງ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="unit" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນເງິນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control number" name="amount" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ສະກຸນເງິນ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="currency" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($currency_view)){?>
                      <option value="<?php echo $row['id'];?>"><?php echo $row['currency_la'];?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ຮ້ານຄ້າ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="supplier_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($supplier_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                      
                      if(!empty($row['country'])){
                      
                      $id = $row['country'];
                      $query = mysqli_query($db, "SELECT * FROM w_db_list_country WHERE id = $id");
                      $result = mysqli_fetch_array($query);

                      echo $row['location']. ' - ' . $result['country_la'];
                      }
                      
                      ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຂໍ້ຄວາມ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="notes" rquired>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_purchase" onclick="return confirm_action()">ບັນທຶກການຊື້ເຄື່ອງ</button>
                      <a href="wutb_stock_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->
              <?php } ?>
            </div>
          </div>

        </div>

      </div>
    </section>

<?php

include "footer.php";

?>