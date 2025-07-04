<?php

include "connect.hdl.php";

// >>>> >>>> Menu <<<< <<<<<
    // View
        $product_view = mysqli_query($db, "SELECT * FROM wutb_db_list_menu");


// >>>> >>>> Customer <<<< <<<<<
    // View
        $customer_view = mysqli_query($db, "SELECT * FROM wutb_db_list_customer");


// >>>> >>>> Sale <<<< <<<<<
    // View
        $sale_view = mysqli_query($db, "SELECT * FROM wutb_db_sale ORDER BY check_by != '', id DESC");

    // Summary
        $product_sum = mysqli_query($db, "SELECT r1.id, r1.menu_la, ifnull(r2.bake,0) as bake, ifnull(r3.changes,0) as changes, ifnull(r4.sale,0) as sale, ifnull(r2.bake,0) - ifnull(r3.changes,0) - ifnull(r4.sale,0) as total FROM (SELECT * FROM wutb_db_list_menu) as r1 LEFT JOIN (SELECT product_id, sum(unit) as bake FROM `wutb_db_sale` WHERE cat_id = 2 GROUP BY product_id) as r2 ON r1.id = r2.product_id LEFT JOIN (SELECT product_id, sum(unit) as changes FROM `wutb_db_sale` WHERE cat_id = 3 GROUP BY product_id) as r3 ON r1.id = r3.product_id LEFT JOIN (SELECT product_id, sum(unit) as sale FROM `wutb_db_sale` WHERE cat_id = 1 GROUP BY product_id) as r4 ON r1.id = r4.product_id WHERE ifnull(r2.bake,0) - ifnull(r3.changes,0) - ifnull(r4.sale,0) > 0 ORDER BY id ASC");

// >>>> >>>> Expense <<<< <<<<<
    // View
        $item_view = mysqli_query($db, "SELECT * FROM wutb_db_list_expense ORDER BY cat_id ASC, id ASC ");

    // Cat view
        $ecat_view = mysqli_query($db, "SELECT * FROM wutb_db_list_expense_cat");
   
// >>>> >>>> Stock <<<< <<<<<
    // View
        $stock_wutb_view = mysqli_query($db, "SELECT * FROM wutb_db_expense ORDER BY check_by != '', id DESC");

    // View

        $wutb_stock_view = mysqli_query($db, "SELECT r1.create_date, DATE(r1.create_date) as group_date, IFNULL(r3.completed,0) as completed, IFNULL(r2.pending, 0) as pending, IFNULL(r4.total, 0) as total FROM (SELECT create_date, DATE(create_date) as group_date FROM wutb_db_expense WHERE cat_id != 6 GROUP BY DATE(create_date)) as r1 LEFT JOIN (SELECT id, DATE(create_date) as group_date, count(id) as pending FROM wutb_db_expense WHERE check_by = ' ' AND cat_id = 6 GROUP BY DATE(create_date)) as r2 ON r1.group_date = r2.group_date LEFT JOIN (SELECT id, DATE(create_date) as group_date, count(id) as completed FROM wutb_db_expense WHERE check_by != ' ' AND cat_id = 6 GROUP BY DATE(create_date)) as r3 ON r1.group_date = r3.group_date LEFT JOIN (SELECT id, DATE(create_date) as group_date, count(id) as total FROM wutb_db_expense WHERE cat_id != 6 GROUP BY DATE(create_date)) as r4 ON r1.group_date = r4.group_date ORDER BY group_date DESC");

    // Summary
        $stock_wutb_sum_view = mysqli_query($db, "SELECT i1.id as id, i1.cat_id as cat_id, i1.desc_la as item_la, i1.unit as unit, ifnull(i2.p_u, 0) as u_purchase, ifnull(i3.d_u, 0) as u_dispose , ifnull(i4.u_u, 0) as u_use , (ifnull(i2.p_u, 0) - ifnull(i3.d_u, 0) - ifnull(i4.u_u, 0)) as total FROM (SELECT * FROM wutb_db_list_expense WHERE cat_id != 6) as i1 LEFT JOIN (SELECT item_id, sum(unit) as p_u FROM wutb_db_expense WHERE cat_id = 1 GROUP BY item_id) as i2 ON i1.id = i2.item_id LEFT JOIN (SELECT item_id, sum(unit) as d_u FROM wutb_db_expense WHERE cat_id = 2 GROUP BY item_id) as i3 ON i1.id = i3.item_id LEFT JOIN (SELECT item_id, sum(unit) as u_u FROM wutb_db_expense WHERE cat_id = 3 GROUP BY item_id) as i4 ON i1.id = i4.item_id ORDER BY i1.cat_id ASC, i1.id ASC");

