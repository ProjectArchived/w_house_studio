<?php 
include "header.php";
include "hdl/wutb.dashboard.hdl.php";
?>

<main id="main" class="main">

<div class="pagetitle">

</div><!-- End Page Title -->

<section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-xl-6">
              <div class="card info-card revenue-card">
               <div class="card-body">
                  <h5 class="card-title">ລາຍຮັບ <span>| ລວມ</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h3 class="text-success font-weight-bold f-header"><?php echo number_format($total_sale['total_sale']).' '.'ກີບ';?></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">ລາຍຈ່າຍ <span>| ລວມ</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h3 class="text-danger font-weight-bold f-header"><?php echo number_format($total_expense['total_expense']).' '.'ກີບ';?></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Customers Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">ສຸດທິ <span>| ລວມ</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <?php 

                      if($net > 0){
                        echo '<h3 class="text-success font-weight-bold f-header">';
                        echo number_format($net).' '.'ກີບ';
                        echo '</h3>';
                      } else {
                        echo '<h3 class="text-danger font-weight-bold f-header">';
                        echo number_format($net).' '.'ກີບ';
                        echo '</h3>';
                      }

                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Customers Card -->

            <!-- Net Income -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title f-header">ກຳໄລ/ຂາດທຶນ </h5>

                  <table class="table table-borderless datatable table-hover table-striped" >
                    <thead>
                      <tr>
                      <th>ປີ</th>
                      <th>ເດືອນ</th>
                      <th>ລາຍຮັບຈາກອາຫານ</th>
                      <th>ລາຍຮັບຈາກຂົນສົ່ງ</th>
                      <th>ລາຍຈ່າຍ</th>
                      <th>ຈຳນວນສົ່ງຄຶນ</th>
                      <th>ກຳໄລ/ຂາດທຶນ</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      <?php while($row=mysqli_fetch_array($net_sum)){?>
                      <tr>
                        <th><?php echo $row['year'];?></th>
                        <td><?php echo $row['month'];?></td>
                        <td><?php 
                        
                        if($row['total_sale'] >= 0){
                        echo '<span class="text-success">';
                        echo number_format($row['total_sale']).' '.'ກີບ';
                        echo '</span>';
                        } else {
                        echo '<span class="text-danger">';
                        echo number_format($row['total_sale']).' '.'ກີບ';
                        echo '</span>';
                        }
                        ?></td>

                        <td><?php 
                        if($row['delivery_fee'] >= 0){
                        
                        echo '<span class="text-success">';
                        echo number_format($row['delivery_fee']).' '.'ກີບ';
                        echo '</span>';
                        } else {
                        echo '<span class="text-danger">';
                        echo number_format($row['delivery_fee']).' '.'ກີບ';
                        echo '</span>';
                        }
                        ?></td>
                        <td><?php 
                        echo '<span class="text-danger">';
                        echo number_format($row['total_purchase']).' '.'ກີບ';
                        echo '</span>';
                           ?></td>

                        <td><?php 
                        echo '<span class="text-danger">';
                        echo number_format($row['total_return']).' '.'ກີບ';
                        echo '</span>';
                           ?></td>
                        <td><?php 

                          if($row['total'] > 0){
                                                
                          echo '<span class="text-success">';
                          echo number_format($row['total']).' '.'ກີບ';
                          echo '</span>';
                          } else {
                          echo '<span class="text-danger">';
                          echo number_format($row['total']).' '.'ກີບ';
                          echo '</span>';
                          }
                        
                        ?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End sum Net Income -->

            <!-- Sale per product -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title f-header">ສະຫຼຸບການຂາຍແຍກຕາມປະເພດອາຫານ </h5>

                  <table class="table table-borderless datatable table-hover table-striped" >
                    <thead>
                      <tr>
                      <th>ປີ</th>
                      <th>ເດືອນ</th>
                      <th>ປະເພດອາຫານ</th>
                      <th>ຈຳນວນທີ່ຂາຍ</th>
                      <th>ເປັນເງິນທັງໝົດ</th>
                      <th>ຈຳນວນສົ່ງຄຶນ</th>
                      <th>ເປັນເງິນທັງໝົດ</th>
                      <th>ລາຍຮັບທັງໝົດ</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      <?php while($row=mysqli_fetch_array($per_product)){?>
                      <tr>
                        <th><?php echo $row['year'];?></th>
                        <td><?php echo $row['month'];?></td>
                        <td><?php 
                        
                        if(!empty($row['product_id'])){
                        $id = $row['product_id'];
                        $get_info = mysqli_query($db, "SELECT * FROM wutb_db_list_menu WHERE id = $id");
                        $rec_info = mysqli_fetch_array($get_info);

                        echo $rec_info['menu_en'];

                        }
                        ?></td>
                        <td><?php 
                          echo '<span class="text-success">';
                          echo number_format($row['total_unit_sale']);
                          echo '</span>';
                        ?></td>
                        <td><?php               
                          echo '<span class="text-success">';
                          echo number_format($row['total_sale']).' '.'ກີບ';
                          echo '</span>';
                        ?></td>
                        <td><?php 
                          echo '<span class="text-danger">';
                          echo number_format($row['total_unit_return']);
                          echo '</span>';
                        ?></td>
                        <td><?php 
                          echo '<span class="text-danger">';
                          echo number_format($row['total_return']).' '.'ກີບ';
                          echo '</span>';
                        ?></td>
                        <td><?php 
                          if($row['total'] > 0){                
                          echo '<span class="text-success">';
                          echo number_format($row['total']).' '.'ກີບ';
                          echo '</span>';
                          } else {
                          echo '<span class="text-danger">';
                          echo number_format($row['total']).' '.'ກີບ';
                          echo '</span>';
                          }
                        ?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- Sale per product -->


             <!-- Sale per customer -->
             <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title f-header">ສະຫຼຸບການຂາຍແຍກຕາມປະເພດລູກຄ້າ </h5>

                  <table class="table table-borderless datatable table-hover table-striped" >
                    <thead>
                      <tr>
                      <th>ປີ</th>
                      <th>ເດືອນ</th>
                      <th>ລູກຄ້າ</th>
                      <th>ຈຳນວນທີ່ຂາຍ</th>
                      <th>ເປັນເງິນທັງໝົດ</th>
                      <th>ຈຳນວນສົ່ງຄຶນ</th>
                      <th>ເປັນເງິນທັງໝົດ</th>
                      <th>ລາຍຮັບທັງໝົດ</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      <?php while($row=mysqli_fetch_array($per_customer)){?>
                      <tr>
                        <th><?php echo $row['year'];?></th>
                        <td><?php echo $row['month'];?></td>
                        <td><?php 
                        
                        if(!empty($row['customer_id'])){
                        $id = $row['customer_id'];
                        $get_info = mysqli_query($db, "SELECT * FROM wutb_db_list_customer WHERE id = $id");
                        $rec_info = mysqli_fetch_array($get_info);

                          if(!empty($rec_info['branch'])){
                            echo $rec_info['name'].' - '.$rec_info['branch'];
                          } else {
                            echo $rec_info['name'];
                          }
                        }
                        ?></td>
                        <td><?php 
                          echo '<span class="text-success">';
                          echo number_format($row['total_unit_sale']);
                          echo '</span>';
                        ?></td>
                        <td><?php           
                          echo '<span class="text-success">';
                          echo number_format($row['total_sale']).' '.'ກີບ';
                          echo '</span>';
                        ?></td>
                        <td><?php 
                          echo '<span class="text-danger">';
                          echo number_format($row['total_unit_return']);
                          echo '</span>';
                        ?></td>
                        <td><?php                 
                          echo '<span class="text-danger">';
                          echo number_format($row['total_return']).' '.'ກີບ';
                          echo '</span>';
                        ?></td>
                        <td><?php 

                        if($row['total'] > 0){
                                              
                        echo '<span class="text-success">';
                        echo number_format($row['total']).' '.'ກີບ';
                        echo '</span>';
                        } else {
                        echo '<span class="text-danger">';
                        echo number_format($row['total']).' '.'ກີບ';
                        echo '</span>';
                        }

                        ?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- Sale per customer -->

            <!-- Sale per customer -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                <h5 class="card-title f-header">ສະຖານະລູກຄ້າຕິດໜີ້</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>ລູກຄ້າ</th>
                        <th>ຈຳນວນຄ້າງຊຳລະ (ສະສົມ)</th>
                        <th>ຊຳລະຄັ້ງສຸດທ້າຍ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($row=mysqli_fetch_array($check_debt)){?>
                      <tr>
                        <th><?php echo $row['name'];?></th>
                        <td><?php echo number_format($row['remain_debt']).' '.'ກີບ';?></td>
                        <th><?php echo $row['settle_date'];?></th>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- Sale per customer -->

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

    <?php 

    include "footer.php";

    ?>