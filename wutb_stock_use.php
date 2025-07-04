<?php

include "header.php";
include "hdl/wutb.stock.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດການນຳໃຊ້ເຄື່ອງ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/wutb.stock.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="create_date"  value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລາຍການເຄື່ອງ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="item_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($assign_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                        if($row['cat_id'] == 1) {
                          echo "ສ່ວນປະສົມ".' - '.$row['item_la'].' - '.$row['total'];
                        } elseif($row['cat_id'] == 2) {
                          echo "ຖົງຕ່າງໆ ແລະ​ ເຈ້ຍ".' - '.$row['item_la'].' - '.$row['total'];
                        } elseif($row['cat_id'] == 3) {
                          echo "ອຸປະກອນເຄັກ".' - '.$row['item_la'].' - '.$row['total'];
                        } elseif($row['cat_id'] == 4) {
                          echo "ແພັກແກັດຈິງ".' - '.$row['item_la'].' - '.$row['total'];
                        } elseif($row['cat_id'] == 5) {
                          echo "ບໍລິຫານ".' - '.$row['item_la'].' - '.$row['total'];
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
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_usage" onclick="return confirm_action()">ບັນທຶກການນຳໃຊ້ເຄື່ອງ</button>
                      <a href="wutb_stock_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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