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
                    <h5 class="card-title f-header">ລາຍການປະເທດ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_l_e_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກລາຄາໃໝ່</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ເລກທີ</th>
                      <th>ປະເພດ</th>
                      <th>ອັດຕາ</th>
                      <th>ວັນທີບັນທຶກ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($e_rate_view)){?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php 
                      if ($row['cat_id'] == 1){
                        echo 'ໄຟຟ້າ';
                      }
                      ?></td>
                      <td><?php echo number_format($row['rate']); ?></td>
                      <td><?php echo $row['create_date']; ?></td>
                      <td>
                      <a href="w_l_e_add.php?e_edit_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>
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

