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
             

              <?php if(!empty($_GET['sc_edit_id'])){

                $id = $_GET['sc_edit_id'];
                
                $check_id = mysqli_query($db, "SELECT * FROM w_db_list_service WHERE id=$id");
                $result = mysqli_fetch_array($check_id);

                ?>
              <h5 class="card-title f-header">ແກ້ໄຂປະເພດການບໍລິການ</h5>
              <form method="post" action="hdl/l.meter.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="id" value="<?php echo $id;?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດການບໍລິການ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="description" value="<?php echo $result['description'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ໝາຍເຫດ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="remark" value="<?php echo $result['remark'];?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <a href="hdl/l.meter.hdl.php?del_service_cat=<?php echo $_GET['sc_edit_id']; ?>" class="btn btn-outline btn-danger col-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                      <button type="submit" class="btn btn-color col-md-3" name="update_service_cat" onclick="return confirm_action()">ແກ້ໄຂປະເພດບໍລິການໃໝ່</button>
                      <a href="w_l_servicecat.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

                <?php } else {?>

              <h5 class="card-title f-header">ບັນທຶກປະເພດການບໍລິການໃໝ່</h5>
              <form method="post" action="hdl/l.meter.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="id" value="<?php echo $id;?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດການບໍລິການ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="description">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ໝາຍເຫດ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="remark">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_service_cat" onclick="return confirm_action()">ບັນທຶກປະເພດບໍລິການໃໝ່</button>
                      <a href="w_l_servicecat.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->


                  <?php } ?>
            </div>
          </div>

        </div>

      </div>
    </section>

<?php

include "footer.php";

?>