<?php

include "header.php";
include "hdl/wutb.l.expense.hdl.php";

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
                    <h5 class="card-title f-header">ລາຍການລາຍຈ່າຍຂອງຮ້ານ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="wutb_l_expense_cat.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ປະເພດລາຍຈ່າຍ</a>
                      <a href="wutb_l_e_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກລາຍຈ່າຍໃໝ່</a>
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
                      while($row = mysqli_fetch_array($expense_view)){?>
                    <tr>
                      <td><?php 

                      if(!empty($row['cat_id'])){
                        $id = $row['cat_id'];
                        $check = mysqli_query($db, "SELECT * FROM wutb_db_list_expense_cat WHERE id = $id");
                        $result = mysqli_fetch_array($check);
                        echo $result['desc_la'];
                      }
                      
                      ?></td>
                      <td><?php echo $row['desc_la'];?></td>
                      <td>
                      <a href="wutb_l_e_add.php?expense_edit_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>
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

