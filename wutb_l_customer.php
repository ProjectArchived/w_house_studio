<?php

include "header.php";
include "hdl/wutb.l.customer.hdl.php";

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
                    <h5 class="card-title f-header">ລາຍການລູກຄ້າ</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="wutb_l_customer_cat.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ປະເພດລູກຄ້າ</a>
                      <a href="wutb_l_c_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກລູກຄ້າໃໝ່</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ປະເພດ</th>
                      <th>ລະຫັດກຸ່ມລູກຄ້າ</th>
                      <th>ຊື່</th>
                      <th>ສາຂາ</th>
                      <th>ເບີໂທຕິດຕໍ່</th>
                      <th>ທີ່ຢູ່ຫ້ອງການ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($customer_view)){?>
                    <tr>
                      <td><?php 
                      if($row['type'] == 1){
                        echo 'ສ່ວນບຸກຄົນ';
                      } elseif ($row['type'] == 2){
                        echo 'ບໍລິສັດຈັດສົ່ງ';
                      } elseif ($row['type'] == 3){
                        echo 'ບໍລິສັດ';
                      } elseif ($row['type'] == 4){
                        echo 'ຮ້ານຄ້າ';
                      } elseif ($row['type'] == 5){
                        echo 'ຮ້ານອາຫານ';
                      }
                      ?></td>
                      <td><?php echo $row['sub_id'];?></td>
                      <td><?php echo $row['name'];?></td>
                      <td><?php echo $row['branch'];?></td>
                      <td><?php echo $row['phone_no'];?></td>
                      <td><?php echo $row['location'];?></td>
                      <td>
                      <a href="wutb_l_c_add.php?customer_edit_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>
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

