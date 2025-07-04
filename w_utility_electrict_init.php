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
              <h5 class="card-title f-header">ຂໍ້ມູນໄຟຟ້າໃນມື້ເຂົ້າ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/room.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid']?>">

                <input type="hidden" class="form-control" name="customer_id" value="<?php echo $_GET['customer_id']?>">

                <input type="hidden" class="form-control" name="room_no" value="<?php echo $_GET['room_no']?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="e_date" value="<?php 

                    $customer_id = $_GET['customer_id'];
                    $check_start_date = mysqli_query($db, "SELECT * FROM w_db_room_room_info WHERE customer_id = $customer_id");
                    $result = mysqli_fetch_array($check_start_date);
                    
                    echo $result['checkin_date']; 
                    ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຫົວໜ່ວຍ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="start_unit" id="amount" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="start_electrict" onclick="return confirm_action()" >ບັນທຶກ</button>
                      <a href="w_room_detail.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
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