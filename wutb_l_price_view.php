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
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-4">
                    <h5 class="card-title f-header">ປະຫວັດການບັນທຶກລາຄາ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="wutb_price_check.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ກັບຄືນ</a>
                    </div>
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

                      if(!empty($_GET['cat_id'])){

                      $id = $_GET['cat_id'];

                      $check_price = mysqli_query($db, "SELECT * FROM (SELECT * FROM wutb_db_list_menu) as r1 LEFT JOIN (SELECT menu_id, cat_id, unit_price, create_date FROM wutb_db_list_menu_price WHERE id IN (SELECT MAX(id) FROM wutb_db_list_menu_price WHERE cat_id = $id GROUP BY menu_id) ORDER BY menu_id ASC) as r2 ON r1.id = r2.menu_id ORDER by id ASC");

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
                    }?>

                  </tbody>
                </table>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

<?php

include "footer.php";

?>

