<?php

include "header.php";
include "hdl/l.currency.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດອັດຕາແລກປ່ຽນໃໝ່</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/l.currency.hdl.php" autocomplete="off" >

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
                  <label for="inputDate" class="col-sm-3 col-form-label">ອັດຕາຊື້ (ກີບ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="buy_rate" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ອັດຕາຂາຍ (ກີບ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="sell_rate" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-sm-3" name="new_rate" onclick="return confirm_action()">ບັນທຶກອັດຕາແລກປ່ຽນໃໝ່</button>
                      <a href="w_l_currency.php" class="btn btn-outline btn-color col-sm-3">ກັບຄືນ</a>
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