<?php

include "header.php";
include "hdl/wutb.stock.hdl.php";

?>

  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-3">
                  <h5 class="card-title f-header">ສະຫຼຸບເຄື່ອງໃນສາງຮ້ານຂະໜົມ</h5>
                  </div>
                  <div class="col-md-9">
                    <div class="row justify-content-md-end"> 
                      <a href="wutb_stock_main.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ກັບຄືນ</a>        
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ລາຍລະອຽດ</th>
                      <th>ປະເພດ</th>
                      <th>ຫົວໜ່ວຍ</th>
                      <th>ຈຳນວນທີ່ຊື້</th>
                      <th>ຈຳນວນທີ່ນຳໃຊ້</th>
                      <th>ຈຳນວນທີ່ໂລະອອກ</th>
                      <th>ຈຳນວນທີ່ເຫຼືອ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row=mysqli_fetch_array($stock_wutb_sum_view)){?>
                    <tr>
                      <td><?php echo $row['item_la'];?></td>
                      <td><?php 
                      
                        if($row['cat_id'] == 1){
                          echo 'ສ່ວນປະສົມ';
                        } elseif ($row['cat_id'] == 2){
                          echo 'ຖົງຕ່າງໆ ແລະ​ ເຈ້ຍ';
                        } elseif ($row['cat_id'] == 3){
                          echo 'ອຸປະກອນເຄັກ';
                        } elseif ($row['cat_id'] == 4){
                          echo 'ແພັກແກັດຈິງ';
                        } elseif ($row['cat_id'] == 5){
                          echo 'ບໍລິຫານ';
                        }

                      
                      ?></td>
                      <td><?php echo $row['unit'];?></td>
                      <td><?php 
                       if($row['u_purchase'] > 0){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['u_purchase']);
                        echo '</span>';
                      } else {
                        echo '<span class="badge bg-muted">';
                        echo number_format($row['u_purchase']);
                        echo '</span>';
                      } 
                      ?></td>
                      <td><?php 
                      if($row['u_use'] > 0){
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['u_use']);
                        echo '</span>';
                      } 
                      ?></td>
                      <td><?php
                      if($row['u_dispose'] > 0){
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['u_dispose']);
                        echo '</span>';
                      } 
                      ?></td>
                      <td><?php
                      if($row['total'] > 0){
                        echo '<span class="badge bg-success">';
                        echo number_format($row['total']);
                        echo '</span>';
                      } else {
                        echo '<span class="badge bg-danger">';
                        echo number_format($row['total']);
                        echo '</span>';
                      }
                      ?></td>
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