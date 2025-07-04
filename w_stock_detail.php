<?php

include "header.php";
include "hdl/stock.hdl.php";

?>

  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

              <div class="col-lg-12">
                <div class="row">

                  <div class="col-lg-8">
                    <h5 class="card-title f-header">ການເຄື່ອນໄຫວປະຈຳວັນທີ 
                      <?php 
                        $date = $_GET['date'];
                        $date_f = date("d-m-Y", strtotime($date));
                        echo $date_f; 
                      ?>

                    </h5>
                  </div>

                
                  <div class="col-lg-4">
                    <div class="row justify-content-md-end">
                      <?php 

                      $date = $_GET['date'];
                      $check_date = mysqli_query($db, "SELECT * FROM w_db_stock WHERE DATE (create_date) = '$date' ORDER BY check_by ='' DESC");

                      if($_SESSION['role'] == 8 && $result=mysqli_fetch_array($check_date)) {
                          if(empty($result['check_by'])){

                          echo '<a href="hdl/stock.hdl.php?approve_all_rec=';
                          echo $_GET['date'];
                          echo '&user_id=';
                          echo $_SESSION['userid'];
                          echo '" type="button" class="btn btn-outline btn-color btn-in-table p-2 col-md-3" onclick="return confirm_action()">ກວດທັງໝົດ</a>';
                        }
                      }   
                      ?>

                      <a href="w_stock_main.php"  class="btn btn-outline btn-color btn-in-table p-2 col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive-xl">
                <table class="table datatable table-hover table-striped">
                  <thead>
                    <tr>
                      <th>ວັນທີບັນທຶກ</th>
                      <th>ປະເພດ</th>
                      <th>ເລກທີ</th>
                      <th>ຫ້ອງ</th>
                      <th>ລາຍລະອຽດຂອງເຄື່ອງ</th>
                      <th>ຈຳນວນເຄື່ອງ</th>
                      <th>ຈຳນວນເງິນ</th>
                      <th>ຮ້ານຄ້າ</th>
                      <th>ຂໍ້ຄວາມ</th>
                      <th>ເຫັນດີຂໍເບີກ</th>
                      <th>ສະຖານະ</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if (isset($_GET['date'])){
                      $date = $_GET['date'];

                    $check_rec = mysqli_query($db, "SELECT * FROM w_db_stock WHERE DATE (create_date) = '$date' ORDER BY check_by ='' DESC, id DESC");
                    while($row = mysqli_fetch_array($check_rec)){?>
                    <tr>
                      <td><?php 
                        if(!empty($row['create_date'])){
                          $o_f = $row['create_date'];
                          $n_f = date("d-m-Y", strtotime($o_f));
                          echo $n_f;
                        }
                      ?>
                      </td>
                      <td>
                        <?php 
                          if($row['cat_id'] == 1){
                            echo '<span class="badge bg-success">ຊື້ໃໝ່</span>';
                          } elseif ($row['cat_id'] == 2){
                            echo '<span class="badge bg-success">ສົ່ງຄືນ</span>';
                          } elseif ($row['cat_id'] == 3){
                            echo '<span class="badge bg-warning">ຂໍເບີກ</span>';
                          } elseif ($row['cat_id'] == 4){
                            echo '<span class="badge bg-danger">ໂລະອອກ</span>';
                          } elseif ($row['cat_id'] == 5){
                            echo '<span class="badge bg-danger">ໃຫ້ນຳໃຊ້</span>';
                          }
                        ?>             
                      </td>
                      <td><?php echo $row['ref_no'];?></td>
                      <td><?php echo $row['room_no'];?></td>
                      <td><?php 
                      
                      if(!empty($row['item_id'])){
                        $item_id = $row['item_id'];
                        $item_c = mysqli_query($db, "SELECT * FROM w_db_list_item WHERE id = $item_id");
                        while($result = mysqli_fetch_array($item_c)){
                          echo $result['item_la'];
                        }
                      }

                      ?></td>
                      <td><?php echo $row['unit'];?></td>
                      <td><?php 
                      
                      if($row['currency'] == 1){
                        echo $row['amount'].' '."ກີບ";
                      } elseif($row['currency'] == 2){
                        echo $row['amount'].' '."ໂດລາ";
                      } elseif($row['currency'] == 3){
                        echo $row['amount'].' '."ບາດ";
                      } elseif($row['currency'] == 4){
                        echo $row['amount'].' '."ຢວນ";
                      }

                      ?></td>
                      <td><?php 

                        if(!empty($row['supplier_id'])){
                          $supplier_id = $row['supplier_id'];
                          $supplier_c = mysqli_query($db, "SELECT * FROM w_db_list_supplier WHERE id = $supplier_id");
                          while($result = mysqli_fetch_array($supplier_c)){
                            echo $result['location'];
                          }
                        }
                      
                      ?></td>
                      <td><?php echo $row['notes'];?></td>
                      <td><?php 
                        
                        if($row['status'] == 1){
                          echo '<span class="badge bg-success">ແມ່ນ</span>';
                        } elseif($row['status'] == 2){
                          echo '<span class="badge bg-danger">ບໍ່ແມ່ນ</span>';
                        } 
                      
                      ?></td>
                      <td><?php 
                      
                      if(empty($row['check_by'])) {
                        if($_SESSION['role'] == 8){
                          echo '<a href="hdl/stock.hdl.php?stock_check_id=';
                          echo $row['id']; 
                          echo '&user_id=';
                          echo $_SESSION['userid'];
                          echo '&date=';
                          echo $_GET['date'];
                          echo '" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-check-circle me-1"></i>ລໍຖ້າອະນູມັດ</a>';
                        }else{
                          echo '<span class="badge bg-danger">ລໍຖ້າອະນູມັດ</span>';
                        }   
                      } else {
                        echo '<span class="badge bg-success">ອະນູມັດ</span>';
                      }    
                      ?>
                      </td>
                      <td>
                        <?php if($_SESSION['role'] == 8){?>
                          <a href="hdl/stock.hdl.php?stock_del_id=<?php echo $row['id'];?>&date=<?php echo $_GET['date'];?>" class="table_tbn badge bg-danger text-light" onclick="return confirm_action()"><i class="bi bi-x-lg"></i></a>
                      </td>
                    </tr>
                      <?php }?>
                    <?php } }?>
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