<?php

include "header.php";
include "hdl/account.hdl.php";

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
                    <h5 class="card-title f-header">ຖານຂໍ້ມູນຂອງຜູ້ໃຊ້ລະບົບ</h5>
                  </div>
                  <div class="col-md-8">
                      <div class="row justify-content-md-end">
                        <a href="w_account_new.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ສ້າງບັນຊີໃໝ່</a>
                      </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th scope="col">ລຳດັບ</th>
                      <th>ຊື່ຜູ້ໃຊ້</th>
                      <th>ຊື່ບັນຊີ</th>
                      <th>ເບີໂທ</th>
                      <th>ຕຳແໜ່ງ</th>
                      <th>ຂັ້ນ</th>
                      <th>ສະຖານະ</th>
                      <th>ປົດລອກ/ລອກ</th>
                      <th>ປ່ຽນລະຫັດ</th>
                      <th>ປ່ຽນຂໍ້ມູນ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($view_account)){?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['phone_no']; ?></td>
                      <td><?php 
                      
                      if($row['role_id'] == 1) {
                        echo '<span class="badge bg-info">ພະນັກງານ</span>';
                      } elseif ($row['role_id'] == 8) {
                        echo '<span class="badge bg-success">ຜູ້ຈັດການລະບົບ</span>';
                      }  
                          
                      ?></td>
                      <td>

                      <?php 

                      if($row['role_id'] == 1){
                        echo '<a href="hdl/account.hdl.php?upgrade_account_id=';
                        echo $row['id'];
                        echo '" class="table_tbn badge bg-success text-light" onclick="return confirm_action()"><i class="bi  bi-chevron-double-up me-1"></i>ເລື່ອນຂັ້ນ</a>';
                      } else {
                        echo '<a href="hdl/account.hdl.php?downgrade_account_id='; 
                        echo $row['id'];
                        echo '" class="table_tbn badge bg-warning text-light" onclick="return confirm_action()" ><i class="bi bi-chevron-double-down me-1"></i>ລົດຂັ້ນ</a>';
                      }
                      ?> 
                      </td>
                      <td><?php 
                      
                      if($row['status'] == 1) {
                        echo '<span class="badge bg-success">ອະນຸມັດ</span>';
                      } elseif ($row['status'] == 2) {
                        echo '<a href="hdl/account.hdl.php?approve_account_id=';
                        echo $row['id']; 
                        echo '&user_id=';
                        echo $_SESSION['userid'];
                        echo '" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-check-circle me-1"></i>ອະນຸມັດບັນຊີໃໝ່</a>';
                      } elseif ($row['status'] == 3) {
                        echo '<span class="badge bg-danger">ບັນຊີຖຶກລອກ</span>';
                      }     
              
                      ?></td>

                      <td>
                      
                      <!-- <a href="hdl/signup.hdl.php?account_edit_id=<?php 
                      // echo $row['id']; 
                      ?>" class="table_tbn" onclick="return confirm_action()"><i class="bi bi-pencil-fill li-color-w"></i></a> -->
                      
                      <?php 
                      
                      if($row['status'] == 3){
                        echo '<a href="hdl/account.hdl.php?unlock_account_id=';
                        echo $row['id'];
                        echo '" class="table_tbn badge bg-success text-light" onclick="return confirm_action()"><i class="bi bi-lock-fill me-1"></i>ປົດລອກ</a>';
                      } else {
                        echo '<a href="hdl/account.hdl.php?lock_account_id='; 
                        echo $row['id'];
                        echo '" class="table_tbn badge bg-warning text-light" onclick="return confirm_action()"><i class="bi bi-unlock-fill me-1"></i>ລອກ</a>';
                      }

                      ?>    
                      </td>
                      
                      <td>
                      <a href="w_account_new.php?change_password=<?php echo $row['id']; ?>" class="table_tbn badge bg-info text-light"><i class="bi bi-shield-lock me-1"></i>ປ່ຽນລະຫັດ</a>
                      </td>
                      <td>
                      <a href="w_account_new.php?change_detail=<?php echo $row['id']; ?>" class="table_tbn badge bg-primary text-light"><i class="bi bi-person-lines-fill me-1"></i>ປ່ຽນຂໍ້ມູນ</a>
                      </td>
                      <td>
                      <a href="hdl/account.hdl.php?del_account_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-x-lg"></i></a>
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

