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
              <h5 class="card-title f-header">ແກ້ໄຂລາຍການຈອງ</h5>

              <!-- General Form Elements -->
              <form method="post" action="hdl/wutb.sale.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

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
                  </div>
                </fieldset>

                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ລາຍການຈອງ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="reserve_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($reserve_view)) {?>
                      <option value="<?php echo $row['id'];?>"><?php 
                      
                      $create_date = $row['create_date'];
                      if(!empty($row['create_date'])){
                        $o_f = $row['create_date'];
                        $n_f = date("d-m-Y", strtotime($o_f));
                        
                      }

                      if(!empty($row['product_id'])){
                        $product_id = $row['product_id'];
                        $product_c = mysqli_query($db, "SELECT * FROM wutb_db_list_menu WHERE id = $product_id");
                        $product_r = mysqli_fetch_array($product_c);
                      }

                      if(!empty($row['customer_id'])){
                        $customer_id = $row['customer_id'];
                        $customer_c = mysqli_query($db, "SELECT * FROM wutb_db_list_customer WHERE id = $customer_id");
                        $customer_r = mysqli_fetch_array($customer_c);
                      }

                      if(!empty($row['currency'])){
                        $currency_id = $row['currency'];
                        $currency_c = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $currency_id");
                        $currency_r = mysqli_fetch_array($currency_c);
                      }

                      echo $n_f.' - '.$product_r['menu_la'].' - '.$customer_r['name'].' - '.$row['unit'].' - '.number_format($row['total_sale']).' '.$currency_r['currency_la'];  

                      ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຄ່າສົ່ງ (ກີບ, ຖ້າມີ)</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control number" name="delivery_fee">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="update_reserve" onclick="return confirm_action()">ບັນທຶກແກ້ໄຂການຈອງ</button>
                      <a href="wutb_sale_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>   
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

      </div>
    </section>

<?php

include "footer.php";

?>