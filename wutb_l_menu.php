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
                    <h5 class="card-title f-header">ລາຍການອາຫານ</h5>
                  </div>
                  <?php if($_SESSION['role'] == 8){?>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="wutb_l_menu_cat.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ປະເພດອາຫານ</a>
                      <a href="wutb_l_me_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ບັນທຶກອາຫານໃໝ່</a>
                      <a href="wutb_l_price_cat.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-2">ປະເພດລາຄາ</a>
                      <a href="wutb_l_menu_price.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ປະຫວັດການບັນທຶກລາຄາອາຫານ</a>
                    </div>
                  </div>
                  <?php }?>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>ປະເພດ</th>
                      <th>ລາຍການອາຫານ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($menu_view)){?>
                    <tr>
                      <td><?php 

                      if($row['type'] == 1){
                        echo 'ເຄັກ';
                      } elseif ($row['type'] == 2){
                        echo 'ຄຸກກີ້';
                      } elseif ($row['type'] == 3){
                        echo 'ຂະໜົມປັງ';
                      } elseif ($row['type'] == 4){
                        echo 'ນ້ຳ';
                      } elseif ($row['type'] == 5){
                        echo 'ອື່ນໆ';
                      }

                      ?></td>
                      <td><?php echo $row['menu_la'];?></td>
                      
                      <td>
                      <a href="wutb_l_me_add.php?menu_edit_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>
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

