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
              <h5 class="card-title f-header">ຂໍ້ມູນການອະນາໄມແອ</h5>
                
              <!-- General Form Elements -->
              <form method="post" action="hdl/room.hdl.php" autocomplete="off" >

              <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

              <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ຫ້ອງເລກທີ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="room_no" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($result = mysqli_fetch_array($room_view)){ ?>
                          <option value="<?php echo $result['id'];?>"><?php echo $result['room_no'];?></option>  
                        <?php } ?>
                    </select>
                  </div>
                </div>

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
                      <button type="submit" class="btn btn-color col-md-3" name="new_air" onclick="return confirm_action()">ບັນທຶກ</button>
                      <a href="w_vacant_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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