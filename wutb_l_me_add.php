<?php

include "header.php";
include "hdl/wutb.l.menu.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດເມນູໃໝ່</h5>

              <?php if(!empty($_GET['menu_edit_id'])){

                $id = $_GET['menu_edit_id']; 
                                
                $check = mysqli_query($db, "SELECT * FROM wutb_db_list_menu WHERE id = $id");
                $result = mysqli_fetch_array($check);
                                
                ?>
                <form method="post" action="hdl/wutb.l.menu.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['menu_edit_id'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="type" >
                      <option value="<?php echo $result['type'];?>"><?php 
                        if(!empty($result['type'])){
                          $id = $result['type'];
                          $check = mysqli_query($db, "SELECT * FROM wutb_db_list_price_cat WHERE id = $id");
                          $rs = mysqli_fetch_array($check);
                          echo $rs['desc_la'];
                        } 
                      ?></option>
                        <option value="">--------</option>
                        <?php while($row=mysqli_fetch_array($mcat_view)) {?>
                        <option value="<?php echo $row['id'];?>"><?php    
                            echo $row['desc_la'];
                          ?></option>
                        <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເມນູ (ພາສາອັງກິດ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="menu_en" value="<?php echo $result['menu_en'];?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເມນູ (ພາສາລາວ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="menu_la" value="<?php echo $result['menu_la'];?>">
                  </div>
                  </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <a href="hdl/wutb.l.menu.hdl.php?menu_del_id=<?php echo $_GET['menu_edit_id']; ?>" class="btn btn-outline btn-danger col-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                      <button type="submit" class="btn btn-color col-md-3" name="edit_menu" onclick="return confirm_action()">ແກ້ໄຂເມນູ</button>
                      <a href="wutb_l_menu.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </form>

                <?php }else{?>
              <!-- General Form Elements -->
              <form method="post" action="hdl/wutb.l.menu.hdl.php" autocomplete="off" >
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="type" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($mcat_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php    
                          echo $row['desc_la'];
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເມນູ (ພາສາອັງກິດ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="menu_en" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເມນູ (ພາສາລາວ)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="menu_la" required>
                  </div>
                  </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_menu" onclick="return confirm_action()">ບັນທຶກເມນູໃໝ່</button>
                      <a href="wutb_l_menu.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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