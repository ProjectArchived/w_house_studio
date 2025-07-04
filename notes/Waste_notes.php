<?php

// -------- -------- Stock Summary -------- --------

SELECT i1.id, i1.cat_id, i1.item_en, i1.item_la, i2.p_u, i3.r_u, i4.add_u, i5.d_u FROM
// Step 1 Item id and Item cat
(SELECT * FROM w_db_list_item) as i1 LEFT JOIN
// Step 2 Item Available
(SELECT item_id, sum(unit) as p_u FROM w_stock WHERE cat_id = 1) as i2 ON i1.id = i2.item_id LEFT JOIN
// Step 3 Item Return
(SELECT item_id, sum(unit) as r_u FROM w_stock WHERE cat_id = 2) as i3 ON i1.id = i3.item_id LEFT JOIN 
// Step 3 Item Add to Room
(SELECT item_id, sum(unit) as add_u FROM w_stock WHERE cat_id = 5) as i4 ON i1.id = i4.item_id LEFT JOIN 
// Step 4 Item Dispose
(SELECT item_id, sum(unit) as d_u FROM w_stock WHERE cat_id = 4) as i5 ON i1.id = i5.item_id LEFT JOIN 


SELECT i1.id as id, i1.cat_id, i1.item_en as item_e, i1.item_la as item_l, ifnull(i2.p_u, 0) as u_purchase, ifnull(i3.r_u, 0) as u_return , ifnull(i4.add_u, 0) as u_add , ifnull(i5.d_u, 0) as u_dispose, (ifnull(i2.p_u, 0) + ifnull(i3.r_u, 0)) - (ifnull(i4.add_u, 0) + ifnull(i5.d_u, 0)) as total FROM (SELECT * FROM w_db_list_item) as i1 LEFT JOIN (SELECT item_id, sum(unit) as p_u FROM w_stock WHERE cat_id = 1 GROUP BY item_id) as i2 ON i1.id = i2.item_id LEFT JOIN (SELECT item_id, sum(unit) as r_u FROM w_stock WHERE cat_id = 2 GROUP BY item_id) as i3 ON i1.id = i3.item_id LEFT JOIN (SELECT item_id, sum(unit) as add_u FROM w_stock WHERE cat_id = 5 GROUP BY item_id) as i4 ON i1.id = i4.item_id LEFT JOIN (SELECT item_id, sum(unit) as d_u FROM w_stock WHERE cat_id = 4 GROUP BY item_id) as i5 ON i1.id = i5.item_id

chrome found the password you just used in a data breach. to secure your accounts, we recomment checking your saved password

ບໍ່ວ່າງ
ກຳລັງອະນາໄມ
ວ່າງ

ເລີ່ມວັນທີ
ຮອດວັນທີ
ຄ່າໄຟຄັ້ງລ້າສຸດ
ອອກວັນທີ

$currency_exchange_view = mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
$result = mysqli_fetch_array($currency_exchange_view);


SELECT i_main.id as id, i_main.cat_id, i_main.item_en as item_en, i_main.item_la as item_la, ifnull(i101_ad.unit, 0) - ifnull(i101_re.unit, 0) as t_101, ifnull(i102_ad.unit, 0) - ifnull(i102_re.unit, 0) as t_102, ifnull(i103_ad.unit, 0) - ifnull(i103_re.unit, 0) as t_103, ifnull(i104_ad.unit, 0) - ifnull(i104_re.unit, 0) as t_104, ifnull(i105_ad.unit, 0) - ifnull(i105_re.unit, 0) as t_105, ifnull(i106_ad.unit, 0) - ifnull(i106_re.unit, 0) as t_106, ifnull(i201_ad.unit, 0) - ifnull(i201_re.unit, 0) as t_201, ifnull(i202_ad.unit, 0) - ifnull(i202_re.unit, 0) as t_202, ifnull(i203_ad.unit, 0) - ifnull(i203_re.unit, 0) as t_203, ifnull(i204_ad.unit, 0) - ifnull(i204_re.unit, 0) as t_204, ifnull(i205_ad.unit, 0) - ifnull(i205_re.unit, 0) as t_205, ifnull(i206_ad.unit, 0) - ifnull(i206_re.unit, 0) as t_206 FROM 
(SELECT * FROM w_db_list_item WHERE room_use = 1) as i_main LEFT JOIN 
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 101) as i101_ad ON i_main.id = i101_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 101) as i101_re ON i_main.id = i101_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 102) as i102_ad ON i_main.id = i102_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 102) as i102_re ON i_main.id = i102_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 103) as i103_ad ON i_main.id = i103_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 103) as i103_re ON i_main.id = i103_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 104) as i104_ad ON i_main.id = i104_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 104) as i104_re ON i_main.id = i104_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 105) as i105_ad ON i_main.id = i105_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 105) as i105_re ON i_main.id = i105_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 106) as i106_ad ON i_main.id = i106_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 106) as i106_re ON i_main.id = i106_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 201) as i201_ad ON i_main.id = i201_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 201) as i201_re ON i_main.id = i201_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 202) as i202_ad ON i_main.id = i202_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 202) as i202_re ON i_main.id = i202_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 203) as i203_ad ON i_main.id = i203_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 203) as i203_re ON i_main.id = i203_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 204) as i204_ad ON i_main.id = i204_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 204) as i204_re ON i_main.id = i204_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 205) as i205_ad ON i_main.id = i205_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 205) as i205_re ON i_main.id = i205_re.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 5 AND room_no = 206) as i206_ad ON i_main.id = i206_ad.item_id LEFT JOIN
(SELECT item_id, unit FROM w_stock WHERE cat_id = 2 AND room_no = 206) as i206_re ON i_main.id = i206_re.item_id


