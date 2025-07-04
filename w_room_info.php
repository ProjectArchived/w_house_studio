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
                    <h5 class="card-title f-header">ຂໍ້ມູນຫ້ອງພັກ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_room_customers.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ລະຫັດ</th>
                      <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                      <th>ຫ້ອງເລກທີ</th>
                      <th>ວັນທີໄຟມືຶ້ເຂົ້າ</th>
                      <th>ເລກທີໄຟຟ້າມື້ເຂົ້າ</th>
                      <th>ເຂົ້າວັນທີິ</th>
                      <th>ສິ້ນສຸດວັນທີ</th>
                      <th>ອະນາໄມວັນທີ</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($view_room_info)){?>
                    <tr>
                      <td><?php echo $row['id'];?></td>
                      <td scope="row"><?php 
                        echo $row['name'];
                      ?></td>
                      <td><?php echo $row['room_no'];?></td>
                      <td><?php echo $row['e_date'];?></td>
                      <td><?php echo $row['e_unit'];?></td>
                      <td><?php echo $row['checkin_date'];?></td>
                      <td><?php echo $row['checkout_date'];?></td>
                      <td><?php echo $row['clean_date'];?></td>
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

