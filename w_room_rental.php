<?php

include "header.php";
include "hdl/room.hdl.php";
include "hdl/l.currency.hdl.php";
?>

  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ຂໍ້ມູນຄ່າເຊົ່າ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/room.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="room_no" value="<?php echo $_GET['room_no']?>">

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <input type="hidden" class="form-control" name="customer_id" value="<?php echo $_GET['customer_id']?>">

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ສັນຍາເລກທີິ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="c_no" placeholder="ສັນຍາເລກທີິ" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລີ່ມວັນທີ</label>
                  <div class="col-sm-9">
                  <?php
                    if (!empty($_GET['customer_id'])){
                      $id =  $_GET['customer_id'];

                      $query = mysqli_query($db, "SELECT * FROM w_db_room_rental WHERE id IN (SELECT MAX(id) FROM w_db_room_rental WHERE customer_id = $id )");
                      $result = mysqli_fetch_array($query);
                      
                      if (!empty($result)){
                        $date = $result['end_date']; 
                        $newDate = date("Y-m-d", strtotime($date));
                      } else {
                        $query = mysqli_query($db, "SELECT * FROM w_db_room_room_info WHERE customer_id = $id");
                        $result = mysqli_fetch_array($query);
                        $date = $result['checkin_date']; 
                        $newDate = date("Y-m-d", strtotime($date));
                      }
                    }
                    
                    ?>
                    <input type="date" class="form-control" name="r_sd" value="<?php echo $newDate; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຮອດວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="r_ed" value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຈຳນວນເງິນທີ່ຈ່າຍ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control number" name="paid_amount" placeholder="ຈຳນວນເງິນ" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ສະກຸນເງິນ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="currency" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                        <?php while($r_currency_view = mysqli_fetch_array($currency_view)){ ?>
                          <option value="<?php echo $r_currency_view['id'];?>"><?php echo $r_currency_view['currency_la'];?></option>  
                        <?php } ?>
                    </select>
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
                      <button type="submit" class="btn btn-color col-md-3" name="new_rental" onclick="return confirm_action()">ບັນທຶກ</button>
                      <a href="w_room_detail.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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