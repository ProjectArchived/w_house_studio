<?php

include "header.php";
include "hdl/wutb.l.expense.hdl.php";
include "hdl/wutb.stock.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດລາຍຈ່າຍໃໝ່</h5>

              <?php if(!empty($_GET['expense_edit_id'])){
                
                
                $id = $_GET['expense_edit_id']; 
                
                $check = mysqli_query($db, "SELECT * FROM wutb_db_list_expense WHERE id = $id");
                $result = mysqli_fetch_array($check);
                
                ?>
                <form method="post" action="hdl/wutb.l.expense.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['expense_edit_id'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id" required>
                      <option value="<?php echo $result['cat_id'];?>"><?php 
                      if(!empty($result['cat_id'])){
                        $id = $result['cat_id'];
                        $check = mysqli_query($db, "SELECT * FROM wutb_db_list_expense_cat WHERE id = $id");
                        $rs = mysqli_fetch_array($check);
                        echo $rs['desc_la'];
                      } 
                      ?></option>
                      <option value="">--------</option>
                      <?php while($row=mysqli_fetch_array($ecat_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php    
                          echo $row['desc_la'];
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ລາຍລະອຽດ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="desc_la" value="<?php echo $result['desc_la'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <a href="hdl/wutb.l.expense.hdl.php?expense_del_id=<?php echo $_GET['expense_edit_id']; ?>" class="btn btn-outline btn-danger col-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                      <button type="submit" class="btn btn-color col-md-3" name="edit_expense" onclick="return confirm_action()">ແກ້ໄຂລາຍຈ່າຍ</button>
                      <a href="wutb_l_expense.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </form>
                <?php } else {?>
              <!-- General Form Elements -->

              <form method="post" action="hdl/wutb.l.expense.hdl.php" autocomplete="off" >
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($ecat_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php    
                          echo $row['desc_la'];
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ລາຍລະອຽດ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="desc_la" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_expense" onclick="return confirm_action()">ບັນທຶກລາຍຈ່າຍໃໝ່</button>
                      <a href="wutb_l_expense.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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