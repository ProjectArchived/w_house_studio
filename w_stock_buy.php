<?php

include "header.php";
include "hdl/stock.hdl.php";
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

              <!-- General Form Elements -->
              <form method="post" action="hdl/stock.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລກທີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="ref_no" placeholder="ເລກບິນ">
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
                          echo "ເຄື່ອງໃຊ້ໄຟຟ້າ".' - '.$row['item_la'];
                        } elseif($row['cat_id'] == 2) {
                          echo "ເຄື່ອງຄົວ".' - '.$row['item_la'];
                        } elseif($row['cat_id'] == 3) {
                          echo "ເຄື່ອງຫ້ອງນອນ".' - '.$row['item_la'];
                        } elseif($row['cat_id'] == 4) {
                          echo "ເຄື່ອງນ້ຳ".' - '.$row['item_la'];
                        } elseif($row['cat_id'] == 5) {
                          echo "ອຸປະກອນທົ່ວໄປ".' - '.$row['item_la'];
                        }
                      
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນເຄື່ອງ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="unit" placeholder="ຈຳນວນເຄື່ອງ" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນເງິນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control number" name="amount" placeholder="ຈຳນວນເງິນ" required>
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
                    <textarea class="form-control" placeholder="ລະບຸຂໍ້ຄວາມທີ່ກ່ຽວຂ້ອງ" id="floatingTextarea" style="height: 100px;" name="notes"></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_purchase" onclick="return confirm_action()">ບັນທຶກການຊື້ເຄື່ອງ</button>
                      <a href="w_stock_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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