// >>>> >>>> Purchase <<<< <<<<
    // New
        if(isset($_POST['new_purchase'])){
            $create_date = $_POST['create_date'];
            $user_id = $_POST['user_id'];
            $cat_id = 1;
            $item_id = $_POST['item_id'];
            $unit = $_POST['unit'];
            $amount = str_replace(",", "", $_POST['amount']);
            $currency = $_POST['currency'];
            $supplier_id = $_POST['supplier_id'];
            $notes = $_POST['notes'];
            $ref_no = $_POST['ref_no'];

            $query_1= mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
            $result = mysqli_fetch_array($query_1);
            $buy_rate = $result['buy_rate'];
            $total_purchase = $amount * $buy_rate;

            $query_2 = "INSERT INTO wutb_db_expense (cat_id, ref_no, item_id, unit, amount, currency, total_purchase, supplier_id, notes, create_date, create_by) VALUES ('$cat_id', '$ref_no', '$item_id', '$unit', '$amount', '$currency', '$total_purchase', '$supplier_id', '$notes', '$create_date', '$user_id')" ;
            mysqli_query($db, $query_2);

            header('location: ../wutb_stock_main.php');
        }

    // Update
        if(isset($_POST['update_purchase'])){
            $id = $_POST['id'];
            $user_id = $_POST['user_id'];
            $ref_no = $_POST['ref_no'];
            $item_id = $_POST['item_id'];
            $unit = $_POST['unit'];
            $amount = str_replace(",", "", $_POST['amount']);
            $currency = $_POST['currency'];
            $supplier_id = $_POST['supplier_id'];
            $notes = $_POST['notes'];
            $date = $_POST['date'];

            if(!empty( $currency)){

            $query_1= mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
            $result = mysqli_fetch_array($query_1);
            $buy_rate = $result['buy_rate'];
            $total_purchase = $amount * $buy_rate;

            }
        
            $query_2 = "UPDATE wutb_db_expense SET ref_no = '$ref_no', item_id = '$item_id', unit = '$unit', amount = '$amount', currency = '$currency', total_purchase = '$total_purchase', supplier_id = '$supplier_id', notes = '$notes' WHERE id = $id" ;
            mysqli_query($db, $query_2);

            header('location: ../wutb_stock_detail.php?date='.$date.'');

        }

// >>>> >>>> Dispose <<<< <<<<
    // View
        $dispose_view = mysqli_query($db, "SELECT i1.id as id, i1.cat_id as cat_id, i1.desc_la as item_la, ifnull(i2.p_u, 0) as u_purchase, ifnull(i3.d_u, 0) as u_dispose , ifnull(i4.u_u, 0) as u_use , (ifnull(i2.p_u, 0) - ifnull(i3.d_u, 0) - ifnull(i4.u_u, 0)) as total FROM (SELECT * FROM wutb_db_list_expense) as i1 LEFT JOIN (SELECT item_id, sum(unit) as p_u FROM wutb_db_expense WHERE cat_id = 1 GROUP BY item_id) as i2 ON i1.id = i2.item_id LEFT JOIN (SELECT item_id, sum(unit) as d_u FROM wutb_db_expense WHERE cat_id = 2 GROUP BY item_id) as i3 ON i1.id = i3.item_id LEFT JOIN (SELECT item_id, sum(unit) as u_u FROM wutb_db_expense WHERE cat_id = 3 GROUP BY item_id) as i4 ON i1.id = i4.item_id WHERE (ifnull(i2.p_u, 0) - ifnull(i3.d_u, 0) - ifnull(i4.u_u, 0)) > 0 ORDER BY i1.cat_id ASC");

    // New Dispose
        if(isset($_POST['new_dispose'])){
            $create_date = $_POST['create_date'];
            $user_id = $_POST['user_id'];
            $cat_id = 2;
            $item_id = $_POST['item_id'];
            $unit = $_POST['unit'];

            $query = "INSERT INTO wutb_db_expense (cat_id, item_id, unit, create_date, create_by) VALUES ('$cat_id', '$item_id', '$unit', '$create_date', '$user_id')" ;

            mysqli_query($db, $query);

            header('location: ../wutb_stock_main.php');

        }


    // Confirm stock record
        if(isset($_GET['stock_check_id'])){
            $id = $_GET['stock_check_id'];
            $user_id = $_GET['user_id'];
            date_default_timezone_set("Asia/Bangkok");
            $check_date = date("Y-m-d");
            $date = $_GET['date'];
            mysqli_query($db, "UPDATE wutb_db_expense SET check_by = '$user_id', check_date = '$check_date' WHERE id=$id");
            header('location: ../wutb_stock_detail.php?date='.$date.'');
        }  

    // del
        if(isset($_GET['stock_del_id'])){
            $id = $_GET['stock_del_id'];
            $date = $_GET['date'];
            mysqli_query($db, "DELETE FROM wutb_db_expense where id=$id");
            header('location: ../wutb_stock_detail.php?date='.$date.'');
        }

