<?php

include "header.php";
include "hdl/wutb.sale.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດການເຮັດຂອງຫວານ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/wutb.sale.hdl.php" autocomplete="off" >

                      <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                      <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">ລາຍການຂະໜົມຫວານ</label>
                        <div class="col-sm-9">
                          <select class="form-select" aria-label="Default select example" name="product_id" required>
                            <option value="">ກົດເພື່ອເລືອກ</option>
                            <?php while($row=mysqli_fetch_array($product_sum)) {?>
                            <option value="<?php echo $row['id'];?>"><?php 
                              
                                echo $row['menu_la'].' - '.$row['total'];
                            
                              ?></option>
                            <?php }?>

                            <option value="">--------</option>

                            <?php while($row=mysqli_fetch_array($product_view_2)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                          echo $row['menu_la'];
                      
                        ?></option>
                      <?php }?>
                          </select>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">ລາຍການຂະໜົມຫວານ</label>
                        <div class="col-sm-9">
                          <select class="form-select" aria-label="Default select example" name="cat_id" required>
                            <option value="">ກົດເພື່ອເລືອກ</option>
                            <option value="2">ເຮັດໃໝ່</option>
                            <option value="3">ລົບອອກ</option>
                          </select>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນ</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" name="unit" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="col-sm-12">
                          <div class="row justify-content-md-end">
                            <button type="submit" class="btn btn-color col-md-3" name="new_bake_advance" onclick="return confirm_action()">ບັນທຶກການເຮັດເຂົ້າໜົມ</button>
                            <a href="wutb_sale_detail.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                          </div>
                        </div>   
                      </div>
                    </form>
              
              <!-- End General Form Elements -->


                <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">ລາຍລະອຽດການເຮັດຂອງຫວານເພີ່ມເຕີມ(ທາງເລືອກ)</label>
                    <div class="col-sm-9">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="remind" value="1" onclick="hideSection()">
                      </div>
                    </div>
                  </div>

                  <div id="hideBox" style="display: none;">
                    <!-- End General Form Elements -->
                    <form method="post" action="hdl/wutb.sale.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລາຍການຂະໜົມຫວານ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="product_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($product_view_3)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                          echo $row['menu_la'];
                      
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນ</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" name="unit" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_bake" onclick="return confirm_action()">ບັນທຶກການເຮັດເຂົ້າໜົມ</button>
                    </div>
                  </div>   
                </div>
              </form>          
            </div>

               



            </div>
          </div>

        </div>

      </div>
    </section>

<?php

include "footer.php";

?>