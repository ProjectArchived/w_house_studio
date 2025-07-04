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

                  <div class="col-lg-4">
                    <h5 class="card-title f-header">ສະຫຼຸບການເຄື່ອນໄຫວ</h5>
                  </div>
                
                  <div class="col-lg-8">
                    <div class="row justify-content-md-end">
                      <a href="wutb_stock_buy.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ຊື້ເຄື່ອງໃໝ່</a>
                      <a href="wutb_stock_use.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ນຳໃຊ້ເຄື່ອງ</a>   
                      <a href="wutb_stock_dispose.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ໂລະເຄື່ອງອອກ</a>     
                      <a href="wutb_stock_sum.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ສະຫຼຸບເຄື່ອງໃນສາງ</a>    
                    </div>
                  </div>

                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th scope="col">ວັນທີ</th>
                      <th>ຈຳນວນລາຍການທັງໝົດ</th>
                      <th>ຈຳນວນລາຍການບໍ່ທັນສຳເລັດ</th>
                      <th>ສະຖານະ</th>
                    </tr>
                  </thead>
                  <tbody data-link="row" class="rowlink">
                    <?php while($row = mysqli_fetch_array($wutb_stock_view)){?>
                      <tr class="pointer" onclick="window.open('wutb_stock_detail.php?date=<?php echo $row['group_date'];?>','_self')">

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