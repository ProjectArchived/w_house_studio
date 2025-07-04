<?php

include "header.php";
include "hdl/l.item.hdl.php";

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
                    <h5 class="card-title f-header">ລາຍການເຄື່ອງໃຊ້</h5>
                  </div>
                  <div class="col-md-8">
                    <div class="row justify-content-md-end">
                      <a href="w_l_i_add.php" class="btn btn-outline btn-color btn-in-table p-2 col-md-4">ບັນທຶກເຄື່ອງໃຊ້ໃໝ່</a>
                    </div>
                  </div>
                </div>
              </div>
                   
              <div class="table-responsive">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th scope="col">ເລກທີ</th>
                      <th>ປະເພດ</th>
                      <th>ເຄື່ອງໃຊ້ (ພາສາລາວ)</th>
                      <th>ເຄື່ອງໃຊ້ໃນຫ້ອງ</th>
                      <th>ຈຳນວນເບື້ອງຕົ້ນ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php 
                      while($row = mysqli_fetch_array($item_view)){?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php 
                      if($row['cat_id'] == 1) {
                        echo "ເຄື່ອງໃຊ້ໄຟຟ້າ";
                      } elseif($row['cat_id'] == 2) {
                        echo "ເຄື່ອງຄົວ";
                      } elseif($row['cat_id'] == 3) {
                        echo "ເຄື່ອງຫ້ອງນອນ";
                      } elseif($row['cat_id'] == 4) {
                        echo "ເຄື່ອງນ້ຳ";
                      }elseif($row['cat_id'] == 5) {
                        echo "ອຸປະກອນທົ່ວໄປ";
                      }
                      
                      ?></td>
                      <td><?php echo $row['item_la']; ?></td>
                      <td><?php 
                      
                      if($row['room_use'] == 1){
                        echo 'ແມ່ນ';
                      } else {
                        echo 'ບໍ່ແມ່ນ';
                      }
                      
                      ?></td>
                      <td><?php echo $row['s_unit']; ?></td>
                      <td>
                      <a href="w_l_i_add.php?item_edit_id=<?php echo $row['id']; ?>" class="table_tbn badge bg-warning text-light"><i class="bi bi-pencil-fill"></i></a>
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

