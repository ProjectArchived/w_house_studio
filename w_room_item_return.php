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
              <h5 class="card-title f-header">ລາຍລະອຽດເຄື່ອງສົ່ງຄືນ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/room.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="room_no" value="<?php echo $_GET['room_no']?>">

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <input type="hidden" class="form-control" name="customer_id" value="<?php echo $_GET['customer_id']?>">

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລາຍການເຄື່ອງ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="item_id" required>
                    <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php 
                      $customer_id =  $_GET['customer_id'];
                      $room_no =  $_GET['room_no'];
                      $return_check = mysqli_query($db, "SELECT  r1.id as item_id, r1.s_unit as base_unit, (ifnull(r2.unit,0) + ifnull(r3.total,0)) - ifnull(r4.total,0) as remain_unit  FROM (SELECT * FROM w_db_list_item WHERE room_use = 1) as r1 LEFT JOIN (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = '$room_no' AND cat_id = 1) as r2 ON r1.id = r2.item_id LEFT JOIN (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = '$room_no' AND cat_id = 2 GROUP BY item_id) as r3 ON r1.id = r3.item_id LEFT JOIN (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = '$room_no' AND cat_id = 3 GROUP BY item_id) as r4 ON r1.id = r4.item_id ORDER BY r1.location_id ASC, r1.cat_id ASC");

                      while($row=mysqli_fetch_array($return_check)){
                      ?>
                      <option value="<?php echo $row['item_id'];?>"><?php
                      
                      if(!empty($row['item_id'])){
                        $id = $row['item_id'];
                        $i_query = mysqli_query($db, "SELECT * FROM w_db_list_item WHERE id = $id");
                        $i_r = mysqli_fetch_array($i_query);
                        echo $i_r['item_la'].' ( '.$row['base_unit'].' ) '.' => '.$row['remain_unit'];
                     }
                      
                      ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label" name="unit">ຈຳນວນເຄື່ອງ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="unit" placeholder="ຈຳນວນເຄື່ອງ">
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
                      <button type="submit" class="btn btn-color col-md-3" name="item_return" onclick="return confirm_action()">ບັນທຶກເຄື່ອງສົ່ງຄືນ</button>
                      <a href="w_room_detail.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-outline btn-color col-md-3" >ກັບຄືນ</a>
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