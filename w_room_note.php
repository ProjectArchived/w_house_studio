<?php

include "header.php";
include "hdl/room.hdl.php";

?>

  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດຂໍ້ຄວາມ</h5>
              <form method="post" action="hdl/room.hdl.php" autocomplete="off" >

                 <input type="hidden" class="form-control" name="room_no" value="<?php echo $_GET['room_no']?>">

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <input type="hidden" class="form-control" name="customer_id" value="<?php echo $_GET['customer_id']?>">

                <!-- General Form Elements -->
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ແຈ້ງເຕືອນ</label>
                  <div class="col-sm-9">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="remind" value="1" onclick="hideSection()">
                    </div>
                  </div>
                </div>

                <div id="hideBox" style="display: none;">
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">ວັນທີແຈ້ງເຕືອນ</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" name="r_d">
                    </div>
                  </div>
                </div>

                <div class="form-floating mb-3">
                  <textarea class="form-control" placeholder="ລະບຸຂໍ້ຄວາມທີ່ກ່ຽວຂ້ອງ" id="floatingTextarea" style="height: 100px;" name="note" ></textarea>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-2" name="new_note" onclick="return confirm_action()" >ບັນທຶກຂໍ້ຄວາມ</button>
                      <a href="w_room_detail.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-outline btn-color col-md-2">ກັບຄືນ</a>
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