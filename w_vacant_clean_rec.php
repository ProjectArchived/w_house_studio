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
              <h5 class="card-title f-header">ຂໍ້ມູນອະນາໄມຫ້ອງພັກທີ່ວ່າງ</h5>

              <!-- General Form Elements -->
              <?php if(!empty($_GET['clean_edit_id'])){?>

              <form method="post" action="hdl/room.hdl.php" autocomplete="off" >

              <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

              <input type="hidden" class="form-control" name="clean_id" value="<?php echo $_GET['clean_edit_id'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຂໍ້ຄວາມ</label>
                  <div class="col-sm-9">
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;" name="note"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="clear_cleaning" onclick="return confirm_action()">ບັນທຶກການແກ້ໄຂ</button>
                      <a href="w_vacant_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </form>

                <?php } else {?>
              <form method="post" action="hdl/room.hdl.php">

              <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="date" value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ຫ້ອງເລກທີ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="room_no" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($r_room_view = mysqli_fetch_array($v_open_room)){ ?>
                          <option value="<?php echo $r_room_view['room_no'];?>"><?php echo $r_room_view['room_no'];?></option>  
                        <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ປະເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="type" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <option value="1">ກ່ອນປ່ອຍຫ້ອງ</option>
                      <option value="3">ຫ້ອງບໍ່ມີແຂກ</option>
                      <option value="4">ແອ</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ສະພາບ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="room_status" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <option value="1">ປົກກະຕິ</option>
                      <option value="2">ບໍ່ປົກກະຕິ</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ອະນາໄມໂດຍ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="clean_by" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($r_staff_view = mysqli_fetch_array($staff_view)){ ?>
                          <option value="<?php echo $r_staff_view['id'];?>"><?php echo $r_staff_view['name'];?></option>  
                        <?php } ?>
                    </select>
                  </div>
                </div>
                

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຂໍ້ຄວາມ</label>
                  <div class="col-sm-9">
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="ຂໍ້ຄວາມ" id="floatingTextarea" style="height: 100px;" name="note"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_cleaning" onclick="return confirm_action()">ບັນທຶກ</button>
                      <a href="w_vacant_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

              <?php }?>

            </div>
          </div>

        </div>

      </div>
    </section>

<?php

include "footer.php";

?>