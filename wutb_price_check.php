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
              <h5 class="card-title f-header">ລາຍລະອຽດລາຄາ</h5>
              
              <!-- General Form Elements -->
              <form method="post" action="hdl/wutb.l.menu.hdl.php">

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ປະເພດລາຄາ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="cat_id" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                      <?php while($row=mysqli_fetch_array($price_cat_select)){?>
                      <option value="<?php echo $row['id'];?>"><?php echo 'ລາຄາ'.' '.$row['id'].' - '.$row['desc_la'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="price_check">ເລືອກປະເພດລາຄາ</button>
                    </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

      </div>
    </section>

    <?php if(!empty($_GET['cat_id'])){
      
      $id = $_GET['cat_id'];

      $check_price = mysqli_query($db, "SELECT * FROM (SELECT * FROM wutb_db_list_menu) as r1 LEFT JOIN (SELECT menu_id, cat_id, unit_price, create_date FROM wutb_db_list_menu_price WHERE id IN (SELECT MAX(id) FROM wutb_db_list_menu_price WHERE cat_id = $id GROUP BY menu_id) ORDER BY menu_id ASC) as r2 ON r1.id = r2.menu_id ORDER by id ASC");?>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-4">
                    <h5 class="card-title f-header">

                    <?php 
                    $check_cat = mysqli_query($db, "SELECT * FROM wutb_db_list_price_cat WHERE id = $id");
                    $cat_result = mysqli_fetch_array($check_cat);
                    
                    echo 'ລາຄາ '.$cat_result['id'].' - '.$cat_result['desc_la'];?>

                    </h5>
                  </div>
                  
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ວັນທີບັນທຶກ</th>
                      <th>ລາຍການອາຫານ</th>
                      <th>ປະເພດລາຄາ</th>
                      <th>ລາຄາຂາຍ</th> 
                    </tr>
                  </thead>
                  <tbody>

                    <?php 

                      while($row = mysqli_fetch_array($check_price)){?>
                    <tr>
                      <td><?php 
                      if($row['create_date'] > 0){
                        $c_d = $row['create_date'];
                        $r_c_d = date("d-m-Y", strtotime($c_d));
                        echo $r_c_d;
                        }
                      ?></td>
                      <td><?php echo $row['menu_la'];?></td>
                      <td><?php 
                      
                      if(!empty($row['cat_id'])){

                        $id = $row['cat_id'];

                        $query = mysqli_query($db, "SELECT * FROM wutb_db_list_price_cat WHERE id = $id");
                        $result = mysqli_fetch_array($query);
 
                        echo 'ລາຄາ'.' '.$result['id'].' - '.$result['desc_la'];
                      }
                      
                      ?></td>
                      <td><?php echo number_format($row['unit_price'])." "."ກີບ"; ?></td>
                    </tr> 
                    <?php }
                    ?>

                  </tbody>
                </table>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
    <?php }?>

<?php

include "footer.php";

?>