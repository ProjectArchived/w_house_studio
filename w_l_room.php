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
                  <div class="col-md-4">
                    <h5 class="card-title f-header">ລາຍການຫ້ອງພັກ</h5>
                  </div>
                </div>
              </div>
                   
              <div class="table-responsive">
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th scope="col">ເລກທີຫ້ອງພັກ</th>
                      <th>ສະຖານະຫ້ອງພັກ</th>
                      <th>ລູກຄ້າ</th>
                      <th>ລາຍລະອຽດ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($room_view)){
                        $customer_id = $row['customer_id'];?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php 
                        if($row['r_status'] == 0) {
                          echo '<span class="badge bg-success">ວ່າງ</span>';
                        } elseif($row['r_status'] == 1) {
                          echo '<span class="badge bg-danger">ບໍ່ວ່າງ</span>';
                        } elseif($row['r_status'] == 2) {
                          echo '<span class="badge bg-warning">ກຳລັງອະນາໄມ</span>';
                        } elseif($row['r_status'] == 3) {
                          echo '<span class="badge bg-secondary">ນຳໃຊ້</span>';
                        }
                      ?></td>
                      <td><?php 
                      
                      if(!empty($row['customer_id'])){
                        $id = $row['customer_id'];
                        $check = mysqli_query($db, "SELECT * FROM w_db_room_customer_info WHERE id = '$id'");
                        $result = mysqli_fetch_array($check);
                        echo $result['fname'].' '.$result['lname'];
                      }
                      
                      ?></td>
                      <td><?php echo $row['remark']; ?></td>
                      <td>
                        <?php if($row['r_status'] == 0 || $row['r_status'] == 3) {
                          echo '<a href="w_l_r_update.php?room_edit_id='; 
                          echo $row['id']; 
                          echo '" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>';
                        }?> 
                      
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

