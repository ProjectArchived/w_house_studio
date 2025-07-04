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
        <div class="col-lg-12 order-md-first order-last">

          <div class="card">
            <div class="card-body">

              <div class="col-lg-12">
                <div class="row">

                  <div class="col-lg-4">
                    <h5 class="card-title f-header">ການເຄື່ອນໄຫວປະຈຳວັນທີ <?php 
                    $date = $_GET['date'];
                    $date_f = date("d-m-Y", strtotime($date));
                    echo $date_f;
                    ?></h5>
                  </div>
                
                  <div class="col-lg-8">
                    <div class="row justify-content-md-end">
                      
                    <?php 

                      $date = $_GET['date'];
                      $check_date = mysqli_query($db, "SELECT * FROM wutb_db_sale WHERE DATE (create_date) = '$date' AND check_by =''");
                      
                      if(!empty(mysqli_fetch_array($check_date)) && $_SESSION['role'] == 8) {

                          echo '<a href="hdl/wutb.sale.hdl.php?approve_all_rec=';
                          echo $_GET['date'];
                          echo '&user_id=';
                          echo $_SESSION['userid'];
                          echo '" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3" onclick="return confirm_action()">ກວດທັງໝົດ</a>';
                        }
                      ?>

                      <a href="wutb_sale_main.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>

                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ປະເພດ</th>
                      <th>ຂະໜົມຫວານ</th>
                      <th>ຈຳນວນ</th>
                      <th>ລາຄາ</th>
                      <th>ຄ່າສົ່ງ</th>
                      <th>ຍອດລວມ</th>
                      <th>ລູກຄ້າ</th>
                      <th>ໝາຍເຫດ</th>
                      <th>ສະຖານະ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $date = $_GET['date'];
                    $check_rec = mysqli_query($db, "SELECT * FROM wutb_db_sale WHERE DATE (create_date) = '$date' ORDER BY check_by ='' DESC");
                    while($row = mysqli_fetch_array($check_rec)){
                      ?>
                    <tr>
                      <td>
                        <?php 
                          if($row['cat_id'] == 1){
                            echo '<span class="badge bg-success">ຂາຍ</span>';
                          } elseif ($row['cat_id'] == 2){
                            echo '<span class="badge bg-primary">ເຮັດໃໝ່</span>';
                          } elseif ($row['cat_id'] == 3){
                            echo '<span class="badge bg-danger">ລົບອອກ</span>';
                          } elseif ($row['cat_id'] == 4){
                            echo '<span class="badge bg-danger">ສົ່ງຄືນ ແລະ ລົບອອກ</span>';
                          } elseif ($row['cat_id'] == 5){
                            echo '<span class="badge bg-warning">ຈອງ</span>';
                          } elseif ($row['cat_id'] == 6){
                            echo '<span class="badge bg-success">ຊຳລະໜີ້</span>';
                          } 
                        ?>             
                      </td>
                      <td><?php 
                      
                      if(!empty($row['product_id'])){
                        $item_id = $row['product_id'];
                        $item_c = mysqli_query($db, "SELECT * FROM wutb_db_list_menu WHERE id = $item_id");
                        while($result = mysqli_fetch_array($item_c)){
                          echo $result['menu_la'];
                        }
                      }

                      ?></td>
                      <td><?php echo $row['unit'];?></td>
                    
                      <td><?php 
                      if(!empty($row['unit_price'])){
                        if($row['currency'] == 1){
                          echo number_format($row['unit_price']).' '."ກີບ";
                        } elseif($row['currency'] == 2){
                          echo number_format($row['unit_price']).' '."ໂດລາ";
                        } elseif($row['currency'] == 3){
                          echo number_format($row['unit_price']).' '."ບາດ";
                        } elseif($row['currency'] == 4){
                          echo number_format($row['unit_price']).' '."ຢວນ";
                        }
                      } 

                      ?></td>

                      <td><?php 
                      if(!empty($row['delivery_fee'])){
                        echo number_format($row['delivery_fee']).' '."ກີບ";
                      } 
                      ?></td>

                      <td><?php 

                      if($row['cat_id'] == 4){

                        if(!empty($row['currency'])){

                          $currency_id = $row['currency'];

                          $check = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $currency_id");
                          $result = mysqli_fetch_array($check);

                          echo '<p class="text-danger font-weight-bold">';
                          echo number_format($row['total_sale']).' '.$result['currency_la'];
                          echo '</p>';

                        } 

                      } else {

                        if($row['payment'] == 1){

                          if(!empty($row['currency'])){

                            $currency_id = $row['currency'];
  
                            $check = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $currency_id");
                            $result = mysqli_fetch_array($check);
  
                            echo '<p class="text-success font-weight-bold">';
                            echo number_format($row['total_sale']).' '.$result['currency_la'];
                            echo '</p>';
  
                          }
                        } elseif ($row['payment'] == 2) {
                          if(!empty($row['currency'])){

                            $currency_id = $row['currency'];
  
                            $check = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $currency_id");
                            $result = mysqli_fetch_array($check);
  
                            echo '<p class="text-info font-weight-bold">';
                            echo number_format($row['total_sale']).' '.$result['currency_la'];
                            echo '</p>';
  
                          }
                        }  else {
                          if(!empty($row['currency'])){

                            $currency_id = $row['currency'];
  
                            $check = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $currency_id");
                            $result = mysqli_fetch_array($check);
  
                            echo '<p class="text-success font-weight-bold">';
                            echo number_format($row['total_sale']).' '.$result['currency_la'];
                            echo '</p>';
  
                          }
                        }
                      }
                      
                      ?></td>
                      <td><?php 
                        if($row['cat_id'] == 6){
                        
                          if(!empty($row['customer_id'])){
                          $customer_id = $row['customer_id'];
                          $customer_c = mysqli_query($db, "SELECT * FROM wutb_db_list_customer WHERE id = $customer_id");
                          while($result = mysqli_fetch_array($customer_c)){
                              echo $result['name'];
                          }
                        }
                      } else {
                        if(!empty($row['customer_id'])){
                          $customer_id = $row['customer_id'];
                          $customer_c = mysqli_query($db, "SELECT * FROM wutb_db_list_customer WHERE id = $customer_id");
                          while($result = mysqli_fetch_array($customer_c)){

                            if(!empty($result['branch'])){
                              echo $result['name']. ' - ' .$result['branch'];
                            } else {
                              echo $result['name'];
                            }
                          }
                        }
                      }
                      
                      ?></td>
                      <td><?php echo $row['notes'];?></td>
                      <td><?php 
                      
                      if(empty($row['check_by'])) {
                        if($_SESSION['role'] == 8){
                          echo '<a href="hdl/wutb.sale.hdl.php?sale_check_id=';
                          echo $row['id']; 
                          echo '&user_id=';
                          echo $_SESSION['userid'];
                          echo '&date=';
                          echo $_GET['date'];
                          echo '" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-check-circle me-1"></i>ລໍຖ້າກວດຄືນ</a>';
                         } else {
                          echo '<span class="badge bg-danger">ລໍຖ້າກວດຄືນ</span>';
                        }
                        
                      } else {
                        echo '<span class="badge bg-success">ກວດແລ້ວ</span>';
                      }    
                      ?>
                    </td>                            
                    <td>
                        <?php if($_SESSION['role'] == 8 || empty($row['check_by'])){?>
                          <a href="wutb_sale.php?sale_edit_id=<?php echo $row['id'];?>&date=<?php echo $_GET['date'];?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil"></i></a>
                        <?php }?>
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