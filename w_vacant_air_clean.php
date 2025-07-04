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
                    <h5 class="card-title f-header">ຂໍ້ມູນການອະນາໄມແອ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                    <a href="w_vacant_main.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ຫ້ອງເລກທີ</th>
                      <th>ວັນທີອະນາໄມ</th>
                      <th>ແກ້ໄຂ</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($v_air_clean)){?>
                    <tr>
                      <td><?php echo $row['room_no']; ?></td>
                      <td><?php echo $row['clean_date']; ?></td>
                      <td>
                      <a href="hdl/room.hdl.php?air_del_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-x-lg"></i></a>
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

