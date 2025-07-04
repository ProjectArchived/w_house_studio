<?php

include "header.php";
include "hdl/wutb.sale.hdl.php";

?>

  <main id="main" class="main">

  <section class="section">
      <div class="row">
        
      </div>
    </section>

    <section class="section">
      <div class="row">
        
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-12 order-md-first order-last">

          <div class="card">
            <div class="card-body">

              <div class="col-lg-12">
                <div class="row">

                  <div class="col-lg-4">
                    <h5 class="card-title f-header">ສະຫຼຸບການເຄື່ອນໄຫວ</h5>
                  </div>
                
                  <div class="col-lg-8">
                    <div class="row justify-content-md-end">
                      <a href="wutb_sale.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ຂາຍຂະໜົມ</a>
                      <a href="wutb_sale_payment.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ຊຳລະໜີ້</a>
                      <a href="wutb_sale_return.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ສົ່ງຄືນ ແລະ ຖິ້ມ</a>
                      <a href="wutb_sale_reserve_approve.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ແກ້ໄຂລາຍການຈອງ <?php 
                        if($no_reserve['no_booking']>0){
                          echo '<span class="badge bg-warning">';
                          echo $no_reserve['no_booking'];
                          echo '</span>';
                        }
                      ?>
                      </a>
                    </div>
                  </div>

                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th scope="col">ວັນທີ</th>
                      <th>ລາຍການທັງໝົດ</th>
                      <th>ລາຍການລໍຖ້າການກວດ</th>
                      <th>ສະຖານະ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysqli_fetch_array($sale_group_view)){?>
                      <tr class="pointer" onclick="window.open('wutb_sale_detail.php?date=<?php echo $row['group_date'];?>','_self')">
         

                          <td scope="row"><?php
                          
                          $date = $row['group_date'];
                          $date_f = date("d-m-Y", strtotime($date));
                          echo $date_f;
                          
                          ?></td>
                          <td scope="row"><?php echo $row['total']; ?></td>
                          <td scope="row"><?php 
                          if($row['pending'] > 0){
                          echo '<span class="text-danger">';
                          echo $row['pending'];
                          echo '</span>';}
                          ?></td>
                          <td>
                          <?php 
                          if($row['pending'] >= 1) {
                            echo '<span class="badge bg-danger">ຍັງບໍ່ສຳເລັດ</span>';
                          } else {
                            echo '<span class="badge bg-success">ສຳເລັດ</span>';
                          }      
                          ?>   
                          </td>
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