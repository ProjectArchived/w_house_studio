<?php

include "connect.hdl.php";

// >>>> >>>> Item <<<< <<<<
    // View
        $item_view = mysqli_query($db, "SELECT * FROM w_db_list_item ORDER BY cat_id ASC");

// >>>> >>>> Stock <<<< <<<<
    // View
        $stock_view = mysqli_query($db, "SELECT * FROM w_db_stock ORDER BY check_by != '', id DESC");
    // View Group
        $stock_view_group = mysqli_query($db, "SELECT r1.create_date, DATE(r1.create_date) as group_date, IFNULL(r3.completed,0) as completed, IFNULL(r2.pending, 0) as pending, IFNULL(r4.total, 0) as total FROM (SELECT create_date, DATE(create_date) as group_date FROM w_db_stock GROUP BY DATE(create_date)) as r1 LEFT JOIN (SELECT id, DATE(create_date) as group_date, count(id) as pending FROM w_db_stock WHERE check_by = ' ' GROUP BY DATE(create_date)) as r2 ON r1.group_date = r2.group_date LEFT JOIN (SELECT id, DATE(create_date) as group_date, count(id) as completed FROM w_db_stock WHERE check_by != ' ' GROUP BY DATE(create_date)) as r3 ON r1.group_date = r3.group_date LEFT JOIN (SELECT id, DATE(create_date) as group_date, count(id) as total FROM w_db_stock GROUP BY DATE(create_date)) as r4 ON r1.group_date = r4.group_date ORDER BY group_date DESC");
    // View Stock Summary
        $stock_sum_view = mysqli_query($db, "SELECT i1.id as id, i1.cat_id, i1.item_en as item_e, i1.item_la as item_l, ifnull(i2.p_u, 0) as u_purchase, ifnull(i3.r_u, 0) as u_return , ifnull(i4.add_u, 0) as u_add , ifnull(i5.d_u, 0) as u_dispose, (ifnull(i2.p_u, 0) + ifnull(i3.r_u, 0)) - (ifnull(i4.add_u, 0) + ifnull(i5.d_u, 0)) as total FROM (SELECT * FROM w_db_list_item) as i1 LEFT JOIN (SELECT item_id, sum(unit) as p_u FROM w_db_stock WHERE cat_id = 1 GROUP BY item_id) as i2 ON i1.id = i2.item_id LEFT JOIN (SELECT item_id, sum(unit) as r_u FROM w_db_stock WHERE cat_id = 2 GROUP BY item_id) as i3 ON i1.id = i3.item_id LEFT JOIN (SELECT item_id, sum(unit) as add_u FROM w_db_stock WHERE cat_id = 5 GROUP BY item_id) as i4 ON i1.id = i4.item_id LEFT JOIN (SELECT item_id, sum(unit) as d_u FROM w_db_stock WHERE cat_id = 4 GROUP BY item_id) as i5 ON i1.id = i5.item_id ORDER BY i1.cat_id ASC");

    // Remove
        if(isset($_GET['stock_del_id'])){
            $id = $_GET['stock_del_id'];
            $date = $_GET['date'];
            mysqli_query($db, "DELETE FROM w_db_stock where id=$id");
            header('location: ../w_stock_detail.php?date='.$date.'');
        }


    // Check
        if(isset($_GET['stock_check_id'])){
            $id = $_GET['stock_check_id'];
            $user_id = $_GET['user_id'];
            date_default_timezone_set("Asia/Bangkok");
            $check_date = date("Y-m-d");
            $date = $_GET['date'];
            mysqli_query($db, "UPDATE w_db_stock SET check_by = '$user_id', check_date = '$check_date' WHERE id=$id");
            header('location: ../w_stock_detail.php?date='.$date.'');
        }   
