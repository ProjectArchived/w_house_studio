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
              <h5 class="card-title f-header">ລາຍລະອຽດປະເທດໃໝ່</h5>

              <?php if(!empty($_GET['co_edit_id'])){
                
                $id = $_GET['co_edit_id']; 
                
                $check = mysqli_query($db, "SELECT * FROM w_db_list_country WHERE id = $id");
                $result = mysqli_fetch_array($check);
                
                ?> 
                <form method="post" action="hdl/l.country.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['co_edit_id'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເທດ (ພາສາອັງກິດ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="country_en" value="<?php echo $result['country_en'];?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເທດ (ພາສາລາວ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="country_la" value="<?php echo $result['country_la'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ສັນຊາດ (ພາສາອັງກິດ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="national_en" value="<?php echo $result['national_en'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ສັນຊາດ (ພາສາລາວ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="national_la" value="<?php echo $result['national_la'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <a href="hdl/l.country.hdl.php?country_del_id=<?php echo $_GET['co_edit_id']; ?>" class="btn btn-outline btn-danger col-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                      <button type="submit" class="btn btn-color col-md-3" name="edit_country" onclick="return confirm_action()">ແກ້ໄຂປະເທດ</button>
                      <a href="w_l_country.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </form>

                <?php } else {?>
                
              <!-- General Form Elements -->
              <form method="post" action="hdl/l.country.hdl.php" autocomplete="off" >

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເທດ (ພາສາອັງກິດ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="country_en" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເທດ (ພາສາລາວ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="country_la" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ສັນຊາດ (ພາສາອັງກິດ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="national_en" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ສັນຊາດ (ພາສາລາວ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="national_la" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_country" onclick="return confirm_action()">ບັນທຶກປະເທດໃໝ່</button>
                      <a href="w_l_country.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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