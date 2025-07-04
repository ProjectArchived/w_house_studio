<?php

include "header.php";
include "hdl/stock.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍການຂໍເບີກເຄື່ອງ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/stock.hdl.php" autocomplete="off" >

                <div class="row mb-3">
                 
                  <div class="col-sm-12">

                    <select class="form-select" aria-label="Default select example" name="request_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($request_view)){?>
                      <option value="<?php echo $row['id'];?>"><?php 

                      if(!empty($row['item_id'])){

                        $id=$row['item_id'];
                        $item_check = mysqli_query($db, "SELECT * FROM w_db_list_item WHERE id = '$id'");
                        $item_r = mysqli_fetch_array($item_check);
                      
                        if($item_r['cat_id'] == 1) {
                          echo "ເຄື່ອງໃຊ້ໄຟຟ້າ".' - '.$item_r['item_la'].' - '.'Room '.$row['room_no'].' - '.$row['unit'];
                        } elseif($item_r['cat_id'] == 2) {
                          echo "ເຄື່ອງຄົວ".' - '.$item_r['item_la'].' - '.'Room '.$row['room_no'].' - '.$row['unit'];
                        } elseif($item_r['cat_id'] == 3) {
                          echo "ເຄື່ອງຫ້ອງນອນ".' - '.$item_r['item_la'].' - '.'Room '.$row['room_no'].' - '.$row['unit'];
                        } elseif($item_r['cat_id'] == 4) {
                          echo "ເຄື່ອງນ້ຳ".' - '.$item_r['item_la'].' - '.'Room '.$row['room_no'].' - '.$row['unit'];
                        } elseif($item_r['cat_id'] == 5) {
                          echo "ອຸປະກອນທົ່ວໄປ".' - '.$item_r['item_la'].' - '.'Room '.$row['room_no'].' - '.$row['unit'];
                        }
                      }
                      ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">  
                      <button type="submit" class="btn btn-color col-md-3" name="new_select" >ເລືອກລາຍການຂໍເບີກເຄື່ອງ</button> 
                      <a href="w_stock_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>                                           
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