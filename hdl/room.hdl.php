<?php

include "connect.hdl.php";


// >>>> >>>> Reception <<<< <<<<
    // View Room Status based on each room (Reception) --> w_room_main
        $v_reception = mysqli_query($db, "SELECT r1.room_no, r1.r_status, r1.customer_id, r1.remark, r2.fname, r2.lname, r3.start_date, r4.end_date, r5.end_date as last_paid, r5.next_payment, r5.paid_receive_by FROM (SELECT * FROM w_db_room_lobby) as r1 LEFT JOIN (SELECT * FROM w_db_room_customer_info) as r2 ON r1.customer_id = r2.id LEFT JOIN (SELECT * FROM w_db_room_rental WHERE id IN (SELECT MIN(id) FROM w_db_room_rental GROUP BY customer_id)) as r3 ON r1.customer_id = r3.customer_id LEFT JOIN (SELECT * FROM w_db_room_rental WHERE id IN (SELECT MAX(id) FROM w_db_room_rental GROUP BY customer_id)) as r4 ON r1.customer_id = r4.customer_id LEFT JOIN (SELECT * FROM w_db_room_electric WHERE id IN (SELECT MAX(id) FROM w_db_room_electric GROUP BY customer_id)) as r5 ON r1.customer_id = r5.customer_id ORDER BY r1.room_no ASC");
