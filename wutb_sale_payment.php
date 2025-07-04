<?php

include "header.php";
include "hdl/wutb.sale.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດການຊຳລະ</h5>
              

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
                  <label for="inputText" class="col-sm-3 col-form-label">ຈຳນວນເງິນ (ກີບ)</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control number" name="payment">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລູກຄ້າທີ່ຄ້າງຊຳລະ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="customer_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($check_debt)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                      
                        echo $row['name']. ' - ' .number_format($row['remain_debt']). '  ' .'ກີບ' ;
                     
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

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_payment" onclick="return confirm_action()">ບັນທຶກການຊຳລະ</button>
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