<?php

include "header.php";
include "hdl/stock.hdl.php";

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
                  <h5 class="card-title f-header">ສະຫຼຸບເຄື່ອງໃນສາງຫ້ອງພັກ</h5>
                  </div>
                  <div class="col-md-9">
                    <div class="row justify-content-md-end">       
                      <a href="w_stock_main.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ກັບຄືນ</a>     
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive-xl">
                <table class="table table-hover table-striped" id="filter"  style="width:100%">
                  <thead>
                    <tr>
                      <th scope="col">ລາຍລະອຽດ</th>
                      <th>ປະເພດ</th>
                      <th>ຈຳນວນທີ່ຊື້</th>
                      <th>ຈຳນວນສົ່ງຄືນ</th>
                      <th>ຈຳນວນທີ່ນຳໃຊ້</th>
                      <th>ຈຳນວນທີ່ໂລະ</th>
                      <th>ຈຳນວນທີ່ເຫຼືອ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row=mysqli_fetch_array($stock_sum_view)){?>
                    <tr>
                      <th><?php echo $row['item_l'];?></th>
                      <td><?php 
                      
                        if($row['cat_id'] == 1){
                          echo 'ເຄື່ອງໃຊ້ໄຟຟ້າ';
                        } elseif ($row['cat_id'] == 2){
                          echo 'ເຄື່ອງຄົວ';
                        } elseif ($row['cat_id'] == 3){
                          echo 'ຫ້ອງນອນ';
                        } elseif ($row['cat_id'] == 4){
                          echo 'ກ່ຽວກັບນ້ຳ';
                        } elseif ($row['cat_id'] == 5){
                          echo 'ອຸປະກອນທົ່ວໄປ';
                        }
                      
                      ?></td>
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
                      if($row['u_return'] > 0){
                        echo '<span class="badge bg-warning">';
                        echo number_format($row['u_return']);
                        echo '</span>';
                      } 
                      ?></td>
                      <td><?php
                      if($row['u_add'] > 0){
                        echo '<span class="badge bg-info">';
                        echo number_format($row['u_add']);
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