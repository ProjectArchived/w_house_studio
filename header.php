<?php 
session_start();
if(isset($_SESSION['username'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>W Project</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Jquery add comma while typing -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link href="filter-table/css/addons/datatables.min.css" rel="stylesheet">

  <script type="text/javascript">

      // Version 1
      $(document).ready(function() {
        $('#filter thead tr').clone(true).appendTo( '#filter thead' );
        $('#filter thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" class="form-control" style="height: 14px; font-size: 12px; margin-top: 0px; border: 0px;" placeholder="ຄົ້ນຫາ" />' );
            $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                table
                  .column(i)
                  .search( this.value )
                  .draw();
              }
            } );
        } );
        var table = $('#filter').DataTable( {
            orderCellsTop: true,
            fixedHeader: true
        } );
    } );

  </script>  

  <!--  -->
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style type="text/css">
	body, span, p, label, h5, .f-header{
		font-family: Phetsarath OT, Saysettha OT;
	}
  </style>
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">W Project</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="dropdown-toggle ps-2"><?php echo $_SESSION['username'];?></span>
          </a><!-- End Profile Iamge Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              </h6>
             <?php 
              
              if($_SESSION['role'] == 8){
                echo " <span>ຜູ້ຈັດການລະບົບ</span>";
              } elseif($_SESSION['role'] == 1){
                echo "<span>ພະນັກງານ</span>";
              }

              ?>
              <?php echo '<h6>'.$_SESSION['username'].'</h6>'; }
                             else{
                    header('Location: w_login.php'); }?>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="w_account_edit.php?change_detail=<?php echo $_SESSION['userid'];?>">
                <i class="bi bi-person-lines-fill"></i>
                <span>ປ່ຽນຂໍ້ມູນບັນຊີໃໝ່</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="w_account_edit.php?change_password=<?php echo $_SESSION['userid'];?>">
                <i class="bi bi-shield-lock"></i>
                <span>ປ່ຽນລະຫັດບັນຊີໃໝ່</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="hdl/logout.hdl.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>ອອກຈາກລະບົບ</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->
            
  </header>
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <!-- W Studio House -------->                        
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#w_studio_house-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-house"></i><span>ຫ້ອງພັກ</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="w_studio_house-nav" class="nav-content collapse 

        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_main.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_detail.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_checkin.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_clean.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_deposit.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_rental.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_electric.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_note.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_item_return.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_item_req.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_switch.php")?"show":""; ?>

        <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_main.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_detail.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_clean_rec.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_item_rec.php")?"show":""; ?>

        <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_item_sum.php")?"show":""; ?>

        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_customers.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_info.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_switch.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_customer_rental.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_customer_electric.php")?"show":""; ?>

        <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_sum.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_main.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_detail.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_detail.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_buy.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_dispose.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_req_select.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_req_approve.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_return_approve.php")?"show":""; ?>

        <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_main.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_detail.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_electric.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_garbage.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_water.php")?"show":""; ?> 
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_others.php")?"show":""; ?> 

        <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_air_clean.php")?"show":""; ?> 
        <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_air_clean_rec.php")?"show":""; ?> 
  
        " data-bs-parent="#sidebar-nav">
          <li>
            <a href="w_room_main.php" 
            class="
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_main.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_detail.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_checkin.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_clean.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_deposit.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_rental.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_electric.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_note.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_item_return.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_item_req.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_switch.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_switch.php")?"active":""; ?>
            ">
              <i class="bi bi-circle"></i><span>ສະຖານະຫ້ອງພັກໂດຍລວມ</span>
            </a>
          </li>
          <li>
            <a href="w_vacant_main.php" class="
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_main.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_detail.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_item_sum.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_clean_rec.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_item_rec.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_air_clean.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_vacant_air_clean_rec.php")?"active":""; ?>
            ">
              <i class="bi bi-circle"></i><span>ສະຖານະການອະນາໄມ</span>
            </a>
          </li>

          <li>
            <a href="w_stock_main.php" class="
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_main.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_detail.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_sum.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_buy.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_dispose.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_req_select.php")?"active":""; ?>  
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_req_approve.php")?"active":""; ?>         
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_stock_return_approve.php")?"active":""; ?> 
            ">
           
              <i class="bi bi-circle"></i><span>ເຄື່ອງໃນສາງ</span>
            </a>
          </li>
          <li>
            <a href="w_utility_main.php" class="
            
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_main.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_detail.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_electric.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_water.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_garbage.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_utility_others.php")?"active":""; ?>
            ">
              <i class="bi bi-circle"></i><span>ຄ່າບໍລິການ</span>
            </a>
          </li>
          <li>
            <a href="w_room_customers.php" class="
            
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_customers.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_room_info.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_customer_rental.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "w_customer_electric.php")?"active":""; ?>
            ">
              <i class="bi bi-circle"></i><span>ຂໍ້ມູນຂອງລູກຄ້າ</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- Wakeup Tea Bar ---------->                        
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#w_wakeupteabar-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-shop"></i><span>ຮ້ານເຂົ້າໜົມ</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="w_wakeupteabar-nav" class="nav-content collapse 

        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale_main.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale_detail.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale_return.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sr_bake.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale_reserve_approve.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale_payment.php")?"show":""; ?>

        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_sum.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_main.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_detail.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_buy.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_dispose.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sm_assign.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_use.php")?"show":""; ?>

        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_salary_main.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_salary_detail.php")?"show":""; ?>
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_salary_add.php")?"show":""; ?>

        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_price_check.php")?"show":""; ?> 
        <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_price_view.php")?"show":""; ?> 
    
        " data-bs-parent="#sidebar-nav">
          <li>
            <a href="wutb_sale_main.php" class="
            
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale_main.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale_detail.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale_return.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sr_bake.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale_reserve_approve.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sale_payment.php")?"active":""; ?>
            ">
              <i class="bi bi-circle"></i><span>ສະຫຼຸບປະຈຳວັນ</span>
            </a>
          </li>

          <li>
            <a href="wutb_stock_main.php" class="
            
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_main.php")?"active":""; ?>   
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_detail.php")?"active":""; ?>   
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_sum.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_buy.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_dispose.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_sm_assign.php")?"active":""; ?> 
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_stock_use.php")?"active":""; ?>
            
            ">
            
          <i class="bi bi-circle"></i><span>ລາຍຈ່າຍ ແລະ ເຄື່ອງໃນສາງ</span>
            </a>
          </li>

          <?php if($_SESSION['role'] == 8) {?>                    
          <li>
            <a href="wutb_salary_main.php" class="
            
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_salary_main.php")?"active":""; ?>   
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_salary_detail.php")?"active":""; ?>  
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_salary_add.php")?"active":""; ?> 
            ">
            
                      
          <i class="bi bi-circle"></i><span>ລາຍຈ່າຍເງິນເດືອນ</span>
            </a>
          </li>
          
          <?php } ?>
          <li>
            <a href="wutb_price_check.php" class="
            
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_price_check.php")?"active":""; ?>
            <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_price_view.php")?"active":""; ?>

            ">
              <i class="bi bi-circle"></i><span>ລາຄາຂະໜົມ</span>
            </a>
          </li>
        </ul>
      </li>
      <?php if($_SESSION['role'] == 8){?>
      <hr>
      <!-- Room (Backend)  ---------->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#w_room_m-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-house-fill"></i><span>ຈັດການຫ້ອງພັກ</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="w_room_m-nav" class="nav-content collapse 

          <?php echo (basename($_SERVER['PHP_SELF']) == "w_dashboard.php")?"show":""; ?>

          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_meter.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_m_add.php")?"show":""; ?> 

          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_item.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_i_add.php")?"show":""; ?> 

          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_room.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_r_update.php")?"show":""; ?>

          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_servicecat.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_sc_m.php")?"show":""; ?>
          " data-bs-parent="#sidebar-nav">
            <li>
              <a href="w_dashboard.php" class="
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_dashboard.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ສະຫຼຸບຫ້ອງພັກ</span>
              </a>
            </li>
            <li>
              <a href="w_l_item.php" class="
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_item.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_i_add.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ລາຍການເຄື່ອງໃຊ້</span>
              </a>
            </li>
            <li>
              <a href="w_l_room.php" class="
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_room.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_r_update.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ລາຍການຫ້ອງພັກ</span>
              </a>
            </li>
            <li>
              <a href="w_l_servicecat.php" class="
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_servicecat.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_sc_m.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_meter.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_m_add.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ລາຍການປະເພດການບໍລິການ</span>
              </a>
            </li>
        </ul>
      </li>
      <!-- Shop (Backend)  ---------->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#w_shop_m-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cart-fill"></i><span>ຈັດການຮ້ານເຄັກ</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="w_shop_m-nav" class="nav-content collapse 

          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_dashboard.php")?"show":""; ?>
          
          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_menu_cat.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_mc_add.php")?"show":""; ?>

          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_menu.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_menu_price.php")?"show":""; ?>

          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_me_add.php")?"show":""; ?> 
          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_p_add.php")?"show":""; ?>

          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_customer_cat.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_cc_add.php")?"show":""; ?>

          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_customer.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_c_add.php")?"show":""; ?>

          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_expense_cat.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_ec_add.php")?"show":""; ?>

          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_expense.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_e_add.php")?"show":""; ?>

          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_price_cat.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_pc_add.php")?"show":""; ?>

          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_supplier.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_s_add.php")?"show":""; ?> 
          " data-bs-parent="#sidebar-nav">
            <li>
              <a href="wutb_dashboard.php" class="
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_dashboard.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ສະຫຼຸບຮ້ານເຄັກ</span>
              </a>
            </li>
            <li>
              <a href="wutb_l_expense.php" class="
              
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_expense.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_e_add.php")?"active":""; ?>

              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_expense_cat.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_ec_add.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ລາຍການລາຍຈ່າຍ</span>
              </a>
            </li>

            <li>
              <a href="wutb_l_menu.php" class="
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_menu.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_me_add.php")?"active":""; ?>

              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_menu_cat.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_mc_add.php")?"active":""; ?>

              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_p_add.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_menu_price.php")?"active":""; ?>

              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_price_cat.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_pc_add.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ລາຍການອາຫານ</span>
              </a>
            </li>

            <li>
              <a href="wutb_l_customer.php" class="
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_customer.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_c_add.php")?"active":""; ?>

              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_customer_cat.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "wutb_l_cc_add.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ລາຍການລູກຄ້າ</span>
              </a>
            </li>
            <li>
              <a href="w_l_supplier.php" class="
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_supplier.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_s_add.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ລາຍການຜູ້ສະໜອງ</span>
              </a>
            </li>
        </ul>
      </li> 
      <!-- Other (Backend)  ---------->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#w_other_m-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear-fill"></i><span>ຈັດການອື່ນໆ</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="w_other_m-nav" class="nav-content collapse 

          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_country.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_co_add.php")?"show":""; ?> 

          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_electrict_rate.php")?"show":""; ?> 
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_e_add.php")?"show":""; ?> 

          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_currency.php")?"show":""; ?>
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_cu_add.php")?"show":""; ?> 
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_exchange_rate.php")?"show":""; ?> 
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_ex_add.php")?"show":""; ?> 

          " data-bs-parent="#sidebar-nav">
            
            <li>
              <a href="w_l_currency.php" class="
              
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_currency.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_cu_add.php")?"active":""; ?>
              
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_exchange_rate.php")?"active":""; ?>
              
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_ex_add.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ລາຍການສະກຸນເງິນ</span>
              </a>
            </li>
            <li>
              <a href="w_l_country.php" class="
              
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_country.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_co_add.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ລາຍການປະເທດ</span>
              </a>
            </li>
            <li>
              <a href="w_l_electrict_rate.php" class="
              
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_electrict_rate.php")?"active":""; ?>
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_l_e_add.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ລາຍການຄ່າບໍລິການ</span>
              </a>
            </li>
        </ul>
      </li>
      <!-- Account  ---------->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#w_account-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people-fill"></i><span>ຂໍ້ມູນຂອງຜູ້ໃຊ້ລະບົບ</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
          <ul id="w_account-nav" class="nav-content collapse 
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_account.php")?"show":""; ?> 
          <?php echo (basename($_SERVER['PHP_SELF']) == "w_account_new.php")?"show":""; ?> 
          " data-bs-parent="#sidebar-nav">
            <li>
              <a href="w_account.php" class="
              
              <?php echo (basename($_SERVER['PHP_SELF']) == "w_account.php")?"active":""; ?>

              <?php echo (basename($_SERVER['PHP_SELF']) == "w_account_new.php")?"active":""; ?>
              ">
                <i class="bi bi-circle"></i><span>ຂໍ້ມູນຂອງຜູ້ໃຊ້ລະບົບ</span>
              </a>
            </li>
        </ul>
      </li>
      <?php }?>
    </ul>
  </aside>

