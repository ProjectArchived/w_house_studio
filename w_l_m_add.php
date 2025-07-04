<?php

include "header.php";
include "hdl/l.meter.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດການບໍລິການ</h5>

              <?php if(!empty($_GET['meter_edit_id'])){
                
                $id = $_GET['meter_edit_id']; 
                
                $check = mysqli_query($db, "SELECT * FROM w_db_list_meter WHERE id = $id");
                $result = mysqli_fetch_array($check);
                
                ?>

                <form method="post" action="hdl/l.meter.hdl.php">

                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['meter_edit_id'];?>">

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ປະເພດບໍລິການ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id">
                      <option value="<?php echo $result['cat_id'];?>"><?php 
                        if($result['cat_id'] == 1){
                          echo 'ໄຟຟ້າ';
                        } elseif($result['cat_id'] == 2){
                          echo 'ນ້ຳ';
                        } elseif($result['cat_id'] == 3){
                          echo 'ອິນເຕີເນັດ';
                        }
                      ?></option>
                      <option value="">--------</option>
                      <option value="1">ໄຟຟ້າ</option>
                      <option value="2">ນ້ຳ</option>
                      <option value="3">ອິນເຕີເນັດ</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລກທີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="meter_no" value="<?php echo $result['meter_no'];?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລກບັນຊີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="account_no" value="<?php echo $result['account_no'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ເລກຜູ້ໃຊ້</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="user_no" value="<?php echo $result['user_no'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຊື່ ແລະ ນາມສະກຸນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="name" value="<?php echo $result['name'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ສະຖານທີ່</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="location" value="<?php echo $result['location'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ເບີໂທສຸກເສີນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="m_call" value="<?php echo $result['emergency_call'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <a href="hdl/l.meter.hdl.php?meter_del_id=<?php echo $_GET['meter_edit_id']; ?>" class="btn btn-outline btn-danger col-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                      <button type="submit" class="btn btn-color col-md-3" name="update_meter" onclick="return confirm_action()">ແກ້ໄຂລາຍລະອຽດ</button>
                      <a href="w_l_meter.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>

              </form>

                <?php } else {?>

              <!-- General Form Elements -->
              <form method="post" action="hdl/l.meter.hdl.php" autocomplete="off" >

              <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ປະເພດບໍລິການ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <option value="1">ໄຟຟ້າ</option>
                      <option value="2">ນ້ຳ</option>
                      <option value="3">ອິນເຕີເນັດ</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລກທີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="meter_no" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລກບັນຊີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="account_no" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ເລກຜູ້ໃຊ້</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="user_no" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຊື່ ແລະ ນາມສະກຸນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="name" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ສະຖານທີ່</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="location" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ເບີໂທສຸກເສີນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="m_call" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_meter" onclick="return confirm_action()">ບັນທຶກການບໍລິການໃໝ່</button>
                      <a href="w_l_meter.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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