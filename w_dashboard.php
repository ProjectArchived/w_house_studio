<?php 
include "header.php";
include "hdl/dashboard.hdl.php";
?>

<main id="main" class="main">

<div class="pagetitle">

</div><!-- End Page Title -->

<section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-xl-6">
              <div class="card info-card revenue-card">
               <div class="card-body">
                  <h5 class="card-title">ລາຍຮັບ <span>| ລວມ</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h3 class="text-success font-weight-bold f-header"><?php echo number_format($total_income).' '.'ກີບ';?></h3>
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
                      <h3 class="text-danger font-weight-bold f-header"><?php echo number_format($total_expense).' '.'ກີບ';?></h3>
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

            <!-- Net Income Per Year-->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title f-header">ກຳໄລ/ຂາດທຶນ ປະຈຳປີ</h5>

                  <table class="table table-borderless datatable table-hover table-striped" >
                    <thead>
                      <tr>
                      <th>ປີ</th>
                      <th>ລາຍຮັບຈາກຫ້ອງພັກ</th>
                      <th>ລາຍຮັບຈາກໄຟຟ້າ</th>
                      <th>ລາຍຈ່າຍໄຟຟ້າ ແລະ ນ້ຳ</th>
                      <th>ລາຍຈ່າຍຊື້ເຄື່ອງ</th>
                      <th>ກຳໄລ/ຂາດທຶນ</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      <?php while($row=mysqli_fetch_array($net_sum_year)){?>
                      <tr>
                        <th><?php echo $row['year'];?></th>
                        <td><?php 
                        
                        if($row['total_rental'] >= 0){
                        echo '<span class="text-success">';
                        echo number_format($row['total_rental']).' '.'ກີບ';
                        echo '</span>';
                        } else {
                        echo '<span class="text-danger">';
                        echo number_format($row['total_rental']).' '.'ກີບ';
                        echo '</span>';
                        }
                        ?></td>
                        <td><?php 
                        if($row['total_electric'] >= 0){
                        
                        echo '<span class="text-success">';
                        echo number_format($row['total_electric']).' '.'ກີບ';
                        echo '</span>';
                        } else {
                        echo '<span class="text-danger">';
                        echo number_format($row['total_electric']).' '.'ກີບ';
                        echo '</span>';
                        }
                        ?></td>
                        <td><?php 

                          if($row['total_bill'] >= 0){
                        
                          echo '<span class="text-danger">';
                          echo number_format($row['total_bill']).' '.'ກີບ';
                          echo '</span>';
                          } 
                        
                        ?></td>
                        <td><?php 

                          if($row['total_purchase'] >= 0){
                                                
                          echo '<span class="text-danger">';
                          echo number_format($row['total_purchase']).' '.'ກີບ';
                          echo '</span>';
                          } 
                        
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

            <!-- Net Income Per Month-->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title f-header">ກຳໄລ/ຂາດທຶນ ປະຈຳເດືອນ</h5>

                  <table class="table table-borderless datatable table-hover table-striped" >
                    <thead>
                      <tr>
                      <th>ປີ</th>
                      <th>ເດືອນ</th>
                      <th>ລາຍຮັບຈາກຫ້ອງພັກ</th>
                      <th>ລາຍຮັບຈາກໄຟຟ້າ</th>
                      <th>ລາຍຈ່າຍໄຟຟ້າ ແລະ ນ້ຳ</th>
                      <th>ລາຍຈ່າຍຊື້ເຄື່ອງ</th>
                      <th>ກຳໄລ/ຂາດທຶນ</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      <?php while($row=mysqli_fetch_array($net_sum_month)){?>
                      <tr>
                        <th><?php echo $row['year'];?></th>
                        <td><?php echo $row['month'];?></td>
                        <td><?php 
                        
                        if($row['total_rental'] >= 0){
                        echo '<span class="text-success">';
                        echo number_format($row['total_rental']).' '.'ກີບ';
                        echo '</span>';
                        } else {
                        echo '<span class="text-danger">';
                        echo number_format($row['total_rental']).' '.'ກີບ';
                        echo '</span>';
                        }
                        ?></td>
                        <td><?php 
                        if($row['total_electric'] >= 0){
                        
                        echo '<span class="text-success">';
                        echo number_format($row['total_electric']).' '.'ກີບ';
                        echo '</span>';
                        } else {
                        echo '<span class="text-danger">';
                        echo number_format($row['total_electric']).' '.'ກີບ';
                        echo '</span>';
                        }
                        ?></td>
                        <td><?php 

                          if($row['total_bill'] >= 0){
                        
                          echo '<span class="text-danger">';
                          echo number_format($row['total_bill']).' '.'ກີບ';
                          echo '</span>';
                          } 
                        
                        ?></td>
                        <td><?php 

                          if($row['total_purchase'] >= 0){
                                                
                          echo '<span class="text-danger">';
                          echo number_format($row['total_purchase']).' '.'ກີບ';
                          echo '</span>';
                          } 
                        
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


            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title f-header">ສະຫຼຸບຂໍ້ຄວາມ</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                      <th>ຫ້ອງ</th>
                      <th>ຂໍ້ຄວາມ</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while($row=mysqli_fetch_array($note_view)){?>
                      <tr>
                        <th><?php echo $row['room_no'];?></th>
                        <td><?php echo $row['notes'];?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End electric bill -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

              <!-- Recent Available Room -->
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title f-header">ສະຖານະຫ້ອງພັກທີ່ວ່າງ</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>ຫ້ອງ</th>
                        <th>ວັນທີອະນາໄມລ້າສຸດ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($row=mysqli_fetch_array($available_room)){?>
                      <tr>
                        <th><?php echo $row['r_id'];?></th>
                        <td><?php echo $row['clean_date'];?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>

                </div>

              </div>

              <!-- Upcoming Electric -->
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title f-header">ຄ່າໄຟຄັ້ງຕໍ່ໄປ</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>ຫ້ອງ</th>
                        <th>ວັນທີ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($row=mysqli_fetch_array($upcom_elec)){
                        
                        $get = $row['forecast'];
                        $change = date("d-m-Y", strtotime($get));
                        
                        
                        ?>
                        <tr>
                        <?php
                        if(date("Y-m-d") > $row['forecast']){
                          echo "<th class='text-danger'>";
                          echo $row['room'];
                          echo "</th>";
                          echo "<td class='text-danger'>";
                          echo $change;
                          echo "</td>";
                        } else {
                          echo "<th>";
                          echo $row['room'];
                          echo "</th>";
                          echo "<td>";
                          echo $change;
                          echo "</td>";
                        }
                        ?>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>

                </div>

              </div>

              <!-- Upcoming Room Fee -->
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title f-header">ຄ່າຫ້ອງຄັ້ງຕໍ່ໄປ</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>ຫ້ອງ</th>
                        <th>ວັນທີ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($row=mysqli_fetch_array($upcom_fee)){

                        $get = $row['end_date'];
                        $change = date("d-m-Y", strtotime($get));
                        
                        ?>

                        <tr>
                        <?php
                        if(date("Y-m-d") > $row['end_date']){
                          echo "<th class='text-danger'>";
                          echo $row['room'];
                          echo "</th>";
                          echo "<td class='text-danger'>";
                          echo $change;
                          echo "</td>";
                        } else {
                          echo "<th>";
                          echo $row['room'];
                          echo "</th>";
                          echo "<td>";
                          echo $change;
                          echo "</td>";
                        }
                        ?>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>

                </div>

              </div>

              <!-- Recent Deposit -->
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title f-header">ສະຫຼຸບເງິນມັດຈຳ</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">ຫ້ອງ</th>
                        <th scope="col">ຈຳນວນ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($row=mysqli_fetch_array($v_deposit)){?>
                      <tr>
                        <th>
                        <?php
                        
                        echo $row['room_no'];
                        
                        ?>
                        </th>
                        <td>
                        <?php
                        
                        if(!empty($row['currency'])){
                          $currency_id = $row['currency'];

                          $query = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $currency_id");
                          $result = mysqli_fetch_array($query);

                          echo number_format($row['amount']).' '.$result['currency_la'];
                        }
                        
                        ?>
                        </td>
                        <?php }?>
                      </tr>
                    </tbody>
                    <tfoot>
                      <?php while($row=mysqli_fetch_array($check_deposit)){?>
                      <tr class="table-dark">
                        <td>Total</td>
                        <td>
                         <?php 
                          if(!empty($row['currency'])){
                            $currency_id = $row['currency'];
  
                            $query = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $currency_id");
                            $result = mysqli_fetch_array($query);
  
                            echo number_format($row['sum_amount']).' '.$result['currency_la'];} ?>
                        </td>
                      </tr>
                      <?php } ?> 
                    </tfoot>
                  </table>
                </div>
              </div>
        </div><!-- End Right side columns -->

      </div>
    </section>

    <?php 

    include "footer.php";

    ?>