// >>>> >>>> Rental <<<< <<<<
    // View

        $v_rental = mysqli_query($db, "SELECT * FROM w_db_room_rental"); //Not use

    // Add New Customer (Check In) --> w_room_checkin
        if(isset($_POST['new_checkin'])){

            $user_id = $_POST['user_id'];

            // Profile
            $room_no = $_POST['room_no'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $gender = $_POST['gender'];
            $national = $_POST['national'];
            $phone_no = $_POST['phone_no'];
            $p_no = $_POST['p_no'];
            $p_sd = $_POST['p_sd'];
            $p_ed = $_POST['p_ed'];
            $e_su = $_POST['e_su'];
            $checkin_date = $_POST['checkin_date'];

            $date = date("Y-m-d");
            
            // Customer Detail
            $query = "INSERT INTO w_db_room_customer_info (room_no, fname, lname, gender, nationality, phone_no, id_no, id_start_date, id_end_date, create_date, create_by) VALUES ('$room_no', '$fname', '$lname', '$gender','$national', '$phone_no', '$p_no', '$p_sd', '$p_ed', '$date', '$user_id')" ;
            mysqli_query($db, $query);

            $query_2 = mysqli_query($db, "SELECT * FROM w_db_room_customer_info ORDER BY id DESC LIMIT 1");
            $result = mysqli_fetch_array($query_2);
            $customer_id = $result['id'];

            // Room Detail
            mysqli_query($db, "INSERT INTO w_db_room_room_info (customer_id, room_no, checkin_date) VALUES ('$customer_id', '$room_no', '$checkin_date')");

            // Lobby Status
            mysqli_query($db, "UPDATE w_db_room_lobby SET r_status = '1', customer_id = '$customer_id' WHERE id = '$room_no'");

            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');

        }

    // Checkout --> w_room_detail
        if(isset($_GET['checkout_id'])){ 

            $id = $_GET['checkout_id'];
            date_default_timezone_set("Asia/Bangkok");
            $checkout_date = date("Y-m-d");
            $user_id = $_GET['user_id'];
            $room_no = $_GET['room_no'];

            // Deposit
            mysqli_query($db, "UPDATE w_db_room_deposit SET withdraw_date = '$checkout_date', withdraw_by = '$user_id' WHERE customer_id ='$id' AND withdraw_by = ''");

            // Room Status 
            mysqli_query($db, "UPDATE w_db_room_lobby SET r_status = '2' WHERE customer_id = '$id'");

            // Additional db to record check in - out customer in case there 
            mysqli_query($db, "UPDATE w_db_room_room_info SET checkout_date = '$checkout_date' WHERE customer_id = '$id' AND room_no = '$room_no'");

            // Check if there are any pending payment for electrict

            header('location: ../w_room_main.php');

        }
    // Delete rental record
        if(isset($_GET['r_rental_del_id'])){
            $id = $_GET['r_rental_del_id'];
            $room_no = $_GET['room_no'];
            $customer_id = $_GET['customer_id'];

            mysqli_query($db, "DELETE FROM w_db_room_rental where id=$id");
            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');
        }

    // Delete rental record --> w_room_customers
        if(isset($_GET['rental_del_id'])){
            $id = $_GET['rental_del_id'];

            mysqli_query($db, "DELETE FROM w_db_room_customer_info where id=$id");

            mysqli_query($db, "DELETE FROM w_db_room_rental where customer_id=$id");

            mysqli_query($db, "DELETE FROM w_db_room_electric where customer_id=$id");

            mysqli_query($db, "DELETE FROM w_db_room_deposit where customer_id=$id");

            mysqli_query($db, "DELETE FROM w_db_room_note where customer_id=$id");

            header('location: ../w_room_customers.php');
        }
    // New Rental Fee --> w_room_rental
        if(isset($_POST['new_rental'])){
            $user_id = $_POST['user_id'];
            $customer_id = $_POST['customer_id'];
            $room_no = $_POST['room_no'];
            $c_no = $_POST['c_no'];
            $r_sd = $_POST['r_sd'];
            $r_ed = $_POST['r_ed'];
            $remark = $_POST['remark'];
            $paid_amount = str_replace(",", "", $_POST['paid_amount']);
            $currency = $_POST['currency'];
            $date = date("Y-m-d");

            $query_1= mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
            $result = mysqli_fetch_array($query_1);
            $buy_rate = $result['buy_rate'];
            $total_rental =  $paid_amount * $buy_rate;

            $query = "INSERT INTO w_db_room_rental (customer_id, contract_no, start_date, end_date, paid_amount, currency, total_rental, remark, create_date, create_by) VALUES ('$customer_id', '$c_no', '$r_sd', '$r_ed', '$paid_amount', '$currency', '$total_rental', '$remark', '$date', '$user_id')" ;
            mysqli_query($db, $query);

            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');

        }
    // Change Customer Detail --> w_room_checkin
        if(isset($_POST['change_customer_detail'])){

            $user_id = $_POST['user_id'];
            $customer_id = $_POST['customer_id'];
            $room_no = $_POST['room_no'];

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $gender = $_POST['gender'];
            $national = $_POST['national'];
            $phone_no = $_POST['phone_no'];
            $p_no = $_POST['p_no'];
            $p_sd = $_POST['p_sd'];
            $p_ed = $_POST['p_ed'];
            date_default_timezone_set("Asia/Bangkok");
            $edit_date = date("Y-m-d");

            mysqli_query($db, "UPDATE w_db_room_customer_info SET fname = '$fname', lname = '$lname', gender = '$gender', nationality = '$national', phone_no = '$phone_no', id_no = '$p_no', id_start_date = '$p_sd', id_end_date = '$p_ed' WHERE id='$customer_id'");

            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');

        }

// >>>> >>>> Deposit <<<< <<<<
    // View
        $v_deposit = mysqli_query($db, "SELECT * FROM w_db_room_deposit");

    // Add Deposit --> w_room_deposit
        if(isset($_POST['new_deposit'])){
            $room_no = $_POST['room_no'];
            $customer_id = $_POST['customer_id'];
            $amount = str_replace(",", "", $_POST['amount']);
            $currency = $_POST['currency'];
            $remark = $_POST['remark'];
            $user_id = $_POST['user_id'];
            $deposit_date = $_POST['deposit_date'];
            $date = date("Y-m-d");

            $query = "INSERT INTO w_db_room_deposit (customer_id, amount, currency, remark, deposit_date, create_date, create_by) VALUES ('$customer_id','$amount', '$currency', '$remark', '$deposit_date', '$date', '$user_id')" ;
            mysqli_query($db, $query);

            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');

        }
    // Withdraw Deposit --> w_room_detail
        if(isset($_GET['withdraw_deposit_id'])){

            $id = $_GET['withdraw_deposit_id'];
            date_default_timezone_set("Asia/Bangkok");
            $withdraw_date = date("Y-m-d");
            $user_id = $_GET['user_id'];

            $room_no = $_GET['room_no'];
            $customer_id = $_GET['customer_id'];

            mysqli_query($db, "UPDATE w_db_room_deposit SET withdraw_date = '$withdraw_date', withdraw_by = '$user_id' WHERE id='$id'");

            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');

        }  

// >>>> >>>> Cleaning <<<< <<<<
    // Update Cleaning for checkout room --> w_room_clean
        if(isset($_POST['clean_checkout'])){

            $id = $_POST['customer_id'];
            $room_no = $_POST['room_no'];
            $clean_date = $_POST['clean_date'];
            $user_id = $_POST['user_id'];

            mysqli_query($db, "UPDATE w_db_room_lobby SET r_status = '0', customer_id = '' WHERE room_no='$room_no'");

            mysqli_query($db, "UPDATE w_db_room_room_info SET clean_date = '$clean_date' WHERE customer_id='$id' AND room_no ='$room_no'");

            // Record clean after rent end type = 2
            mysqli_query($db, "INSERT INTO w_db_room_clean (type, clean_date, room_no, create_date, create_by) VALUES ('2','$clean_date', '$room_no','$clean_date', '$user_id')");

            header('location: ../w_room_main.php');

        }

    // Comment to cleaning

        if(isset($_POST['clear_cleaning'])){

            $id = $_POST['clean_id'];
            $note = $_POST['note'];
            $user_id = $_POST['user_id'];
            date_default_timezone_set("Asia/Bangkok");
            $response_date = date("Y-m-d");

            mysqli_query($db, "UPDATE w_db_room_clean SET response_note = '$note', response_date = '$response_date', response_by = '$user_id' WHERE id='$id'");

            header('location: ../w_vacant_main.php');

        }

    // Add Cleaning - w_vacant_clean_rec

        if(isset($_POST['new_cleaning'])){
            $user_id = $_POST['user_id'];
            $clean_date = $_POST['date'];
            $clean_by = $_POST['clean_by'];
            $room_no = $_POST['room_no'];
            $type = $_POST['type'];
            $note = $_POST['note'];
            $date = date("Y-m-d");

            $query = "INSERT INTO w_db_room_clean (type, clean_date, clean_by, room_no,  notes, create_date, create_by) VALUES ($type, '$clean_date', '$clean_by', '$room_no', '$note', '$date', '$user_id')" ;
            mysqli_query($db, $query);

            header('location: ../w_vacant_main.php');
        }
    
    // Approve Cleaning

        if(isset($_GET['clean_check_id'])){
            $id = $_GET['clean_check_id'];
            $user_id = $_GET['user_id'];
            $date = $_GET['date'];
            date_default_timezone_set("Asia/Bangkok");
            $check_date = date("Y-m-d");
            mysqli_query($db, "UPDATE w_db_room_clean SET check_by = '$user_id', check_date = '$check_date' WHERE id=$id");
            header('location: ../w_vacant_detail.php?date='.$date.'');
        }   

    // Group View
        $clean_gview = mysqli_query($db, "SELECT r1.clean_date, DATE(r1.clean_date) as group_date, IFNULL(r3.completed,0) as completed, IFNULL(r2.pending, 0) as pending, IFNULL(r4.total, 0) as total FROM 
        (SELECT clean_date, DATE(clean_date) as group_date FROM w_db_room_clean GROUP BY DATE(clean_date)) as r1 LEFT JOIN 
        (SELECT id, DATE(clean_date) as group_date, count(id) as pending FROM w_db_room_clean WHERE check_by = ' ' GROUP BY DATE(clean_date)) as r2 ON r1.group_date = r2.group_date LEFT JOIN 
        (SELECT id, DATE(clean_date) as group_date, count(id) as completed FROM w_db_room_clean WHERE check_by != ' ' GROUP BY DATE(clean_date)) as r3 ON r1.group_date = r3.group_date LEFT JOIN 
        (SELECT id, DATE(clean_date) as group_date, count(id) as total FROM w_db_room_clean GROUP BY DATE(clean_date)) as r4 ON r1.group_date = r4.group_date ORDER BY group_date DESC");
    // Delete Cleaning Record
        if(isset($_GET['clean_del_id'])){
            $id = $_GET['clean_del_id'];
            $date = $_GET['date'];
            mysqli_query($db, "DELETE FROM w_db_room_clean WHERE id=$id");
            header('location: ../w_vacant_detail.php?date='.$date.'');
        }



// >>>> >>>> Status <<<< <<<<
    // View Room Status
        $room_view = mysqli_query($db, "SELECT * FROM w_db_room_lobby"); // duplicate
    // View empty Room to Change
        $avaiable_room = mysqli_query($db, "SELECT * FROM w_db_room_lobby WHERE r_status = '0'");
    // View Room Available for cleaning and putting item in --> w_vacant_clean_rec
        $v_open_room = mysqli_query($db, "SELECT * FROM w_db_room_lobby WHERE r_status = ''");
// >>>> >>>> Air Condition <<<< <<<<
    // View

        $v_air_clean = mysqli_query($db, "SELECT * FROM w_db_room_clean WHERE type = 4");

// >>>> >>>> National <<<< <<<<     
    // View 

        $national_view = mysqli_query($db, "SELECT * FROM w_db_list_country");

// >>>> >>>> Item <<<< <<<< 
    // View
        $item_view = mysqli_query($db, "SELECT * FROM w_db_list_item ORDER BY cat_id DESC");
    // View Item Request

        $request_view = mysqli_query($db, "SELECT i1.id as id, i1.cat_id, i1.item_en as item_en, i1.item_la as item_la, ifnull(i2.p_u, 0) as u_purchase, ifnull(i3.r_u, 0) as u_return , ifnull(i4.add_u, 0) as u_add , ifnull(i5.d_u, 0) as u_dispose, (ifnull(i2.p_u, 0) + ifnull(i3.r_u, 0)) - (ifnull(i4.add_u, 0) + ifnull(i5.d_u, 0)) as total FROM (SELECT * FROM w_db_list_item) as i1 LEFT JOIN (SELECT item_id, sum(unit) as p_u FROM w_db_stock WHERE cat_id = 1 GROUP BY item_id) as i2 ON i1.id = i2.item_id LEFT JOIN (SELECT item_id, sum(unit) as r_u FROM w_db_stock WHERE cat_id = 2 GROUP BY item_id) as i3 ON i1.id = i3.item_id LEFT JOIN (SELECT item_id, sum(unit) as add_u FROM w_db_stock WHERE cat_id = 5 GROUP BY item_id) as i4 ON i1.id = i4.item_id LEFT JOIN (SELECT item_id, sum(unit) as d_u FROM w_db_stock WHERE cat_id = 4 GROUP BY item_id) as i5 ON i1.id = i5.item_id WHERE (ifnull(i2.p_u, 0) + ifnull(i3.r_u, 0)) - (ifnull(i4.add_u, 0) + ifnull(i5.d_u, 0)) > 0 ORDER BY i1.cat_id ASC");

    // Return
        $return_view = mysqli_query($db, "SELECT * FROM w_db_stock WHERE cat_id = 5");
    // Request new item for room --> w_room_item_req
        if(isset($_POST['item_request'])){
            $cat_id = 3;
            $item_id = $_POST['item_id'];
            $unit = $_POST['unit'];
            $customer_id = $_POST['customer_id'];
            $room_no = $_POST['room_no'];
            $user_id = $_POST['user_id'];
            $date = date("Y-m-d");
            $remark = $_POST['remark'];

            mysqli_query($db, "INSERT INTO w_db_stock (cat_id, customer_id, room_no, item_id, unit, notes, create_date, create_by) VALUES ('$cat_id', '$customer_id', '$room_no','$item_id', '$unit', '$remark', '$date', '$user_id')" );

            $query_1 = mysqli_query($db, "SELECT * FROM w_db_stock WHERE id IN (SELECT MAX(id) FROM w_db_stock WHERE customer_id = $customer_id AND room_no =$room_no)");
            $result = mysqli_fetch_array($query_1);
            $id = $result['id'];

            mysqli_query($db, "INSERT INTO w_db_room_item (ref_stock_id, cat_id, item_id, room_no, unit, create_by) VALUES ('$id', '2', '$item_id', '$room_no', '$unit', '$user_id')");

            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');

        }

    // Return Item --> w_room_item_return
        if(isset($_POST['item_return'])){

            $customer_id = $_POST['customer_id'];
            $room_no = $_POST['room_no'];
            $user_id = $_POST['user_id'];
            $item_id = $_POST['item_id'];
            $unit = $_POST['unit'];
            $cat_id = 2;
            $date = date("Y-m-d");
            $remark = $_POST['remark'];

            mysqli_query($db, "INSERT INTO w_db_stock (cat_id, customer_id, room_no, item_id, unit, notes, create_date, create_by) VALUES ('$cat_id', '$customer_id', '$room_no', '$item_id', '$unit', '$remark', '$date', '$user_id')" );

            $query_1 = mysqli_query($db, "SELECT * FROM w_db_stock WHERE id IN (SELECT MAX(id) FROM w_db_stock WHERE customer_id = $customer_id AND room_no =$room_no)");
            $result = mysqli_fetch_array($query_1);
            $id = $result['id'];

            mysqli_query($db, "INSERT INTO w_db_room_item (ref_stock_id, cat_id, item_id, room_no, unit, create_by) VALUES ('$id','3', '$item_id', '$room_no', '$unit', '$user_id')");

            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');
        }

// >>>> >>>> Account <<<< <<<< 
    // Staff Account
        $staff_view = mysqli_query($db, "SELECT * FROM w_db_account WHERE role_id = 1 AND status = 1");

// >>>> >>>> Electric <<<< <<<< 
    // Start electric
        if(isset($_POST['start_electrict'])){
            
        $user_id = $_POST['user_id'];
        $customer_id = $_POST['customer_id'];
        $room_no = $_POST['room_no'];
        $start_unit = $_POST['start_unit'];
        $e_date = $_POST['e_date'];

        mysqli_query($db, "UPDATE w_db_room_room_info SET e_date = '$e_date', e_unit = '$start_unit' WHERE customer_id = $customer_id");

        header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');
    }

    // New Electric --> w_room_electric
        if(isset($_POST['new_electric'])){
            $user_id = $_POST['user_id'];
            $customer_id = $_POST['customer_id'];
            $room_no = $_POST['room_no'];
            $ref_no = $_POST['ref_no'];
            $e_sd = $_POST['e_sd']; //Current Start Date
            $e_ed = $_POST['e_ed']; // Current End Date
            $e_ed_f = strtotime($e_ed); //Current End Date formatted
            $a_u = $_POST['a_u']; // Current Actual Unit
            $remark = $_POST['remark'];
            $currency = 1;
            $date = date("Y-m-d");

            // Check Last Electrict
            
            $query_1 = mysqli_query($db, "SELECT r1.customer_id as customer_id, r1.room_no as room_no, r1.checkin_date as checkin_date, r1.e_unit as checkin_unit, r2.end_date as last_date, r2.actual_unit as last_unit  FROM 
            (SELECT * FROM w_db_room_room_info WHERE id IN (SELECT MAX(id) FROM w_db_room_room_info WHERE customer_id =  $customer_id AND room_no = $room_no)) as r1 LEFT JOIN 
            (SELECT * FROM w_db_room_electric WHERE id IN (SELECT MAX(id) FROM w_db_room_electric WHERE customer_id =  $customer_id AND room_no = $room_no)) as r2 ON r1.customer_id = r2.customer_id ");
            $result_1 = mysqli_fetch_array($query_1);

            $query_2 = mysqli_query($db, "SELECT * FROM w_db_list_electrict_rate WHERE id IN (SELECT max(id) FROM w_db_list_electrict_rate)");
            $result_2 = mysqli_fetch_array($query_2);

            // 1st Check:
                $last_unit = $result_1['last_unit'];
                
            // Date
                // GET Check In date 
                    $checkin_date = $result_1['checkin_date']; // Get Date
                    $checkin_date_f= strtotime($checkin_date);

                    $checkin_d = date("d",  $checkin_date_f); 

                // Get Current End Date Month
                    $e_ed_m = date("m", strtotime($e_ed_f));

                // Forecast 1: Add 1 month to Current Payment Date
                    $nextpay_1 = date("Y-m-d", strtotime("+1 month", $e_ed_f));
                    $np_1_d = date("d", strtotime($nextpay_1)); 
                    $np_1_m = date("m", strtotime($nextpay_1));
                    $np_1_y = date("Y", strtotime($nextpay_1));

                // Check No of Days in Forecasts
                    $count_date_nm = cal_days_in_month(CAL_GREGORIAN,$np_1_m, $np_1_y);

                // Combine Check In Date (d) and 1 month added to Current Payment Date (m, y)
                    $combined_1 = strftime("%F", strtotime($checkin_d."-".$np_1_m."-".$np_1_y));    

                // Forecast 2: Select last date if next month
                    $nextpay_2 = date("Y-m-d", strtotime("last day of +1 month", $e_ed_f));

                // 2nd Check: Compare forcast with 1 mont added (m) - current pay (m)
                    $compare = $np_1_m - $e_ed_m;    

                // Checkin Unit
                    $rate = $result_2['rate'];
                    $checkin_unit = $result_1['checkin_unit']; // Get Unit
                    $checkin_result_1 = $a_u - $checkin_unit;
                    $amount_1 = $checkin_result_1 * $rate;

                // Last Unit
                    $last_unit = $result_1['last_unit']; // Get Unit
                    $last_result_1 = $a_u - $last_unit;
                    $amount_2 = $last_result_1 * $rate;

            if(empty($last_unit)){ 
                if($compare == 1) {
                    if($checkin_d <= $count_date_nm) {
                        mysqli_query($db,"INSERT INTO w_db_room_electric(customer_id, room_no, ref_no, start_date, end_date, next_payment, actual_unit, unit_used, actual_amount, currency, total_electric, remark, create_date, create_by) VALUES ('$customer_id', '$room_no', '$ref_no', '$e_sd', '$e_ed', '$combined_1', '$a_u', '$checkin_result_1', '$amount_1', '$currency', '$amount_1', '$remark', '$date', '$user_id')") ;
                    } else {
                        mysqli_query($db,"INSERT INTO w_db_room_electric(customer_id, room_no, ref_no, start_date, end_date, next_payment, actual_unit, unit_used, actual_amount, currency, total_electric, remark, create_date, create_by) VALUES ('$customer_id', '$room_no', '$ref_no', '$e_sd', '$e_ed', '$nextpay_2', '$a_u', '$checkin_result_1', '$amount_1', '$currency', '$amount_1', '$remark', '$date', '$user_id')") ;
                    }
                } else {
                    if($checkin_d <= $count_date_nm) {
                        mysqli_query($db,"INSERT INTO w_db_room_electric(customer_id, room_no, ref_no, start_date, end_date, next_payment, actual_unit, unit_used, actual_amount, currency, total_electric, remark, create_date, create_by) VALUES ('$customer_id', '$room_no', '$ref_no', '$e_sd', '$e_ed', '$combined_1', '$a_u', '$checkin_result_1', '$amount_1', '$currency', '$amount_1', '$remark', '$date', '$user_id')") ;
                    } else {
                        mysqli_query($db,"INSERT INTO w_db_room_electric(customer_id, room_no, ref_no, start_date, end_date, next_payment, actual_unit, unit_used, actual_amount, currency, total_electric, remark, create_date, create_by) VALUES ('$customer_id', '$room_no', '$ref_no', '$e_sd', '$e_ed', '$nextpay_2', '$a_u', '$checkin_result_1', '$amount_1', '$currency', '$amount_1', '$remark', '$date', '$user_id')") ;
                    }
                }
            } else {
                if($compare == 1) {
                    if($checkin_d <= $count_date_nm) {
                        mysqli_query($db,"INSERT INTO w_db_room_electric(customer_id, room_no, ref_no, start_date, end_date, next_payment, actual_unit, unit_used, actual_amount, currency, total_electric, remark, create_date, create_by) VALUES ('$customer_id', '$room_no', '$ref_no', '$e_sd', '$e_ed', '$combined_1', '$a_u', '$last_result_1', '$amount_2', '$currency', '$amount_2', '$remark', '$date', '$user_id')") ;
                    } else {
                        mysqli_query($db,"INSERT INTO w_db_room_electric(customer_id, room_no, ref_no, start_date, end_date, next_payment, actual_unit, unit_used, actual_amount, currency, total_electric, remark, create_date, create_by) VALUES ('$customer_id', '$room_no', '$ref_no', '$e_sd', '$e_ed', '$nextpay_2', '$a_u', '$last_result_1', '$amount_2', '$currency', '$amount_2', '$remark', '$date', '$user_id')") ;
                    }
                } else {
                    if($checkin_d <= $count_date_nm) {
                        mysqli_query($db,"INSERT INTO w_db_room_electric(customer_id, room_no, ref_no, start_date, end_date, next_payment, actual_unit, unit_used, actual_amount, currency, total_electric, remark, create_date, create_by) VALUES ('$customer_id', '$room_no', '$ref_no', '$e_sd', '$e_ed', '$combined_1', '$a_u', '$last_result_1', '$amount_2', '$currency', '$amount_2', '$remark', '$date', '$user_id')") ;
                    } else {
                        mysqli_query($db,"INSERT INTO w_db_room_electric(customer_id, room_no, ref_no, start_date, end_date, next_payment, actual_unit, unit_used, actual_amount, currency, total_electric, remark, create_date, create_by) VALUES ('$customer_id', '$room_no', '$ref_no', '$e_sd', '$e_ed', '$nextpay_2', '$a_u', '$last_result_1', '$amount_2', '$currency', '$amount_2', '$remark', '$date', '$user_id')") ;
                    }
                }
            }
            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');
        }
    // Electric Payment Received
        if(isset($_GET['a_electric_id'])){

            $id = $_GET['a_electric_id'];
            date_default_timezone_set("Asia/Bangkok");
            $paid_date = date("Y-m-d");
            $user_id = $_GET['user_id'];  
            $room_no = $_GET['room_no'];
            $customer_id = $_GET['customer_id'];

            mysqli_query($db, "UPDATE w_db_room_electric SET paid_receive_date = '$paid_date', paid_receive_by = '$user_id' WHERE id='$id'");

            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');

        }

    // Delete electric record
        if(isset($_GET['r_electric_del_id'])){
            $id = $_GET['r_electric_del_id'];
            $room_no = $_GET['room_no'];
            $customer_id = $_GET['customer_id'];
            

            mysqli_query($db, "DELETE FROM w_db_room_electric where id=$id");
            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');
        }

// >>>> >>>> Note <<<< <<<< 
    // Add new note --> w_room_note
        if(isset($_POST['new_note'])){
            $remind = $_POST['remind'];
            $r_d = $_POST['r_d'];
            $note = $_POST['note'];
            $customer_id = $_POST['customer_id'];
            $room_no = $_POST['room_no'];
            $user_id = $_POST['user_id'];
            $date = date("Y-m-d");

            $query = "INSERT INTO w_db_room_note(customer_id, remind, remind_date, notes, create_date, create_by) VALUES ('$customer_id', '$remind', '$r_d', '$note', '$date', '$user_id')" ;
            mysqli_query($db, $query);

            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');

        }

    // Delete note
        if(isset($_GET['note_del_id'])){
            $id = $_GET['note_del_id'];
            $room_no = $_GET['room_no'];
            $customer_id = $_GET['customer_id'];

            mysqli_query($db, "DELETE FROM w_db_room_note WHERE id=$id");
            header('location: ../w_room_detail.php?room_no='.$room_no.'&customer_id='.$customer_id.'');
        }

// >>>> >>>> Meter <<<< <<<< 
    // Delete Meter
        if(isset($_GET['meter_del_id'])){
            $id = $_GET['meter_del_id'];
            mysqli_query($db, "DELETE FROM w_db_list_meter WHERE id=$id");
            header('location: ../w_a_meter.php');
        }

// >>>> >>>> Room <<<< <<<< 
    // Update room status for own using room
        if(isset($_POST['new_status'])){

            $id = $_POST['id'];
            $r_status = $_POST['r_status'];
            $remark = $_POST['remark'];

            mysqli_query($db, "UPDATE w_db_room_lobby SET r_status = '$r_status', remark = '$remark' WHERE id='$id'");

            header('location: ../w_l_room.php');

        }

    // Move existing customer to another room --> w_room_switch
        if(isset($_POST['new_move'])){

            $room_no = $_POST['room_no'];   
            $customer_id = $_POST['customer_id'];
            $new_room = $_POST['new_room'];
            $new_e_unit = $_POST['new_e_unit'];
            $move_date = $_POST['move_date'];
            $date = date("Y-m-d");
            $user_id = $_POST['user_id'];

            //Change Room Status 
                mysqli_query($db, "UPDATE w_db_room_lobby SET r_status = '2' WHERE id = '$room_no'");

                mysqli_query($db, "UPDATE w_db_room_lobby SET r_status = '1', customer_id = '$customer_id' WHERE id = '$new_room'");

            // Update room no in Customer data
                mysqli_query($db, "UPDATE w_db_room_customer_info SET room_no = '$new_room' WHERE id = '$customer_id'");

            // Update room no in Customer db   
                mysqli_query($db, "UPDATE w_db_room_room_info SET checkout_date = '$move_date' WHERE customer_id = '$customer_id' AND room_no = '$room_no'");

                mysqli_query($db, "INSERT INTO w_db_room_room_info (customer_id, room_no, e_date, e_unit, checkin_date) VALUES ('$customer_id', '$new_room', '$move_date', '$new_e_unit' , '$move_date')");

                header('location: ../w_room_detail.php?room_no='.$new_room.'&customer_id='.$customer_id.'');

        }

// ++++ ++++ ++++ ++++ New Air Condition Cleaning ++++ ++++ ++++ ++++

    // Approval all
    if(isset($_GET['approve_all_rec'])){
        $rec_date = $_GET['approve_all_rec'];
        $user_id = $_GET['user_id'];
        $date = date("Y-m-d");

        mysqli_query($db, "UPDATE w_db_room_clean SET check_by = '$user_id', check_date = '$date' WHERE clean_date = '$rec_date' AND check_by = ' '");

            header('location: ../w_vacant_detail.php?date='.$rec_date.'');

    }