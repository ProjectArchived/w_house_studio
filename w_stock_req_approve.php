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
              <h5 class="card-title f-header">ລາຍລະອຽດການຂໍເບີກເຄື່ອງ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/stock.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <?php 
                if(!empty($_GET['request_id'])){
                  $request_id = $_GET['request_id'];
                  $user_id = $_SESSION['userid'];
                                                
                  $query_1 = mysqli_query($db, "SELECT * FROM w_db_stock WHERE id = '$request_id'");
                  $result_1 = mysqli_fetch_array($query_1);
                                                
                  $customer_id = $result_1['customer_id'];
                  $query_2 = mysqli_query($db, "SELECT * FROM w_db_room_customer_info WHERE id = '$customer_id'");
                  $result_2 = mysqli_fetch_array($query_2);

                  ?>

                    <input type="hidden" class="form-control" name="request_id" value="<?php echo $_GET['request_id'];?>">

                    <input type="hidden" class="form-control" name="customer_name" value="<?php echo $result_2['fname'].' '.$result_2['lname'];?>">

                    <input type="hidden" class="form-control" name="customer_id" value="<?php echo $result_2['id'];?>">


                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຫ້ອງເລກທີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="room_no" value="<?php echo $result_1['room_no'];?>" readonly>
                  </div>
                </div> 

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ລາຍການເຄື່ອງ</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="item_id" value="<?php echo $result_1['item_id']; ?>">
                    <input type="text" class="form-control" name="item_la" value="<?php 
                    
                    if(!empty($result_1['item_id'])){
                      $id = $result_1['item_id'];
                      $query_3 = mysqli_query($db, "SELECT * FROM w_db_list_item WHERE id = '$id'");
                      $result_3 = mysqli_fetch_array($query_3);
                      echo $result_3['item_la'];
                    }
                    
                    ?>" readonly>
                  </div>
                </div> 

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນເຄື່ອງ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="unit" value="<?php echo $result_1['unit'];?>" readonly>
                  </div>
                </div>
                <?php }?> 

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-4" name="new_assign" onclick="return confirm_action()">ບັນທຶກການອະນຸມັດນຳໃຊ້ເຄື່ອງ</button>
                      <a href="w_stock_req_select.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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