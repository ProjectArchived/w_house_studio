<?php

include "header.php";
include "hdl/wutb.l.menu.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດລາຄາ</h5>
              
              <!-- General Form Elements -->
              <form method="post" action="hdl/wutb.l.menu.hdl.php" autocomplete="off" >
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ລາຍການຂະໜົມຫວານ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="menu_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($menu_view)){?>
                      <option value="<?php echo $row['id'];?>"><?php echo $row['menu_la'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດລາຄາ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($price_cat_select)){?>
                      <option value="<?php echo $row['id'];?>"><?php echo 'ລາຄາ'.' '.$row['id'].' - '.$row['desc_la'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນເງິນ (ກີບ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control number" name="unit_price" required>
                  </div>
                  </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_price" onclick="return confirm_action()">ບັນທຶກລາຄາໃໝ່</button>
                      <a href="wutb_l_menu_price.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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