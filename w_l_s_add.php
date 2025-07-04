<?php

include "header.php";
include "hdl/l.supplier.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດຮ້ານຄ້າໃໝ່</h5>

              <?php if(!empty($_GET['supplier_edit_id'])){
                
                $id = $_GET['supplier_edit_id']; 
                
                $check = mysqli_query($db, "SELECT * FROM w_db_list_supplier WHERE id = $id");
                $result = mysqli_fetch_array($check);
                
                ?>
                <form method="post" action="hdl/l.supplier.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['supplier_edit_id'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເທດ</label>
                  <div class="col-sm-9">
                  <select class="form-select" aria-label="Default select example" name="country">
                    <option value="<?php echo $result['country'];?>"><?php 
                    if(!empty($result['country'])){
                      $c_id = $result['country'];

                      $c_check = mysqli_query($db, "SELECT * FROM w_db_list_country WHERE id = $c_id");
                      $c_result = mysqli_fetch_array($c_check);

                      echo $c_result['country_la'];
                    }
                    ?></option>
                    <option value="">--------</option>
                        <?php while($r_national_view = mysqli_fetch_array($national_view)){ ?>
                          <option value="<?php echo $r_national_view['id'];?>"><?php echo $r_national_view['national_la'];?></option>  
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຮ້ານຄ້າ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="location" value="<?php echo $result['location'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເບີໂທຕິດຕໍ່</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="phone_no" value="<?php echo $result['phone_no'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <a href="hdl/l.supplier.hdl.php?supplier_del_id=<?php echo $_GET['supplier_edit_id']; ?>" class="btn btn-outline btn-danger col-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                      <button type="submit" class="btn btn-color col-md-3" name="edit_supplier" onclick="return confirm_action()">ແກ້ໄຂຮ້ານຄ້າ</button>
                      <a href="w_l_supplier.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </form>

                <?php }else{?>

              <!-- General Form Elements -->
              <form method="post" action="hdl/l.supplier.hdl.php" autocomplete="off" >
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເທດ</label>
                  <div class="col-sm-9">
                  <select class="form-select" aria-label="Default select example" name="country">
                    <option value="">ກົດເພື່ອເລືອກ</option>
                        <?php while($r_national_view = mysqli_fetch_array($national_view)){ ?>
                          <option value="<?php echo $r_national_view['id'];?>"><?php echo $r_national_view['national_la'];?></option>  
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຮ້ານຄ້າ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="location" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເບີໂທຕິດຕໍ່</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="phone_no">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_supplier" onclick="return confirm_action()">ບັນທຶກຮ້ານຄ້າໃໝ່</button>
                      <a href="w_l_supplier.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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