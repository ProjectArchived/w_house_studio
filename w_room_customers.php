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
                    <h5 class="card-title f-header">ຂໍ້ມູນລູກຄ້າ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_room_info.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກຫ້ອງພັກ</a>
                      <a href="w_customer_rental.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກຊຳລະຄ່າຫ້ອງ</a>
                      <a href="w_customer_electric.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກຊຳລະຄ່າທຳນຽມ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ລະຫັດ</th>
                      <th>ຫ້ອງເລກທີ</th>
                      <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                      <th>ເພດ</th>
                      <th>ສັນຊາດ</th>
                      <th>ເບີໂທ</th>
                      <th>ພາສປອດ</th>
                      <th>ອອກວັນທີ</th>
                      <th>ຮອດວັນທີ</th>
                      <th>ເລກທີໄຟຟ້າໃນມື້ເຂົ້າ</th> 
                      <th>ເລີ່ມສັນຍາວັນທີ</th>
                      <th>ສິ້ນສຸດສັນຍາວັນທີ</th>
                      <th>ສະຖານະ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($customers_detail)){?>
                    <tr>
                      <td><?php echo $row['id'];?></td>
                      <td><?php echo $row['room_no'];?></td>
                      <th scope="row"><?php 
                        echo $row['name'];
                      ?></th>
                      <td>
                      <?php 
                      
                      if($row['gender'] == 1) {
                        echo '<span class="badge bg-dark">ຊາຍ</span>';
                      } elseif ($row['gender'] == 2) {
                        echo '<span class="badge bg-info">ຍິງ</span>';
                      }        
                       
                      ?>   
                      </td>
                      <td><?php  
                      if(!empty($row['nationality'])){
                        $n_id = $row['nationality'];
                        $n_query = mysqli_query($db, "SELECT * FROM w_db_list_country WHERE id = $n_id");
                        $n_result = mysqli_fetch_array($n_query);
                        echo $n_result['national_la'];
                      }
                      ?></td>
                      <td><?php echo $row['phone_no']; ?></td>
                      <td><?php echo $row['id_no']; ?></td>
                      <td><?php  
                      
                      if($row['id_start_date'] > 0){
                        $isd = $row['id_start_date'];
                        $r_isd = date("d-m-Y", strtotime($isd));
                        echo $r_isd;
                      }

                      ?>
                    </td>
                      <td><?php 
                      
                      if($row['id_end_date'] > 0){
                        $ied = $row['id_end_date'];
                        $r_ied = date("d-m-Y", strtotime($ied));
                        echo $r_ied;
                      }
                      
                      ?></td>
                      <td><?php echo $row['e_unit']; ?></td>
                      <td><?php 
                      if(!empty($row['checkin_date'])){
                        $cd = $row['checkin_date'];
                        $r_cd = date("d-m-Y", strtotime($cd));
                        echo $r_cd;
                      }
                      ?></td>
                      <td><?php  
                      if(!empty($row['checkout_date'])){
                        $cod = $row['checkout_date'];
                        $r_cod = date("d-m-Y", strtotime($cod));
                        echo $r_cod;
                      }
                      ?></td>
                      <td><?php
                                         
                      if(empty($row['check_by'])) {
                        if($_SESSION['role'] == 8){
                          echo '<a href="hdl/customer.hdl.php?customer_check_id=';
                          echo $row['id'];
                          echo '&user_id=';
                          echo $_SESSION['userid'];
                          echo '" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-check-circle me-1"></i>ລໍຖ້າອະນູມັດ</a>';
                         } else {
                          echo '<span class="badge bg-danger">ລໍຖ້າອະນູມັດ</span>';
                        } 
                      } else {
                        echo '<span class="badge bg-success">ອະນຸມັດ</span>';
                      }         
                      ?></td>

                      <td><?php
                        if($_SESSION['role'] == 8){

                          echo '<a href="hdl/room.hdl.php?rental_del_id=';
                          echo $row['id'];
                          echo '" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()" ><i class="bi bi-x-lg"></i></a>';
                         } 
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