// >>>> >>>> assign <<<< <<<<
    // View
        $assign_view = mysqli_query($db, "SELECT i1.id as id, i1.cat_id as cat_id, i1.desc_la as item_la, ifnull(i2.p_u, 0) as u_purchase, ifnull(i3.d_u, 0) as u_dispose , ifnull(i4.u_u, 0) as u_use , (ifnull(i2.p_u, 0) - ifnull(i3.d_u, 0) - ifnull(i4.u_u, 0)) as total FROM (SELECT * FROM wutb_db_list_expense) as i1 LEFT JOIN (SELECT item_id, sum(unit) as p_u FROM wutb_db_expense WHERE cat_id = 1 GROUP BY item_id) as i2 ON i1.id = i2.item_id LEFT JOIN (SELECT item_id, sum(unit) as d_u FROM wutb_db_expense WHERE cat_id = 2 GROUP BY item_id) as i3 ON i1.id = i3.item_id LEFT JOIN (SELECT item_id, sum(unit) as u_u FROM wutb_db_expense WHERE cat_id = 3 GROUP BY item_id) as i4 ON i1.id = i4.item_id WHERE (ifnull(i2.p_u, 0) - ifnull(i3.d_u, 0) - ifnull(i4.u_u, 0)) > 0 ORDER BY i1.cat_id ASC");

    // New
        if(isset($_POST['new_usage'])){
            $create_date = $_POST['create_date'];
            $user_id = $_POST['user_id'];
            $cat_id = 3;
            $item_id = $_POST['item_id'];
            $unit = $_POST['unit'];

            $query = "INSERT INTO wutb_db_expense (cat_id, item_id, unit, create_date, create_by) VALUES ('$cat_id', '$item_id', '$unit', '$create_date', '$user_id')" ;
            mysqli_query($db, $query);
            header('location: ../wutb_stock_main.php');
        }


      // Approval all
      if(isset($_GET['approve_all_rec'])){
        $rec_date = $_GET['approve_all_rec'];
        $user_id = $_GET['user_id'];
        $date = date("Y-m-d");

        mysqli_query($db, "UPDATE wutb_db_expense SET check_by = '$user_id', check_date = '$date' WHERE create_date = '$rec_date' AND check_by = ' '");
            header('location: ../wutb_stock_detail.php?date='.$rec_date.'');

    }


// New expense cat
    if(isset($_POST['new_expense_cat'])){
        $desc_la = $_POST['desc_la'];

        $query = "INSERT INTO wutb_db_list_expense_cat (desc_la) VALUES ('$desc_la')" ;
        mysqli_query($db, $query);
        header('location: ../wutb_l_expense_cat.php');
    }

// del
    if(isset($_GET['ecat_del_id'])){
        $id = $_GET['ecat_del_id'];
        mysqli_query($db, "DELETE FROM wutb_db_list_expense_cat where id=$id");
        header('location: ../wutb_l_expense_cat.php');
    }

