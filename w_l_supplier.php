<?php

include "header.php";
include "hdl/l.supplier.hdl.php";

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
                    <h5 class="card-title f-header">ລາຍການຮ້ານຄ້າ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_l_s_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກຮ້ານຄ້າໃໝ່</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ປະເທດ</th>
                      <th>ຮ້ານຄ້າ</th>
                      <th>ເບີໂທຕິດຕໍ່</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($supplier_view)){?>
                    <tr>
                      <td><?php 
                      
                      if(!empty($row['country'])){
                        $country_id = $row['country'];
                        $c_check = mysqli_query($db, "SELECT * FROM w_db_list_country WHERE id = $country_id");
                        $r_check = mysqli_fetch_array($c_check);
                        
                        echo $r_check['country_la'];
                      }
  
                      ?></td>
                      <td><?php echo $row['location']; ?></td>
                      <td><?php echo $row['phone_no']; ?></td>
                      <td>
                      <a href="w_l_s_add.php?supplier_edit_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>
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

