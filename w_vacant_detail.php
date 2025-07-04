<?php

include "header.php";
include "hdl/room.hdl.php";
?> 

  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

            <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-5">
                    <h5 class="card-title f-header">ການເຄື່ອນໄຫວປະຈຳວັນທີ 
                      <?php 
                        $date = $_GET['date'];
                        $date_f = date("d-m-Y", strtotime($date));
                        echo $date_f; 
                      ?>
                    </h5>
                  </div>

                  <div class="col-md-7">
                    <div class="row justify-content-md-end">
                      <?php 
                      $date = $_GET['date'];
                      $check_date = mysqli_query($db, "SELECT * FROM w_db_room_clean WHERE DATE (clean_date) = '$date' AND check_by =''");

                      if(!empty(mysqli_fetch_array($check_date)) && $_SESSION['role'] == 8) {

                          echo '<a href="hdl/room.hdl.php?approve_all_rec=';
                          echo $_GET['date'];
                          echo '&user_id=';
                          echo $_SESSION['userid'];
                          echo '" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3" onclick="return confirm_action()">ກວດທັງໝົດ</a>';
                      }

                      ?>
                      <a href="w_vacant_main.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive-xl">
                <table class="table datatable table-hover table-striped" >
                  <thead>
                    <tr>
                      <th>ຫ້ອງ</th>
                      <th>ປະເພດ</th>
                      <th>ບັນຫາ</th>
                      <th>ວັນທີບັນທຶກ</th>
                      <th>ສະຖານະ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                   $date = $_GET['date'];
                   $check_rec = mysqli_query($db, "SELECT * FROM w_db_room_clean WHERE clean_date = '$date' ORDER BY check_by = '' DESC");
                    while($row=mysqli_fetch_assoc($check_rec)){
                  ?>
                    <tr>
                      <td><?php echo $row['room_no'];?></td>
                      <td><?php 
                        if($row['type'] == 1){
                          echo '<span class="badge bg-dark">ກ່ອນປ່ອຍຫ້ອງ</span>';
                        } elseif($row['type'] == 2) {
                          echo '<span class="badge bg-dark">ຫຼັງປ່ອຍຫ້ອງ</span>';
                        } elseif($row['type'] == 3) {
                          echo '<span class="badge bg-dark">ຫ້ອງບໍ່ມີແຂກ</span>';
                        } elseif($row['type'] == 4) {
                          echo '<span class="badge bg-dark">ແອ</span>';
                        }
                      ?></td>
                      <td><?php echo $row['notes'];?></td>
                      <td><?php
                        if($row['create_date'] > 0){
                          $sd = $row['create_date'];
                          $sd_c= date("d-m-Y", strtotime($sd));
                          echo $sd_c; 
                          } 
                      ?></td>
                      <td><?php  
                      
                      if(empty($row['check_by'])){
                        if($_SESSION['role'] == 8) {
                          if(empty($row['check_by'])){
                          echo '<a href="hdl/room.hdl.php?clean_check_id=';
                          echo $row['id'];
                          echo '&user_id=';
                          echo $_SESSION['userid'];
                          echo '&date=';
                          echo $_GET['date'];
                          echo '" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-check-circle me-1"></i>ລໍຖ້າອະນູມັດ</a>';
                          } 
                            } else {
                              echo '<span class="badge bg-danger">ລໍຖ້າອະນູມັດ</span>';
                            }  
                      } else {
                        echo '<span class="badge bg-success">ອະນູມັດ</span>';
                      }
                    ?>
                    </td>
                      <td>
                      <?php 
                      if($_SESSION['role'] == 8) { 
                      ?>
                      <a href="hdl/room.hdl.php?clean_del_id=<?php echo $row['id']; ?>&date=<?php echo $_GET['date'];?>" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-x-lg"></i></a>
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

<?php

include "footer.php";

?>