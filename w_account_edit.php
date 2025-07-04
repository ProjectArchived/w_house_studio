<?php

include "header.php";
include "hdl/account.hdl.php";

?>

  <main id="main" class="main">

   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title f-header">ລາຍລະອຽດບັນຊີໃໝ່</h5>

              <!-- General Form Elements -->
              <?php if(!empty($_GET['change_password'])){?>
              <form method="post" action="hdl/account.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['userid'];?>">

                <input type="hidden" class="form-control" name="account_id" value="<?php echo $_GET['change_password'];?>">

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ລະຫັດ</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" name="password" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຢັ້ງຢືນລະຫັດ</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" name="r_password" required>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="change_password2" onclick="return confirm_action()">ປ່ຽນລະຫັດບັນຊີໃໝ່</button>
                      <!-- <a href="w_account.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a> -->
                    </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->
              <?php } elseif(!empty($_GET['change_detail'])){

                $id = $_GET['change_detail'];
                
                $check = mysqli_query($db, "SELECT * FROM w_db_account WHERE id = $id");
                $result = mysqli_fetch_array($check);
                
                ?>
                <form method="post" action="hdl/account.hdl.php" autocomplete="off" >

                <input type="hidden" class="form-control" name="account_id" value="<?php echo $_GET['change_detail'];?>">

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຊື່ຜູ້ໃຊ້</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="name" value="<?php echo $result['name'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ຊື່ບັນຊີ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="username" value="<?php echo $result['username'];?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">ເບີໂທ</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="phone_no" value="<?php echo $result['phone_no'];?>">
                  </div>
                </div>
                
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <div class="row justify-content-md-end">
                      <button type="submit" class="btn btn-color col-md-3" name="change_detail2" onclick="return confirm_action()">ປ່ຽນຂໍ້ມູນບັນຊີໃໝ່</button>
                      <!-- <a href="w_account.php" class="btn btn-outline btn-color col-md-3">ກັບຄືນ</a> -->
                    </div>
                  </div>
                </div>
              </form>

                <?php }?>

            </div>
          </div>

        </div>

      </div>
    </section>

<?php

include "footer.php";

?>