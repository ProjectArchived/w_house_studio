<?php

include "header.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດການອະນາໄມ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/room.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="room_no" value="<?php echo $_GET['room_no'];?>">

                <input type="hidden" class="form-control" name="customer_id" value="<?php echo $_GET['customer_id'];?>">

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ວັນທີອະນາໄມ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="clean_date" value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="clean_checkout" onclick="return confirm_action()">ບັນທຶກການອະນາໄມ</button>
                      <a href="w_room_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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