// >>>> >>>> Item <<<< <<<<

    // View Disposal --> w_stock_dispose
        $dispose_view = mysqli_query($db, "SELECT i1.id as id, i1.cat_id, i1.item_en as item_en, i1.item_la as item_la, ifnull(i2.p_u, 0) as u_purchase, ifnull(i3.r_u, 0) as u_return , ifnull(i4.add_u, 0) as u_add , ifnull(i5.d_u, 0) as u_dispose, (ifnull(i2.p_u, 0) + ifnull(i3.r_u, 0)) - (ifnull(i4.add_u, 0) + ifnull(i5.d_u, 0)) as total FROM (SELECT * FROM w_db_list_item) as i1 LEFT JOIN (SELECT item_id, sum(unit) as p_u FROM w_db_stock WHERE cat_id = 1 GROUP BY item_id) as i2 ON i1.id = i2.item_id LEFT JOIN (SELECT item_id, sum(unit) as r_u FROM w_db_stock WHERE cat_id = 2 GROUP BY item_id) as i3 ON i1.id = i3.item_id LEFT JOIN (SELECT item_id, sum(unit) as add_u FROM w_db_stock WHERE cat_id = 5 GROUP BY item_id) as i4 ON i1.id = i4.item_id LEFT JOIN (SELECT item_id, sum(unit) as d_u FROM w_db_stock WHERE cat_id = 4 GROUP BY item_id) as i5 ON i1.id = i5.item_id WHERE (ifnull(i2.p_u, 0) + ifnull(i3.r_u, 0)) - (ifnull(i4.add_u, 0) + ifnull(i5.d_u, 0)) > 0 ORDER BY i1.cat_id ASC");

    // Item Usage -->w_vacant_item_sum
        $room_item = mysqli_query($db, "SELECT  r1.item_la as item_la, r1.cat_id as cat_id, r1.s_unit as base_unit, 
        (ifnull(r101_1.unit,0) + ifnull(r101_2.total,0)) - ifnull(r101_3.total,0) as r101,
        (ifnull(r102_1.unit,0) + ifnull(r102_2.total,0)) - ifnull(r102_3.total,0) as r102,
        (ifnull(r103_1.unit,0) + ifnull(r103_2.total,0)) - ifnull(r103_3.total,0) as r103,
        (ifnull(r104_1.unit,0) + ifnull(r104_2.total,0)) - ifnull(r104_3.total,0) as r104,
        (ifnull(r105_1.unit,0) + ifnull(r105_2.total,0)) - ifnull(r105_3.total,0) as r105,
        (ifnull(r106_1.unit,0) + ifnull(r106_2.total,0)) - ifnull(r106_3.total,0) as r106,
        (ifnull(r201_1.unit,0) + ifnull(r201_2.total,0)) - ifnull(r201_3.total,0) as r201,
        (ifnull(r202_1.unit,0) + ifnull(r202_2.total,0)) - ifnull(r202_3.total,0) as r202,
        (ifnull(r203_1.unit,0) + ifnull(r203_2.total,0)) - ifnull(r203_3.total,0) as r203,
        (ifnull(r204_1.unit,0) + ifnull(r204_2.total,0)) - ifnull(r204_3.total,0) as r204,
        (ifnull(r205_1.unit,0) + ifnull(r205_2.total,0)) - ifnull(r205_3.total,0) as r205,
        (ifnull(r206_1.unit,0) + ifnull(r206_2.total,0)) - ifnull(r206_3.total,0) as r206
        
        FROM 
        
        (SELECT * FROM w_db_list_item WHERE room_use = 1) as r1 LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 101 AND cat_id = 1) as r101_1 ON r1.id = r101_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 101 AND cat_id = 2 GROUP BY item_id) as r101_2 ON r1.id = r101_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 101 AND cat_id = 3 GROUP BY item_id) as r101_3 ON r1.id = r101_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 102 AND cat_id = 1) as r102_1 ON r1.id = r102_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 102 AND cat_id = 2 GROUP BY item_id) as r102_2 ON r1.id = r102_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 102 AND cat_id = 3 GROUP BY item_id) as r102_3 ON r1.id = r102_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 103 AND cat_id = 1) as r103_1 ON r1.id = r103_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 103 AND cat_id = 2 GROUP BY item_id) as r103_2 ON r1.id = r103_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 103 AND cat_id = 3 GROUP BY item_id) as r103_3 ON r1.id = r103_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 104 AND cat_id = 1) as r104_1 ON r1.id = r104_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 104 AND cat_id = 2 GROUP BY item_id) as r104_2 ON r1.id = r104_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 104 AND cat_id = 3 GROUP BY item_id) as r104_3 ON r1.id = r104_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 105 AND cat_id = 1) as r105_1 ON r1.id = r105_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 105 AND cat_id = 2 GROUP BY item_id) as r105_2 ON r1.id = r105_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 105 AND cat_id = 3 GROUP BY item_id) as r105_3 ON r1.id = r105_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 106 AND cat_id = 1) as r106_1 ON r1.id = r106_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 106 AND cat_id = 2 GROUP BY item_id) as r106_2 ON r1.id = r106_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 106 AND cat_id = 3 GROUP BY item_id) as r106_3 ON r1.id = r106_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 201 AND cat_id = 1) as r201_1 ON r1.id = r201_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 201 AND cat_id = 2 GROUP BY item_id) as r201_2 ON r1.id = r201_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 201 AND cat_id = 3 GROUP BY item_id) as r201_3 ON r1.id = r201_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 202 AND cat_id = 1) as r202_1 ON r1.id = r202_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 202 AND cat_id = 2 GROUP BY item_id) as r202_2 ON r1.id = r202_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 202 AND cat_id = 3 GROUP BY item_id) as r202_3 ON r1.id = r202_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 203 AND cat_id = 1) as r203_1 ON r1.id = r203_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 203 AND cat_id = 2 GROUP BY item_id) as r203_2 ON r1.id = r203_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 203 AND cat_id = 3 GROUP BY item_id) as r203_3 ON r1.id = r203_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 204 AND cat_id = 1) as r204_1 ON r1.id = r204_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 204 AND cat_id = 2 GROUP BY item_id) as r204_2 ON r1.id = r204_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 204 AND cat_id = 3 GROUP BY item_id) as r204_3 ON r1.id = r204_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 205 AND cat_id = 1) as r205_1 ON r1.id = r205_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 205 AND cat_id = 2 GROUP BY item_id) as r205_2 ON r1.id = r205_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 205 AND cat_id = 3 GROUP BY item_id) as r205_3 ON r1.id = r205_3.item_id LEFT JOIN
        
        (SELECT room_no, item_id, unit FROM w_db_room_item WHERE room_no = 206 AND cat_id = 1) as r206_1 ON r1.id = r206_1.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 206 AND cat_id = 2 GROUP BY item_id) as r206_2 ON r1.id = r206_2.item_id LEFT JOIN
        (SELECT room_no, item_id, sum(unit) as total FROM w_db_room_item WHERE room_no = 206 AND cat_id = 3 GROUP BY item_id) as r206_3 ON r1.id = r206_3.item_id
        
        ORDER BY r1.location_id ASC, r1.cat_id ASC ");

    // View request --> w_stock_req_select
        $request_view = mysqli_query($db, "SELECT * FROM w_db_stock WHERE cat_id = 3 AND assign_by = '' ORDER BY cat_id ASC");

    // Purchase --> w_stock_buy
        if(isset($_POST['new_purchase'])){
            $user_id = $_POST['user_id'];
            $cat_id = 1;
            $item_id = $_POST['item_id'];
            $unit = $_POST['unit'];
            $amount = str_replace(",", "", $_POST['amount']);
            $currency = $_POST['currency'];
            $supplier_id = $_POST['supplier_id'];
            $notes = $_POST['notes'];
            $ref_no = $_POST['ref_no'];
            $date = date("Y-m-d");

            $query_1= mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
            $result = mysqli_fetch_array($query_1);
            $buy_rate = $result['buy_rate'];
            $total_purchase =  $amount * $buy_rate;

            $query_2 = "INSERT INTO w_db_stock (cat_id, ref_no, item_id, unit, amount, currency, total_purchase, supplier_id, notes, create_date, create_by) VALUES ('$cat_id', '$ref_no', '$item_id', '$unit', '$amount', '$currency', '$total_purchase', '$supplier_id', '$notes', '$date', '$user_id')" ;
            mysqli_query($db, $query_2);

            header('location: ../w_stock_main.php');

        }

    // Add Dispose --> w_stock_dispose
        if(isset($_POST['new_dispose'])){
            $user_id = $_POST['user_id'];
            $cat_id = 4;
            $item_id = $_POST['item_id'];
            $unit = $_POST['unit'];
            $date = date("Y-m-d");

            $query = "INSERT INTO w_db_stock (cat_id, item_id, unit, create_date,create_by) VALUES ('$cat_id', '$item_id', '$unit', '$date', '$user_id')" ;

            mysqli_query($db, $query);

            header('location: ../w_stock_main.php');

        }

    // Select Item Request -->w_stock_req_select
        if(isset($_POST['new_select'])){
            $request_id = $_POST['request_id'];
            header('location: ../w_stock_req_approve.php?request_id='.$request_id.'');
        }

    // New Assign in side room  --> w_stock_req_approve
        if(isset($_POST['new_assign'])){
            // Update request 
            $id = $_POST['request_id'];
            $status = 1;
            $user_id = $_POST['user_id'];
            date_default_timezone_set("Asia/Bangkok");
            $assign_date = date("Y-m-d");

            // for new assign
            $cat_id = 5;
            $room_no = $_POST['room_no'];
            $item_id = $_POST['item_id'];
            $unit = $_POST['unit'];
            $date = date("Y-m-d");

            $query_1 = "UPDATE w_db_stock SET status = '$status', assign_date = '$assign_date', assign_by = '$user_id' WHERE id=$id";
            mysqli_query($db, $query_1);

            $query_2 = "INSERT INTO w_db_stock (cat_id, room_no, item_id, unit, create_date, create_by) VALUES ('$cat_id', '$room_no', '$item_id', '$unit', '$date', '$user_id')" ;
            mysqli_query($db, $query_2);

            header('location: ../w_stock_main.php');
        }

    // Approval all
    if(isset($_GET['approve_all_rec'])){
        $rec_date = $_GET['approve_all_rec'];
        $user_id = $_GET['user_id'];
        $date = date("Y-m-d");

        mysqli_query($db, "UPDATE w_db_stock SET check_by = '$user_id', check_date = '$date' WHERE create_date = '$rec_date' AND check_by = ' '");

            header('location: ../w_stock_detail.php?date='.$rec_date.'');

    }