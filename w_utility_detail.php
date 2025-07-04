<?php

include "header.php";
include "hdl/utility.hdl.php";

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
                    <h5 class="card-title f-header">ການເຄື່ອນໄຫວປະຈຳ ເດືອນ <?php echo $_GET['month'];?> ປີ <?php echo $_GET['year'];?></h5>
                  </div>

                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <?php 

                      $month = $_GET['month'];
                      $year = $_GET['year'];

                      $check_date = mysqli_query($db, "SELECT * FROM w_db_utility WHERE year = '$year' AND month = '$month' AND check_by =''");

                      if(!empty(mysqli_fetch_array($check_date)) && $_SESSION['role'] == 8) {

                          echo '<a href="hdl/utility.hdl.php?approve_all_rec=';
                          echo $_GET['month'];
                          echo '&year=';
                          echo $_GET['year'];
                          echo '&user_id=';
                          echo $_SESSION['userid'];
                          echo '" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3" onclick="return confirm_action()">ກວດທັງໝົດ</a>';
                        }
                      ?>

                      <a href="w_utility_main.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th scope="col">ວັນທີບັນທຶກ</th>
                      <th>ປະເພດ</th>
                      <th>ເລກທີບິນ</th>
                      <th>ປີ</th>
                      <th>ເດືອນ</th>
                      <th>ເລກຄັ້ງກ່ອນ</th>
                      <th>ເລກຄັ້ງນີ້</th>
                      <th>ຈຳນວນທີ່ໃຊ້</th>
                      <th>ລວມເປັນເງິນທັງໝົດ</th> 
                      <th>ສະເລ່ຍຕໍ່ຫົວໜ່ວຍ</th> 
                      <th>ສະຖານທີ່</th>
                      <th>ໝາຍເຫດ</th>
                      <th>ວັນທີຈ່າຍ</th>
                      <th>ສະຖານະ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      $year = $_GET['year'];
                      $month = $_GET['month'];
                      $check_rec = mysqli_query($db, "SELECT * FROM w_db_utility WHERE year = '$year' AND month = '$month' ORDER BY check_by ='' DESC, create_date DESC");
                      while($row = mysqli_fetch_array($check_rec)){?>
                    <tr>
                      <th scope="row"><?php if(!empty($row['create_date'])){
                        $o_f = $row['create_date'];
                        $n_f = date("d-m-Y", strtotime($o_f));
                        echo $n_f;
                      }
                      ?></th>
                      <td>
                      <?php  
                      if($row['cat_id'] == 1) {
                        echo '<span class="badge bg-warning">ໄຟຟ້າ</span>';
                      } elseif ($row['cat_id'] == 2) {
                        echo '<span class="badge bg-info">ນ້ຳ</span>';
                      } elseif ($row['cat_id'] == 3) {
                        echo '<span class="badge bg-primary">ເນັດ</span>';
                      } elseif ($row['cat_id'] == 4) {
                        echo '<span class="badge bg-secondary">ຂີ້ເຫຍື້ອ</span>';
                      } elseif ($row['cat_id'] == 5) {
                        echo '<span class="badge bg-dark">ອື່ນໆ</span>';
                      }        
                      ?>   
                      </td>
                      <td><?php echo $row['ref_no']; ?></td>
                      <td><?php echo $row['year']; ?></td>
                      <td><?php echo $row['month']; ?></td>
                      <td><?php echo $row['s_unit']; ?></td>
                      <td><?php echo $row['e_unit']; ?></td>
                      <td><?php if(!empty($row['t_unit'])){
                        if(!empty($row['t_unit_a'])){
                          if($row['t_unit'] == $row['t_unit_a']){
                            echo '<span class="text-success">';
                            echo number_format($row['t_unit']);
                            echo '</span>';
                          } else {
                            echo '<span class="text-danger">';
                            echo number_format($row['t_unit']);
                            echo '</span>';
                          }
                        } else {
                          echo number_format($row['t_unit']);
                        }    
                      } ?></td>
                      <td>
                      <?php
                      if($row['currency'] == 1 ) {
                        echo number_format($row['amount'])." "."ກີບ";
                      } elseif($row['currency'] == 2 ){
                        echo number_format($row['amount'])." "."ໂດລາ";
                      } elseif($row['currency'] == 3 ){
                        echo number_format($row['amount'])." "."ບາດ";
                      }

                       ?>
                    </td>
                    <td>
                      <?php 
                        if($row['currency'] == 1 ) {
                          echo number_format($row['per_unit'])." "."ກີບ";
                        } elseif($row['currency'] == 2 ){
                          echo number_format($row['per_unit'])." "."ໂດລາ";
                        } elseif($row['currency'] == 3 ){
                          echo number_format($row['per_unit'])." "."ບາດ";
                        }
                      ?>
                    </td>
                      <td><?php
                      if(!empty($row['meter_id'])){
                        
                        $id = $row['meter_id'];
                        $n_query = mysqli_query($db, "SELECT * FROM w_db_list_meter WHERE id = $id");
                        $n_result = mysqli_fetch_array($n_query);
                        echo $n_result['location'];

                      }
                      ?>
                    </td>
                      <td><?php echo $row['remark']; ?></td>
                      <td><?php

                      $o_f = $row['paid_date'];
                      $n_f = date("d-m-Y", strtotime($o_f));
                      echo $n_f;
                      
                      ?></td>
                      <td><?php  
                      
                        if(empty($row['check_by'])){
                          if($_SESSION['role'] == 8){
                            echo '<a href="hdl/utility.hdl.php?utility_check_id=';
                            echo $row['id'];
                            echo '&user_id=';
                            echo $_SESSION['userid'];
                            echo '&year=';
                            echo $_GET['year'];
                            echo '&month=';
                            echo $_GET['month'];
                            echo '" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-check-circle me-1"></i>ລໍຖ້າອະນູມັດ</a>';
                           } else {
                            echo '<span class="badge bg-danger">ລໍຖ້າອະນູມັດ</span>';
                          }
                        } else {
                          echo '<span class="badge bg-success">ອະນູມັດ</span>';
                        }
                      
                      
                      ?></td>
                      <td>
                      <?php if($_SESSION['role'] == 8){?>  
                      <a href="hdl/utility.hdl.php?utility_del_id=<?php echo $row['id'];?>&year=<?php echo $_GET['year'];?>&month=<?php echo $_GET['month'];?>" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-x-lg"></i></a>
                      </td>
                    </tr> 
                    <?php }?>
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

