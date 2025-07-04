<?php

include "header.php";
include "hdl/room.hdl.php";

?>

  <main id="main" class="main">
    <section class="section profile">
      <div class="row">
        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">   
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title f-header">ຫ້ອງ <?php echo $_GET['room_no'];?></h5>

                  <?php 
                  
                  if(!empty($_GET['customer_id'])){

                    $customer_id = $_GET['customer_id'];

                    $customer_view = mysqli_query($db, "SELECT * FROM 
                    (SELECT * FROM w_db_room_customer_info WHERE id = '$customer_id') as r1 LEFT JOIN (SELECT * FROM w_db_room_room_info WHERE id IN (SELECT MAX(id) FROM w_db_room_room_info WHERE customer_id = '$customer_id')) as r2 ON r1.id = r2.customer_id");  

                    $c_result = mysqli_fetch_array($customer_view);
                  
                  ?>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">ຊື່ ແລະ ນາມສະກຸນ</div>
                    <div class="col-lg-9 col-md-8"><?php echo $c_result['fname'].' '.$c_result['lname'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ສັນຊາດ</div>
                    <div class="col-lg-9 col-md-8"><?php 
                    
                    if(!empty($c_result['nationality'])){
                      $id = $c_result['nationality'];
                      $check = mysqli_query($db, "SELECT * FROM w_db_list_country WHERE id = '$id'");
                      $r_n = mysqli_fetch_array($check);
                      echo $r_n['national_la'];
                    }
                    
                    ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ເພດ</div>
                    <div class="col-lg-9 col-md-8"><?php 
                    
                    if($c_result['gender'] == 1){
                      echo 'ຊາຍ';
                    } else {
                      echo 'ຍິງ';
                    }

                    ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ພາສປອດ</div>
                    <div class="col-lg-9 col-md-8"><?php echo $c_result['id_no'];?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ອອກວັນທີ</div>
                    <div class="col-lg-9 col-md-8"><?php 
                    if($c_result['id_start_date'] > 0){
                    $pf_sd = $c_result['id_start_date'];
                    $pf_sd_c= date("d-m-Y", strtotime($pf_sd));
                    echo $pf_sd_c; 
                    } 
                    ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ຮອດວັນທີ</div>
                    <div class="col-lg-9 col-md-8"><?php
                    if($c_result['id_end_date'] > 0){
                    $pf_ed = $c_result['id_end_date'];
                    $pf_ed_c= date("d-m-Y", strtotime($pf_ed));
                    echo $pf_ed_c; 
                    }
                    ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ເບີໂທ</div>
                    <div class="col-lg-9 col-md-8"><?php echo $c_result['phone_no'];?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ເຂົ້າວັນທີ</div>
                    <div class="col-lg-9 col-md-8"><?php echo date("d-m-Y", strtotime($c_result['checkin_date']));?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ເລກທີໄຟຟ້າໃນມື້ເຂົ້າ</div>
                    <div class="col-lg-9 col-md-8"><?php 
                    if(!empty($c_result['e_unit'])){

                      echo number_format($c_result['e_unit']).' '.'('.date("d-m-Y", strtotime($c_result['e_date'])).')';

                    } else {

                      echo '<span class="badge bg-danger">ບໍ່ມີຂໍ້ມູນ</span>';
                      
                    }
                    ;?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ເງິນມັດຈຳ</div>
                    <div class="col-lg-9 col-md-8"><?php 

                      $customer_id = $_GET['customer_id'];
                      $v_deposit = mysqli_query($db, "SELECT * FROM w_db_room_deposit WHERE customer_id = '$customer_id' AND withdraw_by = ''");  
                      $d_result = mysqli_fetch_array($v_deposit);

                    if(!empty($d_result['currency'])){
                      $id = $d_result['currency'];
                      $d_check = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = '$id'");
                      $r_d = mysqli_fetch_array($d_check);

                      echo number_format($d_result['amount']).' '.$r_d['currency_la'].' '.'('.date("d-m-Y", strtotime($d_result['deposit_date'])).')';

                      if(!empty($d_result['remark'])){
                        echo $d_result['remark'];
                      }

                    } else {
                      echo '<span class="badge bg-danger">ບໍ່ມີຂໍ້ມູນ</span>';
                    }
                    ?></div>
                  </div>
                  
                  <?php 
                  }
                  ?>
                </div>
              </div><!-- End Bordered Tabs -->
            </div>
          </div>
        </div>

        <div class="col-xl-4">
          <div class="card">
            <div class="card-body">
              <div class="d-grid gap-2 mt-2">
              <h5 class="card-title"></h5>
              <?php if($_SESSION['role'] == 8) {?>
                <a href="hdl/room.hdl.php?checkout_id=<?php echo $_GET['customer_id'];?>&user_id=<?php echo $_SESSION['userid'];?>&room_no=<?php echo $_GET['room_no'];?>" class="btn btn-color" type="button" onclick="return confirm_action()">ສິ້ນສຸດສັນຍາ</a>

                <?php 
                  
                  if(!empty($_GET['customer_id'])){

                    $customer_id = $_GET['customer_id'];

                    $v_deposit = mysqli_query($db, "SELECT * FROM w_db_room_deposit WHERE customer_id = $customer_id AND withdraw_by = '' ");  
                    $result = mysqli_fetch_array($v_deposit);

                    if(empty($result)){

                      echo '<a href="w_room_deposit.php?room_no=';
                      echo $_GET['room_no'];
                      echo '&customer_id=';
                      echo $_GET['customer_id'];
                      echo '" class="btn bg-danger" type="button" >ເກັບເງິນມັດຈຳ</a>';
  
                    } else {
                      echo '<a href="hdl/room.hdl.php?withdraw_deposit_id=';
                      echo $result['id'];
                      echo '&customer_id=';
                      echo $_GET['customer_id'];
                      echo '&room_no=';
                      echo $_GET['room_no'];
                      echo '&user_id=';
                      echo $_SESSION['userid'];
                      echo '" class="btn btn-color" type="button" onclick="return confirm_action()">ຖອນເງິນມັດຈຳ</a>';
                    }
                  }
                  
                ?>

                <a href="w_room_rental.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-color" type="button">ບັນທຶກຄ່າເຊົ່າ</a>

                <?php 
                  
                  if(!empty($_GET['customer_id'])){

                    $customer_id = $_GET['customer_id'];

                    $check_electrict = mysqli_query($db, "SELECT * FROM w_db_room_room_info WHERE customer_id = $customer_id ");  
                    $result = mysqli_fetch_array($check_electrict);

                    if(empty($result['e_unit'])){

                      echo '<a href="w_utility_electrict_init.php?room_no=';
                      echo $_GET['room_no'];
                      echo '&customer_id=';
                      echo $_GET['customer_id'];
                      echo '" class="btn bg-danger" type="button" >ບັນທຶກໄຟຟ້າມື້ເຂົ້າ</a>';
  
                    } else {
                      
                      echo '<a href="w_room_electric.php?room_no=';
                      echo $_GET['room_no'];
                      echo '&user_id=';
                      echo $_SESSION['userid'];
                      echo '&customer_id=';
                      echo $_GET['customer_id'];
                      echo '" class="btn btn-color" type="button">ບັນທຶກໄຟຟ້າ</a>';

                    }
                  }
                  
                ?>
                <?php }?>
                
                <a href="w_room_checkin.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-color" type="button">ປ່ຽນຂໍ້ມູນລູກຄ້າ</a>

                <a href="w_room_switch.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-color">ບັນທຶກການຍ້າຍຫ້ອງ</a>

                <a href="w_room_note.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-color" type="button">ເພີ່ມຂໍ້ຄວາມ</a>

                <a href="w_room_item_return.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-color" type="button">ສົ່ງເຄື່ອງຄືນ</a>

                <a href="w_room_item_req.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-color" type="button">ຂໍເບີກເຄື່ອງ</a>
                <a href="w_room_main.php" class="btn btn-color">ກັບຄືນ</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php if($_SESSION['role'] == 8 ){?>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between p-1">
                <h5 class="card-title f-header">ຂໍ້ມູນຄ່າເຊົ່າ</h5>
              </div>       
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ສັນຍາເລກທີ</th>
                      <th scope="col">ເລີ່ມວັນທີ</th>
                      <th scope="col">ຮອດວັນທີ</th>
                      <th scope="col">ຈຳນວນເງິນ</th>
                      <th scope="col">ໝາຍເຫດ</th>
                      <th scope="col">ວັນທີຊຳລະ</th> 
                      <th scope="col">#</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      
                      $customer_id =  $_GET['customer_id'];
                      $customer_check = mysqli_query($db, "SELECT * FROM w_db_room_rental WHERE customer_id = '$customer_id' ORDER BY id DESC");
                      while($row=mysqli_fetch_array($customer_check)){

                    ?>
                    <tr>
                      <td><?php echo $row['contract_no'];?></td>
                      <td><?php 
                      $rr_f = $row['start_date'];
                      $rr_f_c= date("d-m-Y", strtotime($rr_f));
                      echo $rr_f_c; 
                      ?></td>
                      <td><?php 
                      $rr_t = $row['end_date'];
                      $rr_t_c= date("d-m-Y", strtotime($rr_t));
                      echo $rr_t_c; 
                      ?></td>
                      <td><?php 
                      
                      if(!empty($row['currency'])){

                        $id = $row['currency'];
                        $c_check = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = '$id'");
                        $r_c = mysqli_fetch_array($c_check);
                        echo number_format($row['paid_amount']).' '.$r_c['currency_la'];
                      } 

                        ?>
                      </td>  
                      <td><?php echo $row['remark'];?></td>
                      <td>
                        <?php 
                          if(!empty($row['create_by'])){
                            $id_cd = $row['create_date'];
                            $r_cd = date("d-m-Y", strtotime($id_cd));
                            echo $r_cd;
                          } 
                        ?>
                      </td>

                      <td>
                        <?php if($_SESSION['role'] == 8) {?>
                        <a href="hdl/room.hdl.php?r_rental_del_id=<?php echo $row['id'];?>&room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-x-lg"></i></a>
                        <?php }?>
                      </td>
                    </tr>
                    <?php 
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between p-1">
                <h5 class="card-title f-header">ຂໍ້ມູນຄ່າໄຟຟ້າ</h5>
              </div>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ເລກທີ</th>
                      <th scope="col">ເລີ່ມວັນທີ</th>
                      <th scope="col">ຮອດວັນທີ</th>
                      <th scope="col">ເລກທີ່ຄັງນີ້</th>
                      <th scope="col">ພະລັງງານທີ່ໃຊ້</th>
                      <th scope="col">ຈຳນວນເງິນ</th>
                      <th scope="col">ໝາຍເຫດ</th>
                      <th scope="col">ວັນທີຊຳລະ</th>
                      <th scope="col">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 

                      $electric_id =  $_GET['customer_id'];
                      $electric_check = mysqli_query($db, "SELECT * FROM w_db_room_electric WHERE customer_id = '$electric_id' ORDER BY id DESC");
                      while($row=mysqli_fetch_array($electric_check)){

                    ?>
                    <tr>
                      <td><?php echo $row['ref_no'];?></td>
                      <td><?php 
                            if(!empty($row['start_date'])){
                            $er_f = $row['start_date'];
                            $er_f_c= date("d-m-Y", strtotime($er_f));
                            echo $er_f_c; 
                            }
                      ?></td>
                      <td><?php 
                          if(!empty($row['end_date'])){
                            $er_t = $row['end_date'];
                            $er_t_c= date("d-m-Y", strtotime($er_t));
                            echo $er_t_c; 
                          }
                      ?></td>
                      <td><?php echo $row['actual_unit'];?></td>
                      <td><?php echo $row['unit_used'];?></td>
                      <td><?php 

                        if(!empty($row['currency'])){

                          $id = $row['currency'];
                          $e_check = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = '$id'");
                          $r_ec = mysqli_fetch_array($e_check);
                          echo number_format($row['actual_amount']).' '.$r_ec['currency_la'];
                        } 
                        
                        ?></td>
                      <td><?php 
                          echo $row['remark'];
                      ?></td>
                      <td>
                        <?php 

                         if(empty($row['paid_receive_by'])){
                          echo '<a href="hdl/room.hdl.php?a_electric_id=';
                          echo $row['id'];
                          echo '&room_no=';
                          echo $_GET['room_no'];
                          echo '&customer_id=';
                          echo $_GET['customer_id'];
                          echo '&user_id=';
                          echo $_SESSION['userid'];
                          echo '" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-check-circle me-1"></i>ລໍຖ້າຊຳລະ</a>';
                        } else {
                          $er_tt = $row['paid_receive_date'];
                          $er_tt_c= date("d-m-Y", strtotime($er_tt));
                          echo $er_tt_c;
                        } 

                        ?>
                      </td>
                      <td>
                      <?php if($_SESSION['role'] == 8) {

                        ?>
                      <a href="hdl/room.hdl.php?r_electric_del_id=<?php echo $row['id'];?>&room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-x-lg"></i></a>
                      <?php }?>
                      </td>
                    </tr>
                    <?php 
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>
<?php }?>
    <section class="section">
      <div class="row">       
        <div class="col-lg-12">       
          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ຂໍ້ຄວາມ</h5>

              <!-- List group with Advanced Contents -->

              <?php 

              $note_id =  $_GET['customer_id'];
              $note_check = mysqli_query($db, "SELECT * FROM w_db_room_note WHERE customer_id = '$note_id'");
              while($row=mysqli_fetch_array($note_check)){

              ?>

              <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <p><?php echo $row['notes'];?></p>
                <hr>
                <small class="mb-0 text-muted"><?php echo $row['create_date'];?></small>

                <a href="hdl/room.hdl.php?note_del_id=<?php echo $row['id'];?>&room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" type="button" class="btn-close"  onclick="return confirm_action()"></a>

              </div>

              <?php 
                }
              ?>  
              </div><!-- End List group Advanced Content -->
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ຈຳນວນເຄື່ອງໃນຫ້ອງ</h5>

              <!-- Default Table -->
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ລາຍລະອຽດຂອງເຄື່ອງ</th>
                      <th>ພື້ນຖານ</th>
                      <th>ເຄື່ອງສົ່ງຄືນ</th>
                      <th>ເຄື່ອງຂໍເບີກ</th>
                      <th>ເຄື່ອງໃນຫ້ອງພັກ</th>
                      <th>ສະຖານະ</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 

                    $room_no =  $_GET['room_no'];
                    $customer_id =  $_GET['customer_id'];
                    $room_check = mysqli_query($db, "SELECT  r1.id as item_id, r1.s_unit as base_unit, ifnull(r5.total,0) as return_unit, ifnull(r6.total,0) as request_unit, (ifnull(r2.unit,0) + ifnull(r3.total,0)) - ifnull(r4.total,0) as remain_unit FROM(SELECT * FROM w_db_list_item WHERE room_use = 1) as r1 LEFT JOIN (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = $room_no AND cat_id = 1) as r2 ON r1.id = r2.item_id LEFT JOIN (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = $room_no AND cat_id = 2 GROUP BY item_id) as r3 ON r1.id = r3.item_id LEFT JOIN (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = $room_no AND cat_id = 3 GROUP BY item_id) as r4 ON r1.id = r4.item_id LEFT JOIN (SELECT cat_id, customer_id, item_id, SUM(unit) as total FROM w_db_stock WHERE room_no =  $room_no AND cat_id = 2 AND customer_id = $customer_id GROUP BY item_id) AS r5 ON r1.id = r5.item_id LEFT JOIN (SELECT cat_id, customer_id, item_id, SUM(unit) as total FROM w_db_stock WHERE room_no =  $room_no AND cat_id = 3 AND customer_id = $customer_id GROUP BY item_id) AS r6 ON r1.id = r6.item_id ORDER BY r1.location_id ASC, r1.cat_id ASC");
                    while($row=mysqli_fetch_array($room_check)){

                    ?>
                    <tr>
                      <td>
                      <?php 
                        if(!empty($row['item_id'])){
                          $id = $row['item_id'];
                          $item_check = mysqli_query($db, "SELECT * FROM w_db_list_item WHERE id = '$id'");
                          $row_i=mysqli_fetch_array($item_check);
                          echo $row_i['item_la'];
                        }
                      ?>  
                      </td>
                      <td><?php echo $row['base_unit'];?></td>
                      <td><?php 
                        if(!empty($row['return_unit'])){
                          echo '<span class="text-danger">';
                          echo $row['return_unit'];
                          echo '</span>';
                        }
                      ?></td>
                      <td><?php 
                        if(!empty($row['request_unit'])){
                          echo '<span class="text-success">';
                          echo $row['request_unit'];
                          echo '</span>';
                        }
                      ?></td>
                      <td><?php echo $row['remain_unit'];?></td>
                      <td><?php 
                        if($row['base_unit'] - $row['remain_unit'] == 0){
                          echo '<span class="badge bg-success"> ເຄື່ອງຄົບ </span>';
                        } elseif ($row['base_unit'] > $row['remain_unit']) {
                          echo '<span class="badge bg-danger"> ເພີ່ມເຄື່ອງ </span>';
                        } else {
                          echo '<span class="badge bg-danger"> ເຄື່ອງເກີນ </span>';
                        }
                      ?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- End Default Table Example -->
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍການເຄື່ອນໄຫວຂອງເຄື່ອງໃນຫ້ອງພັກ</h5>
              <!-- Default Table -->
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ວັນທີບັນທຶກ</th>
                      <th scope="col">ລາຍລະອຽດຂອງເຄື່ອງ</th>
                      <th>ປະເພດ</th>
                      <th>ຫ້ອງເລກທີ</th>
                      <th>ຈຳນວນ</th>
                      <th>ສະຖານະ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 

                      $customer_id =  $_GET['customer_id'];
                      $customer_check = mysqli_query($db, "SELECT * FROM w_db_stock WHERE customer_id = '$customer_id' ORDER BY id ASC");
                      while($row=mysqli_fetch_array($customer_check)){

                    ?>
                    <tr>
                      <td><?php echo $row['create_date'];?></td>
                      <td><?php 
                        if(!empty($row['item_id'])){
                          $id = $row['item_id'];
                          $item_check = mysqli_query($db, "SELECT * FROM w_db_list_item WHERE id = '$id'");
                          $row_i=mysqli_fetch_array($item_check);
                          echo $row_i['item_la'];
                        }
                      ?></td>
                      <td><?php 
                        if($row['cat_id'] == 2){
                          echo '<span class="badge bg-danger"> ສົ່ງເຄື່ອງຄືນ </span>';
                        } else {
                          echo '<span class="badge bg-success"> ຂໍເບີກເຄື່ອງ </span>';
                        }
                      ?></td>
                      <td><?php echo $row['room_no'];?></td>
                      <td><?php echo $row['unit'];?></td>
                      <td><?php 
                        if(!empty($row['check_by'])){
                          echo '<span class="badge bg-success"> ອະນຸມັດ </span>';
                        } else {
                          echo '<span class="badge bg-danger"> ລໍຖ້າການອະນຸມັດ </span>';
                        }
                      
                      ?></td>
                    </tr>
                    <?php 
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- End Default Table Example -->
            </div>
          </div>
        </div>
      </div>
    </section>

    
<?php

include "footer.php";

?>