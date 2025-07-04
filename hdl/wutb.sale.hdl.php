<?php

include "connect.hdl.php";

// >>>> >>>> Product <<<< <<<<
    // View 1
        $product_view = mysqli_query($db, "SELECT * FROM wutb_db_list_menu");
    // View 2
        $product_view_2 = mysqli_query($db, "SELECT * FROM wutb_db_list_menu");
    // View 3
        $product_view_3 = mysqli_query($db, "SELECT * FROM wutb_db_list_menu WHERE auto = 1");

    // Price Cat

        $price_cat = mysqli_query($db, "SELECT * FROM wutb_db_list_price_cat ORDER BY id ASC");

    // Reserve View

        $reserve_view = mysqli_query($db, "SELECT * FROM wutb_db_sale WHERE cat_id = 5 ORDER BY id ASC");

        $sum_reserve = mysqli_query($db, "SELECT count(id) as no_booking FROM wutb_db_sale WHERE cat_id = 5 ORDER BY id ASC");
        $no_reserve = mysqli_fetch_array($sum_reserve);

    // Customer view

        $customer_view = mysqli_query($db, "SELECT * FROM wutb_db_list_customer");

    // Debt View

        $debt_view = mysqli_query($db, "SELECT * FROM wutb_db_sale WHERE payment = 2 AND paid_receive_by = '' ORDER BY id ASC");

    // Debt View All

        $debt_view_all = mysqli_query($db, "SELECT * FROM wutb_db_sale WHERE payment = 2 ORDER BY id ASC");

    // Sale View

        $sale_view = mysqli_query($db, "SELECT * FROM wutb_db_sale ORDER BY check_by != '', create_date DESC");

    // Sale_group_view

        $sale_group_view = mysqli_query($db, "SELECT r1.create_date, DATE(r1.create_date) as group_date, IFNULL(r3.completed,0) as completed, IFNULL(r2.pending, 0) as pending, IFNULL(r4.total, 0) as total FROM (SELECT create_date, DATE(create_date) as group_date FROM wutb_db_sale GROUP BY DATE(create_date)) as r1 LEFT JOIN (SELECT id, DATE(create_date) as group_date, count(id) as pending FROM wutb_db_sale WHERE check_by = ' ' GROUP BY DATE(create_date)) as r2 ON r1.group_date = r2.group_date LEFT JOIN (SELECT id, DATE(create_date) as group_date, count(id) as completed FROM wutb_db_sale WHERE check_by != ' ' GROUP BY DATE(create_date)) as r3 ON r1.group_date = r3.group_date LEFT JOIN (SELECT id, DATE(create_date) as group_date, count(id) as total FROM wutb_db_sale GROUP BY DATE(create_date)) as r4 ON r1.group_date = r4.group_date ORDER BY group_date DESC");

    // Product Summary

        $product_sum = mysqli_query($db, "SELECT r1.id, r1.menu_la, ifnull(r2.bake,0) as bake, ifnull(r3.changes,0) as changes, ifnull(r4.sale,0) as sale, ifnull(r5.return_delete,0) as return_delete, ifnull(r6.reserve,0) as reserve, ifnull(r2.bake,0) - ifnull(r3.changes,0) - ifnull(r4.sale,0) - ifnull(r5.return_delete,0) - ifnull(r6.reserve,0)as total FROM 
        (SELECT * FROM wutb_db_list_menu) as r1 LEFT JOIN 
        (SELECT product_id, sum(unit) as bake FROM `wutb_db_sale` WHERE cat_id = 2 GROUP BY product_id) as r2 ON r1.id = r2.product_id LEFT JOIN 
        (SELECT product_id, sum(unit) as changes FROM `wutb_db_sale` WHERE cat_id = 3 GROUP BY product_id) as r3 ON r1.id = r3.product_id LEFT JOIN 
        (SELECT product_id, sum(unit) as sale FROM `wutb_db_sale` WHERE cat_id = 1 GROUP BY product_id) as r4 ON r1.id = r4.product_id LEFT JOIN 
        (SELECT product_id, sum(unit) as return_delete FROM `wutb_db_sale` WHERE cat_id = 4 GROUP BY product_id) as r5 ON r1.id = r5.product_id LEFT JOIN  
        (SELECT product_id, sum(unit) as reserve FROM `wutb_db_sale` WHERE cat_id = 5 GROUP BY product_id) as r6 ON r1.id = r6.product_id WHERE ifnull(r2.bake,0) - ifnull(r3.changes,0) - ifnull(r4.sale,0) - ifnull(r5.return_delete,0) - ifnull(r6.reserve,0) > 0 ORDER BY id ASC;");

    // Stock View

        $stock_wutb_view = mysqli_query($db, "SELECT * FROM wutb_db_expense ORDER BY check_by != '', id DESC");
    
    // Check Debt

        $check_debt = mysqli_query($db, "SELECT r1.id as id, r1.sub_id as sub_id, r1.name as name, ifnull(sum(r2.total_debt), 0) as total_debt, ifnull(sum(r3.total_payment), 0) as total_payment, ifnull(sum(r2.total_debt), 0) - ifnull(sum(r3.total_payment), 0) as remain_debt  FROM (SELECT * FROM wutb_db_list_customer) as r1 LEFT JOIN (SELECT customer_id, sum(total_sale) as total_debt FROM wutb_db_sale WHERE payment = 2 GROUP BY customer_id) as r2 on r1.id = r2.customer_id LEFT JOIN (SELECT customer_id, sum(total_sale) as total_payment FROM wutb_db_sale WHERE cat_id = 6 GROUP BY customer_id) as r3 on r1.id = r3.customer_id WHERE r2.total_debt > 0 GROUP BY sub_id");

    // Remove
        if(isset($_GET['sale_del_id'])){
            $id = $_GET['sale_del_id'];
            $date = $_GET['date'];
            mysqli_query($db, "DELETE FROM wutb_db_sale where id=$id");
            header('location: ../wutb_sale_detail.php?date='.$date.'');
        }


    // Check
        if(isset($_GET['sale_check_id'])){
            $id = $_GET['sale_check_id'];
            $user_id = $_GET['user_id'];
            date_default_timezone_set("Asia/Bangkok");
            $check_date = date("Y-m-d");
            $date = $_GET['date'];
            mysqli_query($db, "UPDATE wutb_db_sale SET check_by = '$user_id', check_date = '$check_date' WHERE id=$id");
            header('location: ../wutb_sale_detail.php?date='.$date.'');
        }   

    // Debt Settlement

        if(isset($_GET['debt_paid_id'])){
            $id = $_GET['debt_paid_id'];
            $user_id = $_GET['user_id'];
            date_default_timezone_set("Asia/Bangkok");
            $paid_date = date("Y-m-d");
            mysqli_query($db, "UPDATE wutb_db_sale SET paid_receive_by = '$user_id', paid_date = '$paid_date' WHERE id=$id");
            header('location: ../wutb_a_debt.php');
        } 

    // Update Reserve

        if(isset($_POST['update_reserve'])){
            $id = $_POST['reserve_id'];
            $payment = $_POST['payment'];
            $user_id = $_POST['user_id'];
            $delivery_cost = str_replace(",", "", $_POST['delivery_fee']);
            $delivery_fee = intval($delivery_cost);
            date_default_timezone_set("Asia/Bangkok");
            $reserve_update_date = date("Y-m-d");

            if(empty($delivery_fee)){
                mysqli_query($db, "UPDATE wutb_db_sale SET cat_id = 1, payment = '$payment', reserve_update_date = '$reserve_update_date', reserve_update_by = '$user_id' WHERE id=$id");
            } else {

                $query = mysqli_query($db, "SELECT * FROM wutb_db_sale WHERE id = $id");
                $result = mysqli_fetch_array($query);
                $unit = $result['unit'];
                $unit_price = $result['unit_price'];

                $new_total = ($unit * $unit_price) + $delivery_fee;

                mysqli_query($db, "UPDATE wutb_db_sale SET cat_id = 1, payment = '$payment', delivery_fee = '$delivery_cost', total_sale = '$new_total', reserve_update_date = '$reserve_update_date', reserve_update_by = '$user_id' , check_by = '' WHERE id=$id");
            }
            
            
            header('location: ../wutb_sale_main.php');
        }

    // Sale Update

        if(isset($_POST['edit_sale'])){
            
            $id = $_POST['sale_edit_id'];
            $cat_id = $_POST['cat_id'];
            $user_id = $_POST['user_id'];
            $notes = $_POST['notes'];
            $payment = $_POST['payment'];
            $price_type = $_POST['price_type'];
            $product_id = $_POST['product_id'];    
            $unit = $_POST['unit'];
            $delivery_cost = str_replace(",", "", $_POST['delivery_fee']);
            $delivery_fee = intval($delivery_cost);
            $unit_price_special = str_replace(",", "", $_POST['unit_price']);   
            $currency = $_POST['currency'];
            $customer_id = $_POST['customer_id'];
            $date = $_POST['date'];

            $query_1= mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
            $result = mysqli_fetch_array($query_1);
            $buy_rate = $result['buy_rate'];
            $total_sale =  (($unit * $unit_price_special) * $buy_rate) + $delivery_fee;

            $query_2 = "UPDATE wutb_db_sale SET cat_id = '$cat_id', payment = '$payment', price_type = '$price_type', customer_id = '$customer_id', product_id = '$product_id', unit = '$unit', unit_price = '$unit_price_special', currency = '$currency', delivery_fee = '$delivery_fee', total_sale = '$total_sale', notes = '$notes' WHERE id=$id";
            mysqli_query($db, $query_2);

            header('location: ../wutb_sale_detail.php?date='.$date.'');
            
        }
    

    // New Sale
        if(isset($_POST['new_sale'])){
            $cat_id = 1;
            $create_date = $_POST['create_date'];
            $user_id = $_POST['user_id'];
            $notes = $_POST['notes'];
            $payment = $_POST['payment'];
            $price_type = $_POST['price_type'];
            $product_id = $_POST['product_id'];    
            $unit = $_POST['unit'];
            $delivery_cost = str_replace(",", "", $_POST['delivery_fee']);
            $delivery_fee = intval($delivery_cost);
            $unit_price_special = str_replace(",", "", $_POST['unit_price']);   
            $currency = $_POST['currency'];
            $customer_id = $_POST['customer_id'];

            if(!empty($unit_price_special)){

                if($payment == 3){

                $query_1= mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
                $result = mysqli_fetch_array($query_1);
                $buy_rate = $result['buy_rate'];
                $total_sale =  (($unit * $unit_price_special) * $buy_rate) + $delivery_fee;

                $query_2 = "INSERT INTO wutb_db_sale (cat_id, payment, customer_id, product_id, unit, unit_price, currency, delivery_fee, total_sale, notes, create_date, create_by) VALUES (5, '$payment', '$customer_id', '$product_id',  '$unit', '$unit_price_special', '$currency', '$delivery_fee', '$total_sale', '$notes', '$create_date', '$user_id')";
                mysqli_query($db, $query_2);

                } else {

                $query_1= mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
                $result = mysqli_fetch_array($query_1);
                $buy_rate = $result['buy_rate'];
                $total_sale =  (($unit * $unit_price_special) * $buy_rate) + $delivery_fee;

                $query_2 = "INSERT INTO wutb_db_sale (cat_id, payment, customer_id, product_id, unit, unit_price, currency, delivery_fee, total_sale, notes, create_date, create_by) VALUES ('$cat_id', '$payment', '$customer_id', '$product_id',  '$unit', '$unit_price_special', '$currency', '$delivery_fee', '$total_sale', '$notes', '$create_date', '$user_id')";
                mysqli_query($db, $query_2);

                }

            } else {

                if($payment == 3){

                $query_1 = mysqli_query($db, "SELECT * FROM wutb_db_list_menu_price WHERE cat_id = $price_type AND menu_id = $product_id ORDER BY id DESC LIMIT 1");
                $result_1 = mysqli_fetch_array($query_1);
                $unit_price = $result_1['unit_price'];

                    if($unit_price <= 0){
                        header('location: ../wutb_sale.php?no_price');
                    } else {

                    $total_sale =  ($unit * $unit_price) + $delivery_fee;

                    $query_2 = "INSERT INTO wutb_db_sale (cat_id, price_type, customer_id, product_id, unit, unit_price, currency, delivery_fee, total_sale, notes, create_date, create_by) VALUES (5, '$price_type', '$customer_id', '$product_id',  '$unit', '$unit_price', 1, '$delivery_fee','$total_sale', '$notes',  '$create_date', '$user_id')" ;
                    mysqli_query($db, $query_2);

                    }  
                
                } else {

                $query_1 = mysqli_query($db, "SELECT * FROM wutb_db_list_menu_price WHERE cat_id = $price_type AND menu_id = $product_id ORDER BY id DESC LIMIT 1");
                $result_1 = mysqli_fetch_array($query_1);
                $unit_price = $result_1['unit_price'];

                    if($unit_price <= 0){
                        header('location: ../wutb_sale.php?no_price');
                    } else {

                    $total_sale =  ($unit * $unit_price) + $delivery_fee ;

                    $query_2 = "INSERT INTO wutb_db_sale (cat_id, payment, price_type, customer_id, product_id, unit, unit_price, currency, delivery_fee, total_sale, notes, create_date, create_by) VALUES ('$cat_id', '$payment', '$price_type', '$customer_id', '$product_id', '$unit', '$unit_price', 1, '$delivery_fee', '$total_sale', '$notes', '$create_date', '$user_id')" ;
                    mysqli_query($db, $query_2);

                    }
                }

            }
            header('location: ../wutb_sale_main.php');
        }

    // New Settlement
        if(isset($_POST['new_payment'])){
            $user_id = $_POST['user_id'];
            $create_date = $_POST['create_date'];
            $notes = $_POST['notes'];
            $payment = str_replace(",", "", $_POST['payment']);
            $currency = $_POST['currency'];
            $customer_id = $_POST['customer_id'];

            $total_sale = $payment * 1;

            $query_2 = "INSERT INTO wutb_db_sale (cat_id, customer_id, unit_price, currency, total_sale, notes, create_date, create_by) VALUES (6, '$customer_id', '$payment', 1, '$total_sale', '$notes', '$create_date', '$user_id')";
            mysqli_query($db, $query_2);

            header('location: ../wutb_sale_main.php');
        }

    // New Bake
        if(isset($_POST['new_bake'])){
            $user_id = $_POST['user_id'];
            $product_id = $_POST['product_id'];    
            $unit = $_POST['unit'];

            if($product_id == 1){

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (2, '$product_id', '$unit', '$user_id')");

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 2, 1, '$user_id')");

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 3, 1, '$user_id')");

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 4, 1, '$user_id')");

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 5, 1, '$user_id')");

            } elseif($product_id == 6){

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (2, '$product_id', '$unit', '$user_id')");

                $unit_new = $unit / 2;

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 2, '$unit_new', '$user_id')");

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 3, '$unit_new', '$user_id')");

            } elseif($product_id == 7){

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (2, '$product_id', '$unit', '$user_id')");

                $unit_new = $unit / 2;

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 2, '$unit_new', '$user_id')");

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 4, '$unit_new', '$user_id')");
                
            } elseif($product_id == 8){

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (2, '$product_id', '$unit', '$user_id')");

                $unit_new = $unit / 2;

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 2, '$unit_new', '$user_id')");

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 5, '$unit_new', '$user_id')");
                
            } elseif($product_id == 9){

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (2, '$product_id', '$unit', '$user_id')");

                $unit_new = $unit / 2;

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 3, '$unit_new', '$user_id')");

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 4, '$unit_new', '$user_id')");
                
            } elseif($product_id == 10){

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (2, '$product_id', '$unit', '$user_id')");

                $unit_new = $unit / 2;

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 3, '$unit_new', '$user_id')");

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 5, '$unit_new', '$user_id')");
                
            } elseif($product_id == 11){

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (2, '$product_id', '$unit', '$user_id')");

                $unit_new = $unit / 2;

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 4, '$unit_new', '$user_id')");

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (3, 5, '$unit_new', '$user_id')");
                
            } else {

                $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_by) VALUES (2, '$product_id', '$unit', '$user_id')");

            }

            header('location: ../wutb_sale_main.php');

        }

    // New Return
        if(isset($_POST['new_return'])){
            $cat_id = 4;
            $user_id = $_POST['user_id'];
            $create_date = $_POST['create_date'];
            $notes = $_POST['notes'];  
            $price_type = $_POST['price_type'];
            $product_id = $_POST['product_id'];    
            $unit = $_POST['unit'];
            $delivery_cost = str_replace(",", "", $_POST['delivery_fee']);
            $delivery_fee = intval($delivery_cost);
            $unit_price_special = str_replace(",", "", $_POST['unit_price']);   
            $currency = $_POST['currency'];
            $customer_id = $_POST['customer_id'];

            if(!empty($unit_price_special)){

                if($payment == 3){

                $query_1= mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
                $result = mysqli_fetch_array($query_1);
                $buy_rate = $result['buy_rate'];
                $total_sale =  ($unit * $unit_price) * $buy_rate;

                $query_2 = "INSERT INTO wutb_db_sale (cat_id, price_type, customer_id, product_id, unit, unit_price, currency, total_sale, notes, create_date, create_by) VALUES ('$cat_id', '$price_type', '$customer_id', '$product_id',  '$unit', '$unit_price', '$currency', '$total_sale', '$notes', '$create_date', '$user_id')";
                mysqli_query($db, $query_2);

                } else {

                $query_1= mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id WHERE r1.id = $currency");
                $result = mysqli_fetch_array($query_1);
                $buy_rate = $result['buy_rate'];
                $total_sale =  ($unit * $unit_price) * $buy_rate;

                $query_2 = "INSERT INTO wutb_db_sale (cat_id, price_type,  customer_id, product_id, unit, unit_price, currency, total_sale, notes, create_date, create_by) VALUES ('$cat_id', '$price_type', '$customer_id', '$product_id',  '$unit', '$unit_price', '$currency', '$total_sale', '$notes', '$create_date', '$user_id')";
                mysqli_query($db, $query_2);

                }

            } else {

                $query_1 = mysqli_query($db, "SELECT * FROM wutb_db_list_menu_price WHERE cat_id = $price_type AND menu_id = $product_id ORDER BY id DESC LIMIT 1");
                $result_1 = mysqli_fetch_array($query_1);
                $unit_price = $result_1['unit_price'];

                    if($unit_price <= 0){
                        header('location: ../wutb_sale.php?no_price');
                    } else {

                    $total_sale = $unit * $unit_price ;

                    $query_2 = "INSERT INTO wutb_db_sale (cat_id, payment, price_type, customer_id, product_id, unit, unit_price, currency, total_sale, notes, create_date, create_by) VALUES ('$cat_id', '$payment', '$price_type', '$customer_id', '$product_id',  '$unit', '$unit_price', 1, '$total_sale', '$notes', '$create_date', '$user_id')" ;
                    mysqli_query($db, $query_2);

                    }
            }

            header('location: ../wutb_sale_main.php');
        }

    // New Bake Advance

        if(isset($_POST['new_bake_advance'])){

            $user_id = $_POST['user_id'];
            $product_id = $_POST['product_id']; 
            $cat_id = $_POST['cat_id'];   
            $unit = $_POST['unit'];
            $date = date("Y-m-d");

            $query = mysqli_query($db, "INSERT INTO wutb_db_sale (cat_id, product_id, unit, create_date, create_by) VALUES ('$cat_id', '$product_id', '$unit', '$date', '$user_id')");

            header('location: ../wutb_sale_main.php');

        }


    // Approval all
    if(isset($_GET['approve_all_rec'])){
        $rec_date = $_GET['approve_all_rec'];
        $user_id = $_GET['user_id'];
        $date = date("Y-m-d");

        mysqli_query($db, "UPDATE wutb_db_sale SET check_by = '$user_id', check_date = '$date' WHERE create_date = '$rec_date' AND check_by = ' '");

            header('location: ../wutb_sale_detail.php?date='.$rec_date.'');

    }