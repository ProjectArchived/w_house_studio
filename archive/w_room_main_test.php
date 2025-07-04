<?php 

  include "header.php"; 
  include "hdl/room.hdl.php";

  ?>

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <?php 
              while($row=mysqli_fetch_array($v_reception)){
                $start_date = $row['start_date'];
                $start_date_r= date("d-m-Y", strtotime($start_date));

                $end_date = $row['end_date'];
                $end_date_r= date("d-m-Y", strtotime($end_date));

                $last_paid = $row['last_paid'];
                $last_paid_r= date("d-m-Y", strtotime($last_paid));

                $next_payment = $row['next_payment'];
                $next_payment_r= date("d-m-Y", strtotime($next_payment));

                $checkout_date = $row['checkout_date'];
                $checkout_date_r= date("d-m-Y", strtotime($checkout_date));
                
            ?>

            <!-- single room Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
              <?php 
              // Active / Passive link
              if($row['status'] == 1 && $row['occupy'] == 1){
                // Occupy
                  echo '<a href="w_room_detail.php?room_no=';
                  echo $row['room_no'];
                  echo '&customer_id=';
                  echo $row['customer_id'];
                  echo '">';
              } elseif($row['status'] == 2 && $row['occupy'] == 0){
                // Check out and cleaning
                if($_SESSION['role'] == 8) {
                  echo '<a href="w_room_clean.php?room_no=';
                  echo $row['room_no'];
                  echo '&customer_id=';
                  echo $row['customer_id'];
                  echo '">';
                  }
              } elseif($row['status'] == 0 && $row['occupy'] == 1) {
                // Not Available
                
              } elseif($row['status'] == 1 && $row['occupy'] == 0) {
                // Available

                  if($_SESSION['role'] == 8) {
                  echo '<a href="w_room_checkin.php?room_no=';
                  echo $row['room_no'];
                  echo '">';
                  }
              }
              ?>
                  <div class="card-body">
                    <h5 class="card-title fw-bold"> <?php echo $row['room_no']; ?> | 
                    <?php
                    // Room Status

                    if($row['status'] == 1 && $row['occupy'] == 1){
                      // Occupy
                      echo '<div class="spinner-grow text-danger spinner-size" role="status">
                      <span class="visually-hidden">Loading...</span>
                      </div> <span class="text-danger fw-bold">ບໍ່ວ່າງ</span></h5>';
                    } elseif($row['status'] == 2 && $row['occupy'] == 0){
                      // Check out and cleaning
                      if($_SESSION['role'] == 8) {
                        echo '<div class="spinner-grow text-warning spinner-size" role="status"> 
                        <span class="visually-hidden">Loading...</span> 
                        </div> <span class="text-warning fw-bold">ກຳລັງອະນາໄມ</span>';
                        }
                    } elseif($row['status'] == 0 && $row['occupy'] == 1) {
                      // Not Available
                      echo '<div class="spinner-grow text-danger spinner-size" role="status">
                      <span class="visually-hidden">Loading...</span>
                      </div> <span class="text-danger fw-bold">ບໍ່ວ່າງ</span></h5>';
                    } elseif($row['status'] == 1 && $row['occupy'] == 0) {
                      // Available
                      echo '<div class="spinner-grow text-success spinner-size" role="status"> 
                      <span class="visually-hidden">Loading...</span> 
                      </div> <span class="text-success fw-bold">ວ່າງ</span>';
                    }
                    ?>
                  </h5>
                    <div class="d-flex align-items-center">
                      <div class="ps-3">
                        <h6>
                          <?php 
                          // Customer Name
                            if($row['status'] !== '2'){
                              if (!empty($row['fname'])){
                                echo $row['fname'].' '.$row['lname'];
                              } else {
                                echo $row['remark'];
                              }
                            }
                          ?>
                        </h6>
                        <div>
                          <?php 
                          // Rental detail
                          if($row['status'] !== '2'){
                            if(!empty($row['start_date'])) {
                              // Start date
                              echo ' ເລີ່ມວັນທີ: <span class="text-muted small pt-1 fw-bold">';
                              echo $start_date_r;
                              echo '</span><br>';  

                              // End date
                              if($row['end_date'] >= $_SESSION['date']){
                                echo ' ຮອດວັນທີ: <span class="text-muted small pt-1 fw-bold">';
                                echo $end_date_r;
                                echo '</span><br>';
                              } else {
                                echo ' ຮອດວັນທີ: <span class="text-danger small pt-1 fw-bold">';
                                echo $end_date_r;
                                echo '</span><br>';
                              }
                            }
                          }

                          // Electric
                          // Check for only Existing Customer
                          if($row['status'] == '1' && $row['occupy'] == '1'){
                            // Check for previous registered
                            if (!empty($row['last_paid'])){
                            // check if not paid
                              if(empty($row['paid_receive_by'])){
                                // If not paid
                                echo 'ຄ່າໄຟຄັ້ງລ້າສຸດ: <span class="text-danger small pt-1 fw-bold">';
                                echo  $last_paid_r;
                                echo '</span><br>';

                                // notify next payment
                                echo 'ຄ່າໄຟຄັ້ງຕໍ່ໄປ: <span class="text-info small pt-1 fw-bold">';
                                echo  $next_payment_r;
                                echo '</span><br>';   

                              } else {
                                // if paid
                                echo ' ຄ່າໄຟຄັ້ງລ້າສຸດ: <span class="text-muted small pt-1 fw-bold">';
                                echo  $last_paid_r;
                                echo '</span><br>';

                                // notify next payment
                                echo 'ຄ່າໄຟຄັ້ງຕໍ່ໄປ: <span class="text-info small pt-1 fw-bold">';
                                echo  $next_payment_r;
                                echo '</span><br>';  
                              }

                            } elseif(empty($row['last_paid'])) {

                              // Option 2: New Customer

                              $start_date = $row['start_date'];
                              $start_date_2 = strtotime($start_date);

                              // Add 1 Month to start date
                              $month_add = date("Y-m-d", strtotime("+1 month", $start_date_2));
                              $month_add_c= date("d-m-Y", strtotime($month_add));
                              

                              // Select Last date of next month
                              $month_add_2 = date("Y-m-d", strtotime("first day of +1 month", $start_date_2));
                              $month_add_last = date("d-m-Y", strtotime($month_add_2));
                              $month_add_last_c= date("d-m-Y", strtotime($month_add_last));

                              $date_1 = date("d", strtotime($start_date));
                              $date_2 = date("d", strtotime($month_add));

                              if($date_1 == $date_2){
                                echo 'ຄ່າໄຟຄັ້ງຕໍ່ໄປ: <span class="text-info small pt-1 fw-bold">';
                                echo $month_add_c;
                                echo '</span><br>';
                              } else {
                                echo 'ຄ່າໄຟຄັ້ງຕໍ່ໄປ: <span class="text-info small pt-1 fw-bold">';
                                echo  $month_add_last_c;
                                echo '</span><br>';
                              }

                            } 
                        } 

                        if($row['status'] == 2){
                          echo ' ອອກວັນທີ: <span class="text-muted small pt-1 fw-bold">';
                          echo $checkout_date_r;
                          echo '</span><br>';
                        }

                          ?>
                        </div> 
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div><!-- End single room Card -->

          <?php
            }
          ?>
                        
          </div>
        </div><!-- End columns -->
      
      </div>
    </section>

  <?php 

  include "footer.php"

  ?>