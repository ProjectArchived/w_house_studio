<?php

include "header.php";
include "hdl/wutb.l.customer.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ແກ້ໄຂປະເພດລາຍຈ່າຍ</h5>


              <?php if(!empty($_GET['customer_cat_edit_id'])){ 
                
                $id = $_GET['customer_cat_edit_id']; 
                
                $check = mysqli_query($db, "SELECT * FROM wutb_db_list_customer_cat WHERE id = $id");
                $result = mysqli_fetch_array($check);
  
              ?>

                <!-- General Form Elements -->

              <form method="post" action="hdl/wutb.l.customer.hdl.php" autocomplete="off" >

              <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['customer_cat_edit_id'];?>">

              <div class="row mb-3">
                <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດລາຍຈ່າຍ</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="desc_la" value="<?php echo $result['desc_la'];?>">
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-12">
                  <div class="row justify-content-md-end">
                    <a href="hdl/wutb.l.customer.hdl.php?ccat_del_id=<?php echo $_GET['customer_cat_edit_id']; ?>" class="btn btn-outline btn-danger col-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                    <button type="submit" class="btn btn-color col-md-3" name="edit_ccat" onclick="return confirm_action()">ແກ້ໄຂປະເພດລາຍຈ່າຍ</button>
                    <a href="wutb_l_customer_cat.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                  </div>
                </div>
              </div>
              </form><!-- End General Form Elements -->

              <?php } else {?>

              <!-- General Form Elements -->

              <form method="post" action="hdl/wutb.l.customer.hdl.php" autocomplete="off" >

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດລາຍຈ່າຍໃໝ່</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="desc_la" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_customer_cat" onclick="return confirm_action()">ບັນທຶກລາຍຈ່າຍໃໝ່</button>
                      <a href="wutb_l_customer_cat.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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