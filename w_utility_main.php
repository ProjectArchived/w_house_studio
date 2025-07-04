<?php

include "header.php";
include "hdl/utility.hdl.php";
include "footer.php";

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
                    <h5 class="card-title f-header">ສະຫຼຸບການເຄື່ອນໄຫວ</h5>
                  </div>

                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_utility_electric.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ຄ່າໄຟຟ້າ</a>
                      <a href="w_utility_water.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ຄ່ານ້ຳ</a>
                      <a href="w_utility_internet.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ຄ່າອິນເຕີເນັດ</a>
                      <a href="w_utility_garbage.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ຄ່າຂີ້ເຫຍື້ອ</a>
                      <a href="w_utility_others.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ຄ່າອື່ນໆ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped" id="examples">
                  <thead>
                    <tr>
                      <th>ປິ</th>
                      <th>ເດືອນ</th>
                      <th>ຈຳນວນລາຍການທັງໝົດ</th>
                      <th>ຈຳນວນລາຍການບໍ່ທັນສຳເລັດ</th>
                      <th>ສະຖານະ</th>
                    </tr>
                  </thead>
                  <tbody data-link="row" class="rowlink">

                    <?php 
                      while($row = mysqli_fetch_array($bill_gview)){?> 
                    <tr class="pointer" onclick="window.open('w_utility_detail.php?year=<?php echo $row['year'];?>&month=<?php echo $row['month'];?>','_self')">

                    <!-- Placeholder -->
                    <!-- 'event_info.php?events_id=<?php 
                    // echo $row['events_id']  ?>','_blank' -->

                        <td scope="row"><?php echo $row['year']; ?></td>
                        <td scope="row"><?php echo $row['month']; ?></td>
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
