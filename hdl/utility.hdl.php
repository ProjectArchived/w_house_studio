<?php

include "connect.hdl.php";

    // Check total, complete and pending bill approval
        $bill_gview = mysqli_query($db, "SELECT r1.year, r1.month, IFNULL(r3.completed,0) as completed, IFNULL(r2.pending, 0) as pending, IFNULL(r4.total, 0) as total FROM (SELECT year, month FROM w_db_utility GROUP BY year DESC, month DESC) as r1 LEFT JOIN (SELECT id, year, month, count(id) as pending FROM w_db_utility WHERE check_by = ' ' GROUP BY year DESC, month DESC) as r2 ON r1.year = r2.year AND r1.month = r2.month LEFT JOIN (SELECT id, year, month, count(id) as completed FROM w_db_utility WHERE check_by != ' ' GROUP BY year DESC, month DESC) as r3 ON r1.year = r3.year AND r1.month = r3.month LEFT JOIN (SELECT id, year, month, count(id) as total FROM w_db_utility GROUP BY year DESC, month DESC) as r4 ON r1.year = r4.year AND r1.month = r4.month");

// >>>> >>>> Electric <<<< <<<<
    // View Meter --> w_utility_electric
        $utility_emeter = mysqli_query($db, "SELECT * FROM w_db_list_meter WHERE cat_id = 1");
    
    // Add --> w_utility_electric
        if(isset($_POST['utility_electric'])){
            $ref_no = $_POST['ref_no'];
            $cat_id = 1;
            $meter_id = $_POST['meter_id'];
            $year = $_POST['year'];
            $month = $_POST['month'];
            $s_unit = $_POST['s_unit'];
            $e_unit = $_POST['e_unit'];
            $t_unit = $_POST['t_unit'];
            $amount = str_replace(",", "", $_POST['amount']);
            $per_unit = $amount / $t_unit;
            $currency = 1;
            $remark = $_POST['remark'];
            $paid_date = $_POST['paid_date'];
            $user_id = $_POST['user_id'];
            $t_unit_a = $e_unit - $s_unit;
            $date = date("Y-m-d");
        
            $query = "INSERT INTO w_db_utility (ref_no, cat_id, meter_id, year, month, s_unit, e_unit, t_unit, t_unit_a, amount, currency, total_bill, per_unit, remark, paid_date, create_date, create_by) VALUES ('$ref_no', '$cat_id', '$meter_id', '$year','$month', '$s_unit', '$e_unit', '$t_unit','$t_unit_a', '$amount', '$currency', '$amount', '$per_unit', '$remark','$paid_date', '$date', '$user_id')" ;
            mysqli_query($db, $query);
            header('location: ../w_utility_main.php');
        }

    // Remove
        if(isset($_GET['utility_del_id'])){
            $id = $_GET['utility_del_id'];
            $year = $_GET['year'];
            $month = $_GET['month'];
            mysqli_query($db, "DELETE FROM w_db_utility where id=$id");
            header('location: ../w_utility_detail.php?year='.$year.'&month='.$month.'');
        } 

// >>>> >>>> Water <<<< <<<<
    // View Meter
        $utility_wmeter = mysqli_query($db, "SELECT * FROM w_db_list_meter WHERE cat_id = 2");

    // Add
        if(isset($_POST['utility_water'])){
            $ref_no = $_POST['ref_no'];
            $cat_id = 2;
            $meter_id = $_POST['meter_id'];
            $year = $_POST['year'];
            $month = $_POST['month'];
            $s_unit = $_POST['s_unit'];
            $e_unit = $_POST['e_unit'];
            $t_unit = $_POST['t_unit'];
            $amount = str_replace(",", "", $_POST['amount']);
            $currency = 1;
            $remark = $_POST['remark'];
            $paid_date = $_POST['paid_date'];
            $user_id = $_POST['user_id'];
            $t_unit_a = $e_unit - $s_unit;
            $date = date("Y-m-d");

            $query = "INSERT INTO w_db_utility (ref_no, cat_id, meter_id, year, month, s_unit, e_unit, t_unit, t_unit_a, amount, currency, total_bill, remark, paid_date, create_date, create_by) VALUES ('$ref_no', '$cat_id', '$meter_id', '$year','$month', '$s_unit', '$e_unit', '$t_unit', '$t_unit_a', '$amount', '$currency', '$amount',  '$remark','$paid_date', '$date', '$user_id')" ;
            mysqli_query($db, $query);
            header('location: ../w_utility_main.php');

        }

