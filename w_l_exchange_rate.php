<?php

include "header.php";
include "hdl/l.currency.hdl.php";

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
                    <h5 class="card-title f-header">ປະຫວັດການບັນທຶກອັດຕາແລກປ່ຽນ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_l_currency.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ວັນທີ</th>
                      <th>ສະກຸນເງິນ</th>
                      <th>ອັດຕາຊື້</th>
                      <th>ອັດຕາຂາຍ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($rate_view)){?>
                    <tr>
                      <td><?php 
                      if($row['create_date'] > 0){
                        $c_d = $row['create_date'];
                        $r_c_d = date("d-m-Y", strtotime($c_d));
                        echo $r_c_d;
                        }
                      ?></td>
                      <td><?php 
                      if(!empty($row['currency_id'])){

                        $id = $row['currency_id'];

                        $query = mysqli_query($db, "SELECT * FROM w_db_list_currency WHERE id = $id");
                        $result = mysqli_fetch_array($query);

                        echo $result['currency_la'];
                        }
                      
                      
                      ?></td>
                      <td><?php echo number_format($row['buy_rate'])." "."ກີບ";?></td>
                      <td><?php echo number_format($row['sell_rate'])." "."ກີບ"; ?></td>
                      <td><a href="hdl/l.currency.hdl.php?ex_del_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-x-lg"></i></a></td>
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

