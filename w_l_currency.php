<?php

include "header.php";
include "hdl/l.currency.hdl.php";

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
                    <h5 class="card-title f-header">ລາຍການສະກຸນເງິນ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_l_cu_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກສະກຸນເງິນໃໝ່</a>
                      <a href="w_l_ex_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກອັດຕາແລກປ່ຽນໃໝ່</a>
                      <a href="w_l_exchange_rate.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ປະຫວັດການບັນທຶກອັດຕາແລກປ່ຽນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th scope="col">ສະກຸນເງິນ (ພາສາອັງກິດ)</th>
                      <th>ສະກຸນເງິນ (ພາສາລາວ)</th>
                      <th>ອັດຕາຊື້</th>
                      <th>ອັດຕາຂາຍ</th>
                      <th>ບັນທຶກວັນທີ</th>   
                      <th>#</th>                  
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($currency_exchange_view)){?>
                    <tr>
                      <td><?php echo $row['currency_en']; ?></td>
                      <td><?php echo $row['currency_la']; ?></td>
                      <td><?php 
                      if(!empty($row['buy_rate'])) {
                        echo number_format($row['buy_rate'])." "."ກີບ";
                      }   
                      ?></td>
                      <td><?php
                      if(!empty($row['sell_rate'])) {
                        echo number_format($row['sell_rate'])." "."ກີບ";
                      }   
                      ?></td>
                      <td><?php 
                      if($row['create_date'] > 0){
                      $c_d = $row['create_date'];
                      $r_c_d = date("d-m-Y", strtotime($c_d));
                      echo $r_c_d;
                      }
                      ?></td>
                      <td>
                      <a href="w_l_cu_add.php?cu_edit_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>
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