// >>>> >>>> Internet <<<< <<<<
    // View
        $utility_imeter = mysqli_query($db, "SELECT * FROM w_db_list_meter WHERE cat_id = 3");

    // Add
        if(isset($_POST['utility_internet'])){
            $ref_no = $_POST['ref_no'];
            $cat_id = 3;
            $year = $_POST['year'];
            $month = $_POST['month'];
            $meter_id = $_POST['meter_id'];
            $amount = str_replace(",", "", $_POST['amount']);
            $currency = 1;
            $remark = $_POST['remark'];
            $paid_date = $_POST['paid_date'];
            $user_id = $_POST['user_id'];
            $date = date("Y-m-d");

            $query = "INSERT INTO w_db_utility (ref_no, cat_id, meter_id, year, month,amount, currency, total_bill, remark, paid_date, create_date, create_by) VALUES ('$ref_no', '$cat_id', '$meter_id', '$year','$month', '$amount', '$currency', '$amount', '$remark','$paid_date', '$date','$user_id')" ;
            mysqli_query($db, $query);
            header('location: ../w_utility_main.php');

        }
    // Check
        if(isset($_GET['utility_check_id'])){
            $id = $_GET['utility_check_id'];
            $year = $_GET['year'];
            $month = $_GET['month'];
            $user_id = $_GET['user_id'];
            date_default_timezone_set("Asia/Bangkok");
            $check_date = date("Y-m-d");
            mysqli_query($db, "UPDATE w_db_utility SET check_by = '$user_id', check_date = '$check_date' WHERE id=$id");
            header('location: ../w_utility_detail.php?year='.$year.'&month='.$month.'');
        }   


// >>>> >>>> Garbage <<<< <<<<
    // Add
        if(isset($_POST['utility_garbage'])){
            $ref_no = $_POST['ref_no'];
            $cat_id = 4;
            $year = $_POST['year'];
            $month = $_POST['month'];
            $amount = str_replace(",", "", $_POST['amount']);
            $currency = 1;
            $remark = $_POST['remark'];
            $paid_date = $_POST['paid_date'];
            $user_id = $_POST['user_id'];
            $date = date("Y-m-d");

            $query = "INSERT INTO w_db_utility (ref_no, cat_id, year, month, amount, currency, total_bill, remark, paid_date, create_date, create_by) VALUES ('$ref_no', '$cat_id', '$year','$month', '$amount', '$currency', '$amount',  '$remark','$paid_date', '$date', '$user_id')" ;
            mysqli_query($db, $query);
            header('location: ../w_utility_main.php');

        }

// >>>> >>>> Garbage <<<< <<<<
    // Add
        if(isset($_POST['utility_others'])){
            $ref_no = $_POST['ref_no'];
            $cat_id = 5;
            $year = $_POST['year'];
            $month = $_POST['month'];
            $amount = str_replace(",", "", $_POST['amount']);
            $currency = 1;
            $remark = $_POST['remark'];
            $paid_date = $_POST['paid_date'];
            $user_id = $_POST['user_id'];
            $date = date("Y-m-d");

            $query = "INSERT INTO w_db_utility (ref_no, cat_id, year, month, amount, currency, total_bill, remark, paid_date, create_date, create_by) VALUES ('$ref_no', '$cat_id', '$year','$month', '$amount', '$currency', '$amount',  '$remark','$paid_date', '$date', '$user_id')" ;
            mysqli_query($db, $query);
            header('location: ../w_utility_main.php');

        }

    // Approval all
        if(isset($_GET['approve_all_rec'])){
            $rec_month = $_GET['approve_all_rec'];
            $rec_year = $_GET['year'];
            $user_id = $_GET['user_id'];
            $date = date("Y-m-d");

            mysqli_query($db, "UPDATE w_db_utility SET check_by = '$user_id', check_date = '$date' WHERE year = '$rec_year' AND month = '$rec_month' AND check_by = ' '");

                header('location: ../w_utility_detail.php?year='.$rec_year.'&month='.$rec_month.'');

        }

    // Utility Rate View
        $e_rate_view = mysqli_query($db, "SELECT * FROM w_db_list_electrict_rate");


        if(isset($_POST['new_e_rate'])){
    
            $date = $_POST['date'];
            $cat_id = $_POST['cat_id'];
            $rate = $_POST['rate'];

            $query = "INSERT INTO w_db_list_electrict_rate (cat_id, rate,create_date) VALUES ('$cat_id', '$rate', '$date')" ;
            mysqli_query($db, $query);

            header('location: ../w_l_electrict_rate.php');

        }

        if(isset($_GET['electrict_del_id'])){
            $id = $_GET['electrict_del_id'];
            mysqli_query($db, "DELETE FROM w_db_list_electrict_rate WHERE id=$id");
            header('location: ../w_l_electrict_rate.php');
        } 

        if(isset($_POST['edit_electrict_rate'])){
            $id = $_POST['id'];
            $date = $_POST['date'];
            $cat_id = $_POST['cat_id'];
            $rate = $_POST['rate'];

            mysqli_query($db, "UPDATE w_db_list_electrict_rate SET cat_id = '$cat_id', rate = '$rate' WHERE id = '$id'");

            header('location: ../w_l_electrict_rate.php');

        }
