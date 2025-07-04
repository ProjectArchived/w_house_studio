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
                    <h5 class="card-title f-header">
                    ສະຫຼຸບການເຄື່ອນໄຫວ
                    </h5>
                  </div>

                  <div class="col-md-7">
                    <div class="row justify-content-md-end">
                      <a href="w_vacant_clean_rec.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ບັນທຶກອະນາໄມຫ້ອງ</a>
                      <a href="w_vacant_air_clean.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ບັນທຶກອະນາໄມແອ</a>
                      <a href="w_vacant_item_sum.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ສະຫຼຸບເຄື່ອງໃນຫ້ອງພັກ</a>
                      
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive-xl">
                <table class="table datatable table-hover table-striped" >
                  <thead>
                    <tr>
                      <th>ວັນທີອະນາໄມ</th>
                      <th>ຈຳນວນລາຍການທັງໝົດ</th>
                      <th>ຈຳນວນລາຍການບໍ່ທັນສຳເລັດ</th>
                      <th>ສະຖານະ</th>

                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    while($row=mysqli_fetch_assoc($clean_gview)){
                  ?>
                    <tr class="pointer" onclick="window.open('w_vacant_detail.php?date=<?php echo $row['group_date'];?>','_self')">
                      <td> 
                      <?php 
                        if($row['group_date'] > 0){
                          $sd = $row['group_date'];
                          $sd_c= date("d-m-Y", strtotime($sd));
                          echo $sd_c; 
                          }
                        ?>
                      </td>
                      <td><?php echo $row['total'];?></td>
                      <td scope="row"><?php 
                        if($row['pending'] > 0){
                        echo '<span class="text-danger">';
                        echo $row['pending'];
                        echo '</span>';}
                        ?></td>
                        <td>
                        <?php 
                        if($row['pending'] >= 1) {
                          echo '<span class="badge bg-danger">ຍັງບໍ່ສຳເລັດ</span>';
                        } else {
                          echo '<span class="badge bg-success">ສຳເລັດ</span>';
                        }      
                        ?>   
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