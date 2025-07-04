<?php

include "header.php";
include "hdl/l.meter.hdl.php";

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
                    <h5 class="card-title f-header">ລາຍລະອຽດການບໍລິການ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_l_m_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ບັນທຶກການບໍລິການ</a>
                      <a href="w_l_servicecat.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th scope="col">ປະເພດ</th>
                      <th>ເລກທີ</th>
                      <th>ເລກບັນຊີ</th>
                      <th>ເລກຜູ້ໃຊ້</th>
                      <th>ຊື່</th>
                      <th>ເບີໂທຕິດຕໍ່</th>
                      <th>ສະຖານທີ່</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($meter_view)){?>
                    <tr>
                      <td>
                      <?php 
                      
                      if($row['cat_id'] == 1) {
                        echo '<span class="badge bg-warning">E</span>';
                      } elseif ($row['cat_id'] == 2) {
                        echo '<span class="badge bg-info">W</span>';
                      } elseif ($row['cat_id'] == 3) {
                        echo '<span class="badge bg-primary">I</span>';
                      }        
                      ?>   
                      </td>
                      <td><?php echo $row['meter_no']; ?></td>
                      <td><?php echo $row['account_no']; ?></td>
                      <td><?php echo $row['user_no']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['emergency_call']; ?></td>
                      <td><?php echo $row['location']; ?></td>

                      <td>
                      <a href="w_l_m_add.php?meter_edit_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>
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

