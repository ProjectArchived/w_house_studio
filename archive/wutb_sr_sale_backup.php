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
              <h5 class="card-title f-header">ລາຍລະອຽດການຂາຍ</h5>
              <?php if(!empty($_GET['sale_edit_id'])){
                
                $id = $_GET['sale_edit_id'];
                $sale_check = mysqli_query($db, "SELECT * FROM wutb_db_sale WHERE id = $id");
                
                $sale_result = mysqli_fetch_array($sale_check);
                ?>

                <form method="post" action="hdl/wutb.sale.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">
                <input type="hidden" class="form-control" name="sale_edit_id" value="<?php echo $_GET['sale_edit_id'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດທຸລະກຳ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id">
                    <option value="<?php echo $sale_result['cat_id'];?>">
                    <?php 
                          if($sale_result['cat_id'] == 1){
                            echo 'ຂາຍ';
                          } elseif ($sale_result['cat_id'] == 2){
                            echo 'ເຮັດໃໝ່';
                          } elseif ($sale_result['cat_id'] == 3){
                            echo 'ລົບອອກ';
                          } elseif ($sale_result['cat_id'] == 4){
                            echo 'ສົ່ງຄືນ ແລະ ລົບອອກ';
                          } elseif ($sale_result['cat_id'] == 5){
                            echo 'ຈອງ';
                          } 
                    ?>
                  
                    </option>
                    <option value="">--------</option>
                    <option value="1">ຂາຍ</option>
                    <option value="2">ເຮັດໃໝ່</option>
                    <option value="3">ລົບອອກ</option>
                    <option value="4">ສົ່ງຄືນ ແລະ ລົບອອກ</option>
                    <option value="5">ຈອງ</option>               
                      
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດການຊຳລະ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="payment">
                    <option value="<?php echo $sale_result['payment'];?>">
                    <?php 
                          if(!empty($sale_result['payment'])){
                            if($sale_result['payment'] == 1){
                              echo 'ຈ່າຍສົດ'; 
                            } elseif ($sale_result['payment'] == 2){
                              echo 'ຕິດໜີ້';
                            } 
                          }
                    ?>
                  
                    </option>
                    <option value="">--------</option>
                    <option value="1">ຈ່າຍສົດ</option>
                    <option value="2">ຕິດໜີ້</option>           
                      
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດລາຄາ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="price_type">
                    <option value="<?php echo $sale_result['price_type'];?>">
                      <?php
                      if(!empty($sale_result['price_type'])){

                        $id = $sale_result['price_type'];  
                        $price_check = mysqli_query($db, "SELECT * FROM wutb_db_list_price_cat WHERE id = $id");
                        $price_result = mysqli_fetch_array($price_check);

                        echo 'ລາຄາ ';
                        echo $price_result['id'];
                        echo ' - ';
                        echo $price_result['desc_la'];
                      }
                      ?>
                      </option>
                      <option value="">--------</option>
                      <?php while($row=mysqli_fetch_array($price_cat)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                          echo 'ລາຄາ'.' '.$row['id'].' - '.$row['desc_la'];
                      
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລາຍການຂະໜົມ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="product_id">
                      <?php
                      if(!empty($sale_result['product_id'])){

                        $id = $sale_result['product_id'];  
                        $product_check = mysqli_query($db, "SELECT * FROM wutb_db_list_menu WHERE id = $id");
                        $product_result = mysqli_fetch_array($product_check);
                        
                        echo '<option value="';
                        echo $sale_result['product_id'];
                        echo '">';
                        echo $product_result['menu_la'];
                        echo '</option>';
                      }
                      ?>
                      <option value="">---- ລາຍການຂະໜົມທີ່ຍັງເຫຼືອ ----</option>

                      <?php while($row=mysqli_fetch_array($product_sum)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                        echo $row['menu_la'].' - '.$row['total'];

                        ?></option>
                      <?php }?>

                      <option value="">---- ລາຍການຂະໜົມໃນຮ້ານ ----</option>

                      <?php while($row=mysqli_fetch_array($product_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                          echo $row['menu_la'];
                      
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນຂະໜົມ</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" name="unit" value="<?php echo $sale_result['unit'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຈຳນວນເງິນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control number" name="unit_price" value="<?php 
                    if(!empty($sale_result['unit_price'])){
                      echo number_format($sale_result['unit_price']);
                    }?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ສະກຸນເງິນ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="currency">
                      <?php
                      if(!empty($sale_result['currency'])){

                        $id = $sale_result['currency'];  
                        $currency_check = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $id");
                        $currency_result = mysqli_fetch_array($currency_check);
                        
                        echo '<option value="';
                        echo $sale_result['currency'];
                        echo '">';
                        echo $currency_result['currency_la'];
                        echo '</option>';
                      }
                      ?>
                      <option value="">--------</option>
                      <?php while($row=mysqli_fetch_array($currency_view)){?>
                      <option value="<?php echo $row['id'];?>"><?php echo $row['currency_la'];?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຄ່າສົ່ງ (ກີບ, ຖ້າມີ)</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control number" name="delivery_fee" value="<?php if(!empty($sale_result['delivery_fee'])){
                        echo $sale_result['delivery_fee'];
                      }?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລູກຄ້າ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="customer_id">
                      <?php
                      if(!empty($sale_result['customer_id'])){

                      $id = $sale_result['customer_id'];  
                      $customer_check = mysqli_query($db, "SELECT * FROM wutb_db_list_customer WHERE id = $id");
                      $customer_result = mysqli_fetch_array($customer_check);

                      if(!empty($customer_result['branch'])){

                        echo '<option value="';
                        echo $sale_result['customer_id'];
                        echo '">';
                        echo $customer_result['name'];
                        echo ' - ';
                        echo $customer_result['branch'];  
                        echo '</option>';

                        } else {

                          echo '<option value="';
                          echo $sale_result['customer_id'];
                          echo '">';
                          echo $customer_result['name']; 
                          echo '</option>';
                        }  
                      }
                      ?>
                      <option value="">--------</option>
                      <?php while($row=mysqli_fetch_array($customer_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                      if(!empty($row['branch'])){
                        echo $row['name']. ' - ' . $row['branch'];
                      } else {
                        echo $row['name'];
                      }
                      
                      ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ໝາຍເຫດ</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" placeholder="" id="floatingTextarea" style="height: 100px;" name="notes"><?php echo $sale_result['notes'];?></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                    <?php if($_SESSION['role'] == 8){?>
                        <a href="hdl/wutb.sale.hdl.php?sale_del_id=<?php echo $_GET['sale_edit_id'];?>" class="btn btn-outline btn-dangercol-md-3" onclick="return confirm_action()">ລົບລາຍການ</a>
                      </td>
                    <?php } ?>
                      <button type="submit" class="btn btn-color col-md-3" name="edit_sale">ບັນທຶກການແກ້ໄຂ</button>
                      <a href="wutb_sale_detail.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>   
                </div>
 
              </form>


              <?php }else{?>

              <!-- General Form Elements -->
              <form method="post" action="hdl/wutb.sale.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="create_date"  value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
                </div>

                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-3 pt-0">ປະເພດການຊຳລະ</legend>
                  <div class="col-sm-9 d-flex">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="payment" id="gridRadios1" value="1" checked>
                      <label class="form-check-label" for="gridRadios1">
                      ຈ່າຍສົດ
                      </label>
                    </div>

                    <div class="form-check">
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="payment" id="gridRadios2" value="2">
                      <label class="form-check-label" for="gridRadios2">
                      ຕິດໜີ້
                      </label>
                    </div>

                    <div class="form-check">
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="payment" id="gridRadios2" value="3">
                      <label class="form-check-label" for="gridRadios2">
                      ຈອງ
                      </label>
                    </div>
                  </div>
                </fieldset>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດລາຄາ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="price_type">
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($price_cat)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                          echo 'ລາຄາ'.' '.$row['id'].' - '.$row['desc_la'];
                      
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລາຍການຂະໜົມ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="product_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($product_sum)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                        
                          echo $row['menu_la'].' - '.$row['total'];
                      
                        ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຈຳນວນຂະໜົມ</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" name="unit" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຄ່າສົ່ງ (ກີບ, ຖ້າມີ)</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control number" name="delivery_fee">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລູກຄ້າ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="customer_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($customer_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                      if(!empty($row['branch'])){
                        echo $row['name']. ' - ' . $row['branch'];
                      } else {
                        echo $row['name'];
                      }
                      
                      ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ໝາຍເຫດ</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" placeholder="" id="floatingTextarea" style="height: 100px;" name="notes"></textarea>
                  </div>
                </div>

                <?php if($_SESSION['role'] == 8){?>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">ລາຍລະອຽດເພີ່ມເຕີມ (ທາງເລືອກ)</label>
                    <div class="col-sm-9">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="remind" value="1" onclick="hideSection()">
                      </div>
                    </div>
                  </div>

                  <div id="hideBox" style="display: none;">
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-3 col-form-label">ລາຄາຂະໜົມ</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control number" name="unit_price">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-3 col-form-label">ສະກຸນເງິນ</label>
                      <div class="col-sm-9">
                        <select class="form-select" aria-label="Default select example" name="currency">
                          <option value="">ກົດເພື່ອເລືອກ</option>
                          <?php while($row=mysqli_fetch_array($currency_view)){?>
                          <option value="<?php echo $row['id'];?>"><?php echo $row['currency_la'];?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>

                  </div>

                <?php } ?>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_sale" onclick="return confirm_action()">ບັນທຶກການຂາຍ</button>
                      <a href="wutb_sale_detail.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
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