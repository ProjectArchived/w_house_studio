<?php

include "header.php";
include "hdl/l.currency.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດສະກຸນເງິນໃໝ່</h5>
              <?php if(!empty($_GET['cu_edit_id'])){
                
                $id = $_GET['cu_edit_id']; 
                
                $check = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $id");
                $result = mysqli_fetch_array($check);
                
                ?>

                  <form method="post" action="hdl/l.currency.hdl.php" autocomplete="off" >

                  <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['cu_edit_id'];?>">

                    <div class="row mb-3">
                      <label for="inputDate" class="col-sm-3 col-form-label">ສະກຸນເງິນ (ພາສາອັງກິດ)</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="currency_en" value="<?php echo $result['currency_en'];?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputDate" class="col-sm-3 col-form-label">ສະກຸນເງິນ (ພາສາລາວ)</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="currency_la" value="<?php echo $result['currency_la'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-sm-12">
                        <div class="row justify-content-md-end">
                          <a href="hdl/l.currency.hdl.php?currency_del_id=<?php echo $_GET['cu_edit_id']; ?>" class="btn btn-outline btn-danger col-sm-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                          <button type="submit" class="btn btn-color col-sm-3" name="edit_currency" onclick="return confirm_action()">ແກ້ໄຂສະກຸນເງິນ</button>
                          <a href="w_l_currency.php" class="btn btn-outline btn-color col-sm-3">ກັບຄືນ</a>
                        </div>
                      </div>
                    </div>
                  </form>

                <?php }else{?>
                
              <!-- General Form Elements -->
              <form method="post" action="hdl/l.currency.hdl.php" autocomplete="off" >

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ສະກຸນເງິນ (ພາສາອັງກິດ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="currency_en" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ສະກຸນເງິນ (ພາສາລາວ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="currency_la" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-sm-3" name="new_currency" onclick="return confirm_action()">ບັນທຶກສະກຸນເງິນໃໝ່</button>
                      <a href="w_l_currency.php" class="btn btn-outline btn-color col-sm-3">ກັບຄືນ</a>
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