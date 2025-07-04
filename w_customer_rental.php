<?php

include "header.php";
include "hdl/customer.hdl.php";

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
                    <h5 class="card-title f-header">ລາຍການຊຳລະຄ່າຫ້ອງ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_room_customers.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                <thead>
                    <tr>
                      <th>ລະຫັດລູກຄ້າ</th>
                      <th>ຫ້ອງເລກທີ</th>
                      <th>ສັນຍາເລກທີ</th>
                      <th>ເລີ່ມສັນຍາວັນທີ</th>
                      <th>ສິ້ນສຸດສັນຍາວັນທີ</th>
                      <th>ຈຳນວນເງິນ</th>
                      <th>ບັນທຶກວັນທີ</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($view_customer_rental)){?>
                    <tr>
                      <td><?php echo $row['customer_id']; ?></td>
                      <td><?php echo $row['room_no']; ?></td>
                      <td><?php echo $row['contract_no']; ?></td>
                      <td><?php
                      $start_date = $row['start_date'];
                      $start_date_f = date("d-m-Y", strtotime($start_date));
                      echo $start_date_f;?></td>
                      <td><?php
                      $end_date = $row['end_date'];
                      $end_date_f = date("d-m-Y", strtotime($end_date));
                      echo $end_date_f;?></td>
                      <td><?php 
                      if(!empty($row['currency'])){
                        $currency = $row['currency'];
                        $currency_check = mysqli_query($db,"SELECT * FROM w_db_list_currency WHERE id = $currency");
                        $currency_result = mysqli_fetch_array($currency_check);
                        echo number_format($row['paid_amount']).' '.$currency_result['currency_la'];
                      }?></td>
                      <td><?php 
                      $create_date = $row['create_date'];
                      $create_date_f = date("d-m-Y", strtotime($create_date));
                      echo $create_date_f;
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

