<?php

include "header.php";
include "hdl/l.item.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດເຄື່ອງໃຊ້ໃໝ່</h5>
              <?php if(!empty($_GET['item_edit_id'])){
                
                $id = $_GET['item_edit_id']; 
                
                $check = mysqli_query($db, "SELECT * FROM w_db_list_item WHERE id = $id");
                $result = mysqli_fetch_array($check);
                
                ?>

                <form method="post" action="hdl/l.item.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['item_edit_id'];?>">

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ປະເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id">
                      <option value="<?php echo $result['cat_id'];?>"><?php 
                      if($result['cat_id'] == 1){
                        echo 'ເຄື່ອງໃຊ້ໄຟຟ້າ';
                      } elseif ($result['cat_id'] == 2){
                        echo 'ເຄື່ອງຄົວ';
                      } elseif ($result['cat_id'] == 3){
                        echo 'ເຄື່ອງຫ້ອງນອນ';
                      } elseif ($result['cat_id'] == 4){
                        echo 'ເຄື່ອງນ້ຳ';
                      } elseif ($result['cat_id'] == 5){
                        echo 'ອຸປະກອນທົ່ວໄປ';
                      }
                      ?></option>
                      <option value="">--------</option>
                      <option value="1">ເຄື່ອງໃຊ້ໄຟຟ້າ</option>
                      <option value="2">ເຄື່ອງຄົວ</option>
                      <option value="3">ເຄື່ອງຫ້ອງນອນ</option>
                      <option value="4">ເຄື່ອງນ້ຳ</option>
                      <option value="5">ອຸປະກອນທົ່ວໄປ</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເຄື່ອງໃຊ້ (ພາສາອັງກິດ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="item_en" value="<?php echo $result['item_en'];?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເຄື່ອງໃຊ້ (ພາສາລາວ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="item_la" value="<?php echo $result['item_la'];?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ໃຊ້ໃນຫ້ອງພັກ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="room_use">
                      <option value="<?php echo $result['room_use'];?>"><?php 
                      
                      if($result['room_use'] == 1){
                        echo 'ແມ່ນ';
                      } else {
                        echo 'ບໍ່ແມ່ນ';
                      }
                      ?></option>
                      <option value="">--------</option>
                      <option value="1">ແມ່ນ</option>
                      <option value="">ບໍ່ແມ່ນ</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນມາດຖານ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="s_unit" value="<?php echo $result['s_unit'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <a href="hdl/l.item.hdl.php?item_del_id=<?php echo $_GET['item_edit_id']; ?>" class="btn btn-outline btn-danger col-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                      <button type="submit" class="btn btn-color col-md-3" name="edit_item" onclick="return confirm_action()">ແກ້ໄຂເຄື່ອງໃຊ້</button>
                      <a href="w_l_item.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>

              </form>


                <?php }else{?>

              <!-- General Form Elements -->
              <form method="post" action="hdl/l.item.hdl.php" autocomplete="off" >
              <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ປະເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <option value="1">ເຄື່ອງໃຊ້ໄຟຟ້າ</option>
                      <option value="2">ເຄື່ອງຄົວ</option>
                      <option value="3">ເຄື່ອງຫ້ອງນອນ</option>
                      <option value="4">ເຄື່ອງນ້ຳ</option>
                      <option value="5">ອຸປະກອນທົ່ວໄປ</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເຄື່ອງໃຊ້ (ພາສາອັງກິດ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="item_en">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເຄື່ອງໃຊ້ (ພາສາລາວ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="item_la" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ໃຊ້ໃນຫ້ອງພັກ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="room_use">
                      <option value="1">ແມ່ນ</option>
                      <option value="">ບໍ່ແມ່ນ</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນມາດຖານ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="s_unit">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_item" onclick="return confirm_action()">ບັນທຶກເຄື່ອງໃຊ້ໃໝ່</button>
                      <a href="w_l_item.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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