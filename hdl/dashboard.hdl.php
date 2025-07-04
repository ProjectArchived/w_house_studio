<?php

include "connect.hdl.php";

// >>>> >>>> Dashboard <<<< <<<<
// Total deposit
    $check_deposit = mysqli_query($db, "SELECT sum(amount) as sum_amount, currency FROM w_db_room_deposit WHERE withdraw_by = '' GROUP BY currency ");
// View Supplier
     $supplier_view = mysqli_query($db, "SELECT * FROM w_db_list_supplier ORDER BY id DESC");

// View National
    $national_view = mysqli_query($db, "SELECT * FROM w_db_list_country");

// >>>> >>>> Net Income <<<< <<<<
    // Check Income
        // Total Rental Income
            $check_rental = mysqli_query($db, "SELECT sum(total_rental) as total_rental FROM w_db_room_rental");
            $total_rental = mysqli_fetch_array($check_rental);

        // Total Electric Income
            $check_electric = mysqli_query($db, "SELECT sum(total_electric) as total_electric FROM w_db_room_electric");
            $total_electric = mysqli_fetch_array($check_electric);

        // Total Income
            $total_income = $total_rental['total_rental'] + $total_electric['total_electric'];


    // Check Expense
        // Total Electric Expense
            $check_bill = mysqli_query($db, "SELECT sum(total_bill) as total_bill FROM w_db_utility");
            $total_bill = mysqli_fetch_array($check_bill);

        // Total Purchasing Expense
            $check_purchase = mysqli_query($db, "SELECT sum(total_purchase) as total_purchase FROM w_db_stock WHERE cat_id = 1");
            $total_purchase = mysqli_fetch_array($check_purchase);

        // Total Expense
            $total_expense = $total_bill['total_bill'] + $total_purchase['total_purchase'];

    // Check Net Income
        $net = $total_income - $total_expense;

// Deposit view
    $v_deposit = mysqli_query($db, "SELECT* FROM
    (SELECT * FROM w_db_room_deposit WHERE withdraw_by = '') as r1 LEFT JOIN
    (SELECT * FROM w_db_room_customer_info) as r2 on r1.customer_id = r2.id ORDER BY r2.room_no ASC");

// Room Clean View
    $available_room = mysqli_query($db, "SELECT r1.id as r_id, r2.clean_date as clean_date FROM 
    (SELECT * FROM w_db_room_lobby WHERE r_status = '0') as r1 LEFT JOIN 
    (SELECT * FROM w_db_room_clean WHERE id IN (SELECT Max(id) FROM w_db_room_clean GROUP BY room_no)) as r2 ON r1.id = r2.room_no ORDER BY r1.id ASC");

// Upcoming Electric
    $upcom_elec = mysqli_query($db, "SELECT r1.id as room, r2.start_date, r3.next_payment, if(ISNULL(r3.next_payment), DATE_ADD(r2.start_date, INTERVAL 1 MONTH), r3.next_payment) as forecast FROM 
    (SELECT * FROM w_db_room_lobby WHERE r_status = '1') as r1 LEFT JOIN
    (SELECT * FROM w_db_room_rental WHERE id IN (SELECT Max(id) FROM w_db_room_rental GROUP BY customer_id)) as r2 ON r1.customer_id = r2.customer_id LEFT JOIN
    (SELECT * FROM w_db_room_electric WHERE id IN (SELECT Max(id) FROM w_db_room_electric GROUP BY customer_id)) as r3 ON r1.customer_id = r3.customer_id ORDER BY forecast ASC");

// Upcoming Room Fee
    $upcom_fee = mysqli_query($db, "SELECT r1.id as room, r2.start_date, r2.end_date FROM 
    (SELECT * FROM w_db_room_lobby WHERE r_status = '1') as r1 LEFT JOIN
    (SELECT * FROM w_db_room_rental WHERE id IN (SELECT Max(id) FROM w_db_room_rental GROUP BY customer_id)) as r2 ON r1.customer_id = r2.customer_id ORDER BY end_date");

// Income and Expense Per Month
    $net_sum_month = mysqli_query($db, "SELECT r1.year, r1.month, ifnull(r1.total_rental, 0) as total_rental, ifnull(r2.total_electric, 0) as total_electric, ifnull(r3.total_purchase, 0) as total_purchase, ifnull(r4.total_bill, 0) as total_bill, (ifnull(r1.total_rental, 0) + ifnull(r2.total_electric, 0)) - (ifnull(r3.total_purchase, 0) + ifnull(r4.total_bill, 0)) as total  FROM
    (SELECT year(start_date) as year, month(start_date) as month, sum(total_rental) as total_rental FROM w_db_room_rental GROUP BY year(start_date), month(start_date) ORDER BY year(start_date) DESC, month(start_date) DESC) as r1 LEFT JOIN
    (SELECT month(end_date) as month, year(end_date) as year, sum(total_electric) as total_electric FROM w_db_room_electric GROUP BY year(end_date), month(end_date) ORDER BY year(end_date) DESC, month(end_date) DESC) as r2 ON r1.year = r2.year AND r1.month = r2.month LEFT JOIN
    (SELECT month(create_date) as month, year(create_date) as year, sum(total_purchase) as total_purchase FROM w_db_stock WHERE cat_id = 1 GROUP BY year(create_date), month(create_date) ORDER BY year(create_date) DESC, month(create_date) DESC) as r3 ON r1.year = r3.year AND r1.month = r3.month LEFT JOIN
    (SELECT year, month, sum(total_bill) as total_bill FROM w_db_utility GROUP BY year, month) as r4 ON r1.year = r4.year AND r1.month = r4.month");

// Income and Expense Per Year
    $net_sum_year = mysqli_query($db, "SELECT r1.year, ifnull(r1.total_rental, 0) as total_rental, ifnull(r2.total_electric, 0) as total_electric, ifnull(r3.total_purchase, 0) as total_purchase, ifnull(r4.total_bill, 0) as total_bill, (ifnull(r1.total_rental, 0) + ifnull(r2.total_electric, 0)) - (ifnull(r3.total_purchase, 0) + ifnull(r4.total_bill, 0)) as total  FROM
    (SELECT year(start_date) as year, sum(total_rental) as total_rental FROM w_db_room_rental GROUP BY year(start_date) ORDER BY year(start_date) DESC) as r1 LEFT JOIN
    (SELECT year(end_date) as year, sum(total_electric) as total_electric FROM w_db_room_electric GROUP BY year(end_date) ORDER BY year(end_date) DESC) as r2 ON r1.year = r2.year LEFT JOIN
    (SELECT year(create_date) as year, sum(total_purchase) as total_purchase FROM w_db_stock WHERE cat_id = 1 GROUP BY year(create_date) ORDER BY year(create_date) DESC) as r3 ON r1.year = r3.year LEFT JOIN
    (SELECT year, sum(total_bill) as total_bill FROM w_db_utility GROUP BY year) as r4 ON r1.year = r4.year ");

// Note
    $note_view = mysqli_query($db, "SELECT r1.room_no, r2.notes FROM (SELECT * FROM w_db_room_customer_info) as r1 LEFT JOIN (SELECT * FROM w_db_room_note) as r2 ON r1.id = r2.customer_id WHERE r2.notes IS NOT NULL");
