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
                    <h5 class="card-title f-header">ລາຍການປະເພດການບໍລິການ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_l_sc_m.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກປະເພດການບໍລິການໃໝ່</a>
                      <a href="w_l_meter.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ລາຍລະອຽດການບໍລິການ</a>
                    </div>
                  </div>
                </div>
              </div>
                   
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ປະເພດການບໍລິການ</th>
                      <th>ໝາຍເຫດ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($view_service_cat)){?>
                    <tr>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['remark']; ?></td>
                      <td>
                      <a href="w_l_sc_m.php?sc_edit_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>
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

