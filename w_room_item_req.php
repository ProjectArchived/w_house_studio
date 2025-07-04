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
              <h5 class="card-title f-header">ລາຍລະອຽດຂໍເບີກເຄື່ອງ</h5>

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
                      <?php while($row=mysqli_fetch_array($request_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                        if($row['cat_id'] == 1) {
                          echo "ເຄື່ອງໃຊ້ໄຟຟ້າ".' - '.$row['item_la'].' - '.$row['total'];
                        } elseif($row['cat_id'] == 2) {
                          echo "ເຄື່ອງຄົວ".' - '.$row['item_la'].' - '.$row['total'];
                        } elseif($row['cat_id'] == 3) {
                          echo "ເຄື່ອງຫ້ອງນອນ".' - '.$row['item_la'].' - '.$row['total'];
                        } elseif($row['cat_id'] == 4) {
                          echo "ເຄື່ອງນ້ຳ".' - '.$row['item_la'].' - '.$row['total'];
                        } elseif($row['cat_id'] == 5) {
                          echo "ອຸປະກອນທົ່ວໄປ".' - '.$row['item_la'].' - '.$row['total'];
                        }
                      
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຈຳນວນເຄື່ອງ</label>
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
                      <button type="submit" class="btn btn-color col-md-3" name="item_request" onclick="return confirm_action()" >ບັນທຶກ</button>
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