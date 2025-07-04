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
                      <a href="wutb_l_p_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກລາຄາໃໝ່</a>
                      <a href="wutb_l_menu.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ວັນທີ</th>
                      <th>ລາຍການອາຫານ</th>
                      <th>ປະເພດລາຄາ</th>
                      <th>ລາຄາຂາຍ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($menu_price_rec)){?>
                    <tr>
                      <td><?php 
                      if($row['create_date'] > 0){
                        $c_d = $row['create_date'];
                        $r_c_d = date("d-m-Y", strtotime($c_d));
                        echo $r_c_d;
                        }
                      ?></td>
                      <td><?php 
                      if(!empty($row['menu_id'])){

                        $id = $row['menu_id'];

                        $query = mysqli_query($db, "SELECT * FROM wutb_db_list_menu WHERE id = $id");
                        $result = mysqli_fetch_array($query);

                        echo $result['menu_la'];
                        }
                      
                      ?></td>
                      <td><?php 
                      
                      if(!empty($row['cat_id'])){

                        $id = $row['cat_id'];

                        $query = mysqli_query($db, "SELECT * FROM wutb_db_list_price_cat WHERE id = $id");
                        $result = mysqli_fetch_array($query);
 
                        echo 'ລາຄາ'.' '.$result['id'].' - '.$result['desc_la'];
                      }
                      
                      ?></td>
                      <td><?php echo number_format($row['unit_price'])." "."ກີບ"; ?></td>
                      <td><a href="hdl/wutb.l.menu.hdl.php?price_del_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-x-lg"></i></a></td>
                    </tr> 
                    <?php }?>

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

