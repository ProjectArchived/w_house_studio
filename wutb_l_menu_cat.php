<?php

include "header.php";
include "hdl/wutb.l.menu.hdl.php";

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
                    <h5 class="card-title f-header">ປະເພດອາຫານ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="wutb_l_mc_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກປະເພດອາຫານໃໝ່</a>
                      <a href="wutb_l_menu.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ປະເພດ</th>
                      <th>ລາຍລະອຽດ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($mcat_view)){?>
                    <tr>
                      <td><?php echo $row['id'];?></td>
                      <td><?php echo $row['desc_la'];?></td>
                      <td>
                      <a href="wutb_l_mc_add.php?menu_cat_edit_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>
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

