<?php

include "header.php";
include "hdl/wutb.stock.hdl.php";

?>

  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

              <div class="col-lg-12">
                <div class="row">

                  <div class="col-lg-2">
                    <h5 class="card-title f-header">

                    ສະຫຼຸບການເຄື່ອນໄຫວ

                    </h5>
                  </div>

                  <?php if($_SESSION['role'] == 8){?>
                
                  <div class="col-lg-10">
                    <div class="row justify-content-md-end">
                    
                      <a href="wutb_salary_add.php" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ຈ່າຍເງິນເດືອນ</a>
                    </div>
                  </div>
                  <?php }?>
                </div>
              </div>
              
              <div class="table-responsive-xl">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ວັນທີບັນທຶກ</th>
                      <th>ຈຳນວນລາຍການທັງໝົດ</th>
                      <th>ຈຳນວນລາຍການບໍ່ທັນສຳເລັດ</th>
                      <th>ສະຖານະ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysqli_fetch_array($wutb_salary_view)){?> 
                    <tr class="pointer" onclick="window.open('wutb_salary_detail.php?date=<?php echo $row['group_date'];?>','_self')">

                    <!-- Placeholder -->
                    <!-- 'event_info.php?events_id=<?php 
                    // echo $row['events_id']  ?>','_blank' -->

                        <td scope="row"><?php 
                        if($row['group_date'] > 0){
                          $sd = $row['group_date'];
                          $sd_c= date("d-m-Y", strtotime($sd));
                          echo $sd_c; 
                          }
                        ?></td>
                        <td scope="row"><?php echo $row['total']; ?></td>
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