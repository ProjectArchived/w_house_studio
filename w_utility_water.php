<?php

include "header.php";
include "hdl/utility.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດຄ່ານ້ຳ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/utility.hdl.php" autocomplete="off" > 

              <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ເລກທີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="ref_no" placeholder="BZ4-204188-xxxxxx-xxxx" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ເລກທີໝໍ້ແທກນ້ຳ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="meter_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($r_utility_wmeter = mysqli_fetch_array($utility_wmeter)){ ?>
                        <option value="<?php echo $r_utility_wmeter['id'];?>"><?php echo $r_utility_wmeter['meter_no'].' - '.$r_utility_wmeter['location'];?></option>  
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ປີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="year" value="<?php echo date('Y');?>" required>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ເດືອນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="month" value="<?php echo date('m');?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລກຄັ້ງກ່ອນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="s_unit" placeholder="ເລກຄັ້ງກ່ອນ" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລກຄັ້ງນີ້</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="e_unit" placeholder="ເລກຄັ້ງນີ້" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ບໍລິມາດນ້ຳທີ່ໃຊ້ (ມ3)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="t_unit" placeholder="ບໍລິມາດນ້ຳທີ່ໃຊ້" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ເປັນເງິນທັງໝົດ (ກີບ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control number" name="amount" placeholder="ເປັນເງິນທັງໝົດ" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ວັນທີຈ່າຍ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="paid_date" value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ໝາຍເຫດ</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" placeholder="ລະບຸຂໍ້ຄວາມທີ່ກ່ຽວຂ້ອງ" id="floatingTextarea" style="height: 100px;" name="remark"></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="utility_water" onclick="return confirm_action()">ບັນທຶກຄ່ານ້ຳໃໝ່</button>
                      <a href="w_utility_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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