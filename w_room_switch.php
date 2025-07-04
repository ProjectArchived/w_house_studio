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
              

              <!-- General Form Elements -->
              <form method="post" action="hdl/room.hdl.php" autocomplete="off" >
              <h5 class="card-title f-header">ລາຍລະອຽດຫ້ອງພັກປັດຈຸບັນ</h5>

                <!-- Customer ID -->
                <input type="hidden" class="form-control" name="customer_id" value="<?php echo $_GET['customer_id']?>">

                <!-- User ID -->
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຫ້ອງເລກທີ <?php echo $_GET['room_no']?></label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="room_no" value="<?php echo $_GET['room_no']?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ວັນທີຍ້າຍ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="move_date" value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
                </div>

                <h5 class="card-title f-header">ຂໍ້ມູນຫ້ອງພັກທີ່ຈະຍ້າຍເຂົ້າ</h5>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ຫ້ອງເລກທີ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="new_room" required>
                      <?php 
                      while($result = mysqli_fetch_array($avaiable_room)){
                      ?>
                      <option value="<?php echo $result['id'];?>"><?php echo $result['id'];?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຫົວໜ່ວຍໄຟຟ້າ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="new_e_unit" required>
                  </div>
                </div>
                

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_move" onclick="return confirm_action()">ບັນທຶກ</button>
                      <a href="w_room_detail.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>

              </form><!-- End checkin -->


            </div>
          </div>

        </div>

      </div>
    </section>

<?php

include "footer.php";

?>