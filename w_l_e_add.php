<?php

include "header.php";
include "hdl/l.country.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດອັດຕາຄ່າບໍລິການ</h5>

              <?php if(!empty($_GET['e_edit_id'])){
                
                $id = $_GET['e_edit_id']; 
                
                $check = mysqli_query($db, "SELECT * FROM w_db_list_electrict_rate WHERE id = $id");
                $result = mysqli_fetch_array($check);
                
                ?> 
                <form method="post" action="hdl/utility.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['e_edit_id'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="date" value="<?php echo $result['create_date'];?>" required>
                  </div>
                </div> 

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id" required>
                    <option value="<?php echo $result['cat_id'];?>"><?php 
                        if($result['cat_id'] == 1){
                          echo "ໄຟຟ້າ";
                        } elseif ($result['cat_id'] == 2){
                          echo "ນ້ຳ";
                        } elseif ($result['cat_id'] == 3){
                          echo "ອິນເຕີເນັດ"; 
                        } elseif ($result['cat_id'] == 4){
                            echo "ຂີ້ເຫຍື້ອ";
                        } elseif ($result['cat_id'] == 5){
                          echo "ອື່ນໆ";
                      }
                      ?></option>
                      <option value="1">ໄຟຟ້າ</option>
                      <option value="2">ນ້ຳ</option>
                      <option value="3">ອິນເຕີເນັດ</option>
                      <option value="4">ຂີ້ເຫຍື້ອ</option>
                      <option value="5">ອື່ນໆ</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ອັດຕາ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="rate" value="<?php echo $result['rate'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <a href="hdl/utility.hdl.php?electrict_del_id=<?php echo $_GET['e_edit_id']; ?>" class="btn btn-outline btn-danger col-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                      <button type="submit" class="btn btn-color col-md-3" name="edit_electrict_rate" onclick="return confirm_action()">ແກ້ໄຂ</button>
                      <a href="w_l_electrict_rate.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </form>

                <?php } else {?>
                
              <!-- General Form Elements -->
              <form method="post" action="hdl/utility.hdl.php" autocomplete="off" >
              <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="date" value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
              </div> 

              <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id" required>
                      <option value="1">ໄຟຟ້າ</option>
                      <option value="2">ນ້ຳ</option>
                      <option value="3">ອິນເຕີເນັດ</option>
                      <option value="4">ຂີ້ເຫຍື້ອ</option>
                      <option value="5">ອື່ນໆ</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ອັດຕາ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="rate" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_e_rate" onclick="return confirm_action()">ບັນທຶກ</button>
                      <a href="w_l_electrict_rate.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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