if($_SESSION['role'] == 8) {
    if(empty($row['check_by'])){
    echo '<a href="hdl/room.hdl.php?clean_check_id=';
    echo $row['id'];
    echo '&user_id=';
    echo $_SESSION['userid'];
    echo '" class="table_tbn badge bg-success text-light" onclick="return confirm_action()"><i class="bi bi-check-circle me-1"></i>ຮັບຮອງ</a>';
  }  ?>

  </td><td>

  <a href="hdl/room.hdl.php?clean_del_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light" onclick="return confirm_action()"><i class="bi bi-pencil-fill me-1"></i>ແກ້ໄຂ</a>

  </td><td>
  
  <a href="hdl/room.hdl.php?clean_del_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-x-lg me-1"></i>ລົບຂໍ້ມູນ</a>


SELECT * FROM (SELECT * FROM wutb_l_menu) as r1 LEFT JOIN (SELECT menu_id, cat_id, unit_price, create_date FROM wutb_l_menu_price WHERE id IN (SELECT MAX(id) FROM wutb_l_menu_price WHERE cat_id = 1 GROUP BY menu_id) ORDER BY menu_id ASC) as r2 ON r1.id = r2.menu_id ORDER by id ASC

---------------------------------------------------------------

$id =  $_GET['customer_id'];
$query = mysqli_query($db, "SELECT * FROM w_db_room_electric WHERE id IN (SELECT MAX(id) FROM w_db_room_electric WHERE customer_id = $id)");

if(!empty($query)){
  $result = mysqli_fetch_array($query);
  $date = $result['end_date']; 
  $newDate = date("Y-m-d", strtotime($date)); 
  echo '<input type="date" class="form-control" name="e_sd" value="';
  echo $newDate; 
  echo '">';
} else {
  $check_date = mysqli_query($db, "SELECT* FROM w_db_room_rental WHERE customer_id=$id");
  $result = mysqli_fetch_array($check_date);
  $date = $result['start_date'];
  $newDate = date("Y-m-d", strtotime($date)); 
  
  echo '<input type="date" class="form-control" name="e_sd" value="';
  echo $newDate; 
  echo '" required>';
}

--------------------------------------------------------
<!-- Select with Max ID -->

$id =  $_GET['customer_id'];
$query = mysqli_query($db, "SELECT * FROM w_db_room_electric WHERE id IN (SELECT MAX(id) FROM w_db_room_electric WHERE customer_id = $id)");
$result = mysqli_fetch_array($query);
$date = $result['end_date']; 
$newDate = date("Y-m-d", strtotime($date)); 
?>
<input type="date" class="form-control" name="e_sd" value="<?php echo $newDate; ?>" required>

--------------------------------------------------------
<!-- Reception -->

<!-- -------- --------     -------- --------- -->
            <!-- -------- --------     -------- --------- -->
            <!-- -------- -------- 101 -------- --------- -->
            <!-- -------- --------     -------- --------- -->
            <!-- -------- --------     -------- --------- -->

            <!-- single room Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">

              <?php 
              // Active / Passive link
              // ----- ----- ----- -----
               if($s_101['status'] == 1){
              // ----- ----- ----- -----
                if(!empty($room_101)){

                  if(empty($room_101['checkout_by']) && empty($room_101['record_by'])){

                    echo '<a href="w_room_detail.php?room_no=102&customer_id=';
                    echo $room_102['id'];
                    echo '">';

                  } elseif (!empty($room_101['checkout_by']) && empty($room_101['record_by'])){

                    if($_SESSION['role'] == 8) {

                    echo '<a href="w_room_clean.php?room_no=102&customer_id=';
                    echo $room_101['id'];
                    echo '">';

                    }

                  } 
                } else {

                  if($_SESSION['role'] == 8) {

                  echo '<a href="w_room_checkin.php?room_no=102">';
                  }
                }
              }  
              ?>
                
                  <div class="card-body">
                    <h5 class="card-title fw-bold">101 | 
                      
                    <?php
                  // Room Status
                  // ----- ----- ----- -----
                  if($s_101['status'] == 1){
                    // ----- ----- ----- -----
                  if(!empty($room_101)){
                                    
                    if(empty($room_101['checkout_by']) && empty($room_101['record_by'])){

                      echo '<div class="spinner-grow text-danger spinner-size" role="status">
                      <span class="visually-hidden">Loading...</span>
                      </div> <span class="text-danger fw-bold">ບໍ່ວ່າງ</span></h5>';

                    } elseif (!empty($room_101['checkout_by']) && empty($room_101['record_by'])){

                      echo '<div class="spinner-grow text-warning spinner-size" role="status"> 
                      <span class="visually-hidden">Loading...</span> 
                      </div> <span class="text-warning fw-bold">ກຳລັງອະນາໄມ</span>';

                    }
                  } else {

                      echo '<div class="spinner-grow text-success spinner-size" role="status"> 
                      <span class="visually-hidden">Loading...</span> 
                      </div> <span class="text-success fw-bold">ວ່າງ</span>';

                  }
                  // ----- ----- ----- -----
                  } else {
                    echo '<div class="spinner-grow text-danger spinner-size" role="status">
                      <span class="visually-hidden">Loading...</span>
                      </div> <span class="text-danger fw-bold">ບໍ່ວ່າງ</span></h5>';
                  }
                  // ----- ----- ----- -----
                    ?>

                    <div class="d-flex align-items-center">
                      <div class="ps-3">
                        <h6><?php 
                        // Name
                        // ----- ----- ----- -----
                       if($s_101['status'] == 1){ 
                        // ----- ----- ----- -----
                        if(!empty($room_101)){
                          if(empty($room_101['checkout_by'])){
                            echo $room_101['fname'].' '.$room_101['lname'];
                            }
                        }
                        // ----- ----- ----- -----
                       } else {
                            echo $s_101['remark'];
                       }
                       // ----- ----- ----- -----
                        ?>

                        </h6>
                        <div>
                          <?php 
                            if(!empty($room_101)){

                              if(empty($room_101['checkout_by'])){
                                                                                
                              $customer_id = $room_101['id'];
  
                              $room_check = mysqli_query($db, "SELECT customer_id, min(start_date) as s_d, max(end_date) as e_d FROM w_db_room_rental WHERE customer_id = '$customer_id'");
                              $room_r = mysqli_fetch_array($room_check);
  
                              $r_sd = $room_r['s_d'];
                              $r_sd_c= date("d-m-Y", strtotime($r_sd));
  
                              echo ' ເລີ່ມວັນທີ: <span class="text-muted small pt-1 fw-bold">';
                              echo $r_sd_c;
                              echo '</span><br>';
  
                              if($room_r['e_d'] >= $_SESSION['date']){
                                $r_ed = $room_r['e_d'];
                                $r_ed_c= date("d-m-Y", strtotime($r_ed));
                                echo ' ຮອດວັນທີ: <span class="text-muted small pt-1 fw-bold">';
                                echo $r_ed_c;
                                echo '</span><br>';
                              } else {
                                $r_ed = $room_r['e_d'];
                                $r_ed_c= date("d-m-Y", strtotime($r_ed));
                                echo ' ຮອດວັນທີ: <span class="text-danger small pt-1 fw-bold">';
                                echo $r_ed_c;
                                echo '</span><br>';
                              }
  
                               //  Electrict
  
                              $room_check = mysqli_query($db, "SELECT * FROM w_db_room_electric WHERE id = (SELECT max(id) FROM w_db_room_electric WHERE customer_id = '$customer_id')");
                              $room_r = mysqli_fetch_array($room_check);
                              if(!empty($room_r)){
                                
                              $r_lb = $room_r['end_date'];
                              $r_lb_c= date("d-m-Y", strtotime($r_lb));
  
                              if(!empty($room_r['paid_receive_by'])){
                              
                                    echo 'ຄ່າໄຟຄັ້ງລ້າສຸດ: <span class="text-muted small pt-1 fw-bold">';
                                    echo  $r_lb_c;
                                    echo '</span><br>';
                                  
                                  } else {
  
                                    echo ' ຄ່າໄຟຄັ້ງລ້າສຸດ: <span class="text-danger small pt-1 fw-bold">';
                                    echo  $r_lb_c;
                                    echo '</span><br>';
  
                                  }
                                }
                              
                            } elseif (!empty($room_101['checkout_by']) && empty($room_101['record_by'])){
                              $r_co = $room_102['checkout_date'];
                              $r_co_c= date("d-m-Y", strtotime($r_co));
                              echo ' ອອກວັນທີ: <span class="text-muted small pt-1 fw-bold">';
                              echo  $r_co_c;
                              echo '</span><br>';
                             }
                          } 
                          ?>
                        </div> 
                      </div>
                    </div>
                  </div>
                  <?php 
                  
                  ?>
                </a>
              </div>
            </div><!-- End single room Card -->
            <!-- -------- End 101 --------- -->



<!-- Electric Part -->

//  Electrict

$room_check = mysqli_query($db, "SELECT * FROM w_db_room_electric WHERE id = (SELECT max(id) FROM w_db_room_electric WHERE customer_id = '$customer_id')"-);
$room_r = mysqli_fetch_array($room_check);
if(!empty($room_r)){

$r_lb = $room_r['end_date'];
$r_lb_c= date("d-m-Y", strtotime($r_lb));
$next_payment = $room_r['next_payment'];
$r_np= date("d-m-Y", strtotime($next_payment));

// Check status if already paid once


if(!empty($room_r['paid_receive_by'])){
  // if paid, date in gray
  echo 'ຄ່າໄຟຄັ້ງລ້າສຸດ: <span class="text-muted small pt-1 fw-bold">';
  echo  $r_lb_c;
  echo '</span><br>';
  // notify next payment
  echo 'ຄ່າໄຟຄັ້ງຕໍ່ໄປ: <span class="text-info small pt-1 fw-bold">';
  echo  $r_np;
  echo '</span><br>';

} else {
  // if not paid, date in red
  echo ' ຄ່າໄຟຄັ້ງລ້າສຸດ: <span class="text-danger small pt-1 fw-bold">';
  echo  $r_lb_c;
  echo '</span><br>';
  // notify next payment
  echo 'ຄ່າໄຟຄັ້ງຕໍ່ໄປ: <span class="text-info small pt-1 fw-bold">';
  echo  $r_np;
  echo '</span><br>';
}
} else {

// Check status if new customer (never paid electric)

$room_check = mysqli_query($db, "SELECT customer_id, min(start_date) as s_d, max(end_date) as e_d FROM w_db_room_rental WHERE customer_id = '$customer_id'");
$room_r = mysqli_fetch_array($room_check);

$end_date = $room_r['s_d'];
$end_date_2 = strtotime($end_date);

// Add 1 Month to date
$month_add = date("Y-m-d", strtotime("+1 month", $end_date_2));
$month_add_c= date("d-m-Y", strtotime($month_add));


// Select Last date of next month
$month_add_2 = date("Y-m-d", strtotime("first day of +1 month", $end_date_2));
$month_add_last = date("Y-m-t", strtotime($month_add_2));
$month_add_last_c= date("d-m-Y", strtotime($month_add_last));

$date_1 = date("d", strtotime($end_date));
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
ສະຫຼຸບການເຄື່ອນໄຫວ
ການເຄື່ອນໄຫວປະຈຳວັນທີ 


onizu
ຫ້ອງພັກ
ຮ້ານເຂົ້າໜົມ
ການບໍລິຫານຈັດການ
ສະຫຼຸບສະຖານະທຸລະກິດ
ສະຫຼຸບສະຖານະຮ້ານ
ຕັ້ງຄ່າລາຍການ
ຂໍ້ມູນຂອງຜູ້ໃຊ້ລະບົບ



Status Occupy
0 0 Available and Clean
2 0 Available and Cleaning
1 1 



onizu
ຫ້ອງພັກ
ຮ້ານເຂົ້າໜົມ
ການບໍລິຫານຈັດການ
ຕັ້ງຄ່າລາຍການ
ຂໍ້ມູນຂອງຜູ້ໃຊ້ລະບົບ


2022-12-10	2023-04-30
2022-12-10	2022-12-31	2023-01-10	123	23	23000	1	23000			Option 1-2
-2022-12-31	2023-01-07	2023-02-10	222	111	111000	1	111000			Option 1-3
-2023-01-07	2023-02-10	2023-03-10	222	0	0	1	0			Option 1-4
-2023-02-10	2023-03-20	2023-04-10	333	111	111000	1	111000			Option 1-4
-2023-03-20	2023-04-30	2023-05-10	444	111	111000	1	111000			Option 1-4
2022-12-10	2023-01-10	2023-02-10	123	23	23000	1	23000			Option 1-1
-2023-01-10	2023-02-01	2023-03-10	222	111	111000	1	111000			Option 1-4
-2023-02-01	2023-03-20	2023-04-10	333	111	111000	1	111000			Option 1-4
-2023-03-20	2023-04-30	2023-05-10	555	222	222000	1	222000			Option 1-4
2022-12-10	2023-01-20	2023-02-10	123	23	23000	1	23000			Option 1-1
-2023-01-20	2023-02-07	2023-03-10	222	99	99000	1	99000			Option 1-4
-2023-02-07	2023-03-10	2023-04-10	333	111	111000	1	111000			Option 1-4
-2023-03-10	2023-04-20	2023-05-10	444	111	111000	1	111000			Option 1-4
-2023-04-20	2023-05-31	2023-07-10	555	111	111000	1	111000			Option 1-4
2022-12-10	2023-01-31	2023-03-10	203	103	103000	1	103000			Option 1-2
-2023-01-31	2023-02-15	2023-03-10	210	7	7000	1	7000			Option 1-4
-2023-02-15	2023-03-05	2023-04-10	220	10	10000	1	10000			Option 1-4
-2023-03-05	2023-04-10	2023-05-10	222	2	2000	1	2000			Option 1-4
-2023-04-10	2023-05-15	2023-06-10	223	1	1000	1	1000			Option 1-4
-2023-05-15	2023-06-25	2023-07-10	225	2	2000	1	2000			Option 1-4
-2023-06-25	2023-07-24	2023-08-10	266	41	41000	1	41000			Option 1-4
-2023-07-24	2023-08-10	2023-09-10	566	300	300000	1	300000			Option 1-4

2022-12-31	2023-04-30
2022-12-31	2023-01-01	2023-02-28	111	11	11000	1	11000			Option 2-1
-2023-01-01	2023-01-15	2023-02-28	222	111	111000	1	111000			Option 2-3
-2023-01-15	2023-01-31	2023-03-31	333	111	111000	1	111000			Option 1-4
-2023-01-31	2023-02-28	2023-03-31	444	111	111000	1	111000			Option 1-4
2022-12-31	2023-01-15	2023-02-28	111	11	11000	1	11000			Option 2-1
-2023-01-15	2023-02-28	2023-03-31	222	111	111000	1	111000			Option 1-4
-2023-02-28	2023-03-31	2023-05-31	333	111	111000	1	111000			Option 1-4
-2023-03-31	2023-04-30	2023-05-31	333	0	0	1	0			Option 1-4
2022-12-31	2023-01-31	2023-03-31	111	11	11000	1	11000			Option 1-2
-2023-01-31	2023-02-28	2023-03-31	222	111	111000	1	111000			Option 1-4
-2023-02-28	2023-03-31	2023-05-31	333	111	111000	1	111000			Option 1-4
-2023-03-31	2023-04-17	2023-05-31	444	111	111000	1	111000			Option 1-4


W Project
onizu
ຫ້ອງພັກ
ສະຖານະຫ້ອງພັກໂດຍລວມ
ສະຖານະຫ້ອງພັກທີ່ວ່າງ
ສະຫຼຸບເຄື່ອງໃນສາງ
ສະຫຼຸບຄ່າບໍລິການ
ຂໍ້ມູນຂອງລູກຄ້າ
ຮ້ານເຂົ້າໜົມ
ການບໍລິຫານຈັດການ
ຕັ້ງຄ່າລາຍການ
ຂໍ້ມູນຂອງຜູ້ໃຊ້ລະບົບ

Fatal error: Uncaught mysqli_sql_exception: Unknown column 'room_no' in 'where clause' in C:\xampp\phpMyAdmin\htdocs\w_coding\w_project\w_sth_8\w_studio_house\hdl\stock.hdl.php:26 Stack trace: #0 C:\xampp\phpMyAdmin\htdocs\w_coding\w_project\w_sth_8\w_studio_house\hdl\stock.hdl.php(26): mysqli_query(Object(mysqli), 'SELECT i_main.i...') #1 C:\xampp\phpMyAdmin\htdocs\w_coding\w_project\w_sth_8\w_studio_house\w_stock_main.php(4): include('C:\\xampp\\phpMyA...') #2 {main} thrown in C:\xampp\phpMyAdmin\htdocs\w_coding\w_project\w_sth_8\w_studio_house\hdl\stock.hdl.php on line 26