// Confirm stock record
if(isset($_POST['edit_ecat'])){
    $id = $_POST['id'];
    $desc_la = $_POST['desc_la'];
    date_default_timezone_set("Asia/Bangkok");
    mysqli_query($db, "UPDATE wutb_db_list_expense_cat SET desc_la = '$desc_la' WHERE id=$id");
    header('location: ../wutb_l_expense_cat.php');
}

// Salary View

    $wutb_salary_view = mysqli_query($db, "SELECT r1.create_date, DATE(r1.create_date) as group_date, IFNULL(r3.completed,0) as completed, IFNULL(r2.pending, 0) as pending, IFNULL(r4.total, 0) as total FROM 
    (SELECT create_date, DATE(create_date) as group_date FROM wutb_db_expense WHERE cat_id = 6 GROUP BY DATE(create_date)) as r1 LEFT JOIN 
    (SELECT id, DATE(create_date) as group_date, count(id) as pending FROM wutb_db_expense WHERE check_by = ' ' AND cat_id = 6 GROUP BY DATE(create_date)) as r2 ON r1.group_date = r2.group_date LEFT JOIN 
    (SELECT id, DATE(create_date) as group_date, count(id) as completed FROM wutb_db_expense WHERE check_by != ' ' AND cat_id = 6 GROUP BY DATE(create_date)) as r3 ON r1.group_date = r3.group_date LEFT JOIN 
    (SELECT id, DATE(create_date) as group_date, count(id) as total FROM wutb_db_expense WHERE cat_id = 6 GROUP BY DATE(create_date)) as r4 ON r1.group_date = r4.group_date ORDER BY group_date DESC
    ");


// Salary cat
    $salary_cat_view = mysqli_query($db, "SELECT * FROM wutb_db_list_expense_cat ORDER BY id ASC");

// View salary (dropdown)
     $salary_view = mysqli_query($db, "SELECT r2.id, r2.cat_id, r1.desc_la as cat, r2.desc_la as detail FROM wutb_db_list_expense_cat as r1 LEFT JOIN wutb_db_list_expense as r2 ON r2.cat_id = r1.id WHERE cat_id = 6");

// del
    if(isset($_GET['salary_del_id'])){
        $id = $_GET['salary_del_id'];
        $date = $_GET['date'];
        mysqli_query($db, "DELETE FROM wutb_db_expense where id=$id");
        header('location: ../wutb_salary_detail.php?date='.$date.'');
    }

// New Salary

if(isset($_POST['new_salary'])){
    $create_date = $_POST['create_date'];
    $user_id = $_POST['user_id'];
    $cat_id = 6;
    $item_id = $_POST['item_id'];
    $unit = $_POST['unit'];
    $amount = str_replace(",", "", $_POST['amount']);
    $currency = $_POST['currency'];
    $supplier_id = $_POST['supplier_id'];
    $notes = $_POST['notes'];
    $ref_no = $_POST['ref_no'];

    $query_1= mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
    $result = mysqli_fetch_array($query_1);
    $buy_rate = $result['buy_rate'];
    $total_purchase = $amount * $buy_rate;

    $query_2 = "INSERT INTO wutb_db_expense (cat_id, ref_no, item_id, unit, amount, currency, total_purchase, supplier_id, notes, create_date, create_by) VALUES ('$cat_id', '$ref_no', '$item_id', '$unit', '$amount', '$currency', '$total_purchase', '$supplier_id', '$notes', '$create_date', '$user_id')" ;
    mysqli_query($db, $query_2);

    header('location: ../wutb_salary_main.php');
}


// Update
if(isset($_POST['update_salary'])){
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $item_id = $_POST['item_id'];
    $amount = str_replace(",", "", $_POST['amount']);
    $currency = $_POST['currency'];
    $notes = $_POST['notes'];
    $date = $_POST['date'];

    if(!empty( $currency)){

    $currency_c = mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
    $result = mysqli_fetch_array($currency_c);
    $buy_rate = $result['buy_rate'];
    $total_purchase = $amount * $buy_rate;

    }

    $query_2 = "UPDATE wutb_db_expense SET item_id = '$item_id', amount = '$amount', currency = '$currency', total_purchase = '$total_purchase', notes = '$notes' WHERE id = $id" ;
    mysqli_query($db, $query_2);

    header('location: ../wutb_salary_detail.php?date='.$date.'');

}