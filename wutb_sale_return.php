<?php

include "header.php";
include "hdl/wutb.sale.hdl.php";
include "hdl/l.currency.hdl.php";
?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດການສົ່ງຄືນ ແລະ ຖິ້ມ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/wutb.sale.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="create_date"  value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດລາຄາ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="price_type" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($price_cat)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                          echo 'ລາຄາ'.' '.$row['id'].' - '.$row['desc_la'];
                      
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລາຍການຂະໜົມ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="product_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($product_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                          echo $row['menu_la'];
                      
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນຂະໜົມ</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" name="unit" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລູກຄ້າ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="customer_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($customer_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                      if(!empty($row['branch'])){
                        echo $row['name']. ' - ' . $row['branch'];
                      } else {
                        echo $row['name'];
                      }
                      
                      ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ໝາຍເຫດ</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" placeholder="" id="floatingTextarea" style="height: 100px;" name="notes"></textarea>
                  </div>
                </div>

                <?php if($_SESSION['role'] == 8){?>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">ລາຍລະອຽດເພີ່ມເຕີມ (ທາງເລືອກ)</label>
                    <div class="col-sm-9">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="remind" value="1" onclick="hideSection()">
                      </div>
                    </div>
                  </div>

                  <div id="hideBox" style="display: none;">
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-3 col-form-label">ລາຄາຂະໜົມ</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control number" name="unit_price">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-3 col-form-label">ສະກຸນເງິນ</label>
                      <div class="col-sm-9">
                        <select class="form-select" aria-label="Default select example" name="currency">
                          <option value="">ກົດເພື່ອເລືອກ</option>
                          <?php while($row=mysqli_fetch_array($currency_view)){?>
                          <option value="<?php echo $row['id'];?>"><?php echo $row['currency_la'];?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>

                  </div>

                <?php } ?>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_return" onclick="return confirm_action()">ບັນທຶກລາຍການສົ່ງຄຶນ ແລະ ຖິ້ມ</button>
                      <a href="wutb_sale_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>   
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

      </div>
    </section>

<?php

include "footer.php";

?>