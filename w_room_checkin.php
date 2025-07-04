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
          <!-- New Customer -->
            <?php if(empty($_GET['customer_id'])){?>
            <form method="post" action="hdl/room.hdl.php" autocomplete="off" >
              <h5 class="card-title f-header">ຂໍ້ມູນລູກຄ້າ</h5>
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຫ້ອງເລກທີ <?php echo $_GET['room_no']?></label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="room_no" value="<?php echo $_GET['room_no']?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ເລີ່ມວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="checkin_date" value="<?php date_default_timezone_set("Asia/Vientiane"); echo date('Y-m-d'); ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label" >ຊື່</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="fname" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ນາມສະກຸນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="lname" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="gender" required>
                      <option value="1">ຊາຍ</option>
                      <option value="2">ຍິງ</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ສັນຊາດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="national" required>
                      <option value="">ກົດເພື່ອເລືອກ</option>
                        <?php while($r_national_view = mysqli_fetch_array($national_view)){ ?>
                          <option value="<?php echo $r_national_view['id'];?>"><?php echo $r_national_view['national_la'];?></option>  
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-3 col-form-label">ເບີໂທ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="phone_no" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-3 col-form-label">ເລກທີ ພາສປອດ / ບັດປະຈຳໂຕ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="p_no" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ອອກວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="p_sd" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຮອດວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="p_ed" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="new_checkin" onclick="return confirm_action()">ບັນທຶກ</button>
                      <a href="w_room_main.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>

            </form>
            <?php } ?>


          <!-- Update Customer Info -->
            <?php if(!empty($_GET['customer_id'])){
              $id = $_GET['customer_id'];
              $check = mysqli_query($db, "SELECT * FROM w_db_room_customer_info WHERE id = $id");
              $result = mysqli_fetch_array($check);
              ?>
              <form method="post" action="hdl/room.hdl.php" autocomplete="off" >
                <h5 class="card-title f-header">ຂໍ້ມູນລູກຄ້າ</h5>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຫ້ອງເລກທີ <?php echo $_GET['room_no']?></label>
                  <input type="hidden" class="form-control" name="room_no" value="<?php echo $_GET['room_no'];?>">
                  <div class="col-sm-9">
                  </div>
                </div>

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <input type="hidden" class="form-control" name="customer_id" value="<?php echo $_GET['customer_id'];?>">

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label" >ຊື່</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?php echo $result['fname'];?>" name="fname" >
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ນາມສະກຸນ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="lname" value="<?php echo $result['lname'];?>" >
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ເພດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="gender" >
                      <option value="<?php echo $result['gender'];?>"><?php 
                        if($result['gender'] == 1){
                          echo "ຊາຍ";
                        } elseif ($result['gender'] == 2){
                          echo "ຍິງ";
                        }  
                      ?></option>
                      <option>--------</option>
                      <option value="1">ຊາຍ</option>
                      <option value="2">ຍິງ</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">ສັນຊາດ</label>
                  <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" name="national">
                      <option value="<?php echo $result['nationality'];?>"><?php 
                        if(!empty($result['nationality'])){
                          $id = $result['nationality'];

                          $check = mysqli_query($db, "SELECT * FROM w_db_list_country WHERE id = $id");
                          $result_2 = mysqli_fetch_array($check);
                          echo $result_2['national_la'];
                        }  
                      ?></option>
                      <option>--------</option>
                        <?php while($r_national_view = mysqli_fetch_array($national_view)){ ?>
                          <option value="<?php echo $r_national_view['id'];?>"><?php echo $r_national_view['national_la'];?></option>  
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-3 col-form-label">ເບີໂທ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="phone_no" value="<?php echo $result['phone_no'];?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-3 col-form-label">ເລກທີ ພາສປອດ / ບັດປະຈຳໂຕ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="p_no" value="<?php echo $result['id_no'];?>" >
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ອອກວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="p_sd" value="<?php 
                      $date = $result['id_start_date']; 
                      $newDate = date("Y-m-d", strtotime($date)); 
                      echo $newDate;
                    
                    ?>" >
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-3 col-form-label">ຮອດວັນທີ</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="p_ed" value="<?php 

                    $date = $result['id_end_date']; 
                    $newDate = date("Y-m-d", strtotime($date)); 
                    echo $newDate;
                    
                    ?>" >
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="change_customer_detail" onclick="return confirm_action()">ບັນທຶກການແກ້ໄຂ</button>
                      <a href="w_room_detail.php?room_no=<?php echo $_GET['room_no'];?>&customer_id=<?php echo $_GET['customer_id'];?>" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a>
                    </div>
                  </div>
                </div>
              </form><!-- End General Form Elements -->
            <?php } ?>            
          </div>
        </div>
      </div>
    </div>
  </section>


<?php

include "footer.php";

?>