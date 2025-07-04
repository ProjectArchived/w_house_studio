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
              <h5 class="card-title f-header">ລາຍລະອຽດຄ່າອິນເຕີເນັດ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/utility.hdl.php" autocomplete="off" > 

              <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ເລກທີບິນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="ref_no" placeholder="ເລກບິນ" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ເລກທີເຄື່ອງອິນເຕີເນັດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="meter_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($r_utility_imeter = mysqli_fetch_array($utility_imeter)){ ?>
                        <option value="<?php echo $r_utility_imeter['id'];?>"><?php echo $r_utility_imeter['meter_no'].' - '.$r_utility_imeter['location'];?></option>  
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
                      <button type="submit" class="btn btn-color col-md-3" name="utility_internet" onclick="return confirm_action()">ບັນທຶກຄ່າອິນເຕີເນັດ</button>
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