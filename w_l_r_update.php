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
              <h5 class="card-title f-header">ສະຖານະຫ້ອງ <?php echo $_GET['room_edit_id']; ?></h5>

              <?php if(!empty($_GET['room_edit_id'])){

                $id = $_GET['room_edit_id'];
                
                $check_id = mysqli_query($db, "SELECT * FROM w_db_room_lobby WHERE id=$id");
                $result = mysqli_fetch_array($check_id);

                ?>
              <form method="post" action="hdl/room.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="id" value="<?php echo $id;?>">

                <div class="row mb-3">
                  <div class="col-sm-2">
                        <label class="form-check-label">
                          ນຳໃຊ້ຫ້ອງພັກ
                        </label>
                  </div>
                  <div class="col-sm-10">
                        <input class="form-check-input" type="checkbox" name="r_status" value="3" 
                        <?php  
                          if($result['r_status'] == 3){
                            echo "checked";
                          } 
                          ?>>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-2">
                    <label class="form-check-label">
                      ລາຍລະອຽດ
                    </label>
                    
                  </div>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="remark" value="<?php echo $result['remark'];?>">
                  </div>
                </div>

                <?php }?>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_status" onclick="return confirm_action()">ບັນທຶກສະຖານະໃໝ່</button>
                      <a href="w_l_room.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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