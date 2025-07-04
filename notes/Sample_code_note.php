<?php

// -------- -------- -------- -------- -------- -------- --------
// -------- -------- -------- -------- -------- -------- --------
// -------- -------- -------- -- PHP -- -------- -------- --------
// -------- -------- -------- -------- -------- -------- --------
// -------- -------- -------- -------- -------- -------- --------

// Change date format
// 1
    $sd = $row['group_date'];
    $sd_c= date("d-m-Y", strtotime($sd));
    echo $sd_c; 


// Add 1 Month, select first day of + 1 month
$room_check = mysqli_query($db, "SELECT * FROM w_db_room_electric WHERE id = (SELECT max(id) FROM w_db_room_electric WHERE customer_id = '$customer_id')");
$room_r = mysqli_fetch_array($room_check);
if(!empty($room_r)){

$r_lb = $room_r['end_date'];
$r_lb_c= date("d-m-Y", strtotime($r_lb));
$next_payment = $room_r['next_payment'];
$r_np= date("d-m-Y", strtotime($next_payment));

// Check if customer ever paid electric or not
// if already paid


if(!empty($room_r['paid_receive_by'])){
    // if paid, date in gray
    echo 'ຄ່າໄຟຄັ້ງລ້າສຸດ: <span class="text-muted small pt-1 fw-bold">';
    echo  $r_lb_c;
    echo '</span><br>';
    // notify next payment
    echo 'ຄ່າໄຟຄັ້ງຕໍ່ໄປ: <span class="text-info small pt-1 fw-bold">';
    echo  $r_np;
    echo '</span><br>';

} else {
    // if not paid, date in red
    echo ' ຄ່າໄຟຄັ້ງລ້າສຸດ: <span class="text-danger small pt-1 fw-bold">';
    echo  $r_lb_c;
    echo '</span><br>';
    // notify next payment
    echo 'ຄ່າໄຟຄັ້ງຕໍ່ໄປ: <span class="text-info small pt-1 fw-bold">';
    echo  $r_np;
    echo '</span><br>';
}
} else {

// If new customer (never paid electric)

$room_check = mysqli_query($db, "SELECT customer_id, min(start_date) as s_d, max(end_date) as e_d FROM w_db_room_rental WHERE customer_id = '$customer_id'");
$room_r = mysqli_fetch_array($room_check);

$end_date = $room_r['s_d'];
$end_date_2 = strtotime($end_date);

// Add 1 Month to date
$month_add = date("Y-m-d", strtotime("+1 month", $end_date_2));
$month_add_c= date("d-m-Y", strtotime($month_add));


// Select Last date of next month
$month_add_2 = date("Y-m-d", strtotime("first day of +1 month", $end_date_2));
$month_add_last = date("Y-m-t", strtotime($month_add_2));
$month_add_last_c= date("d-m-Y", strtotime($month_add_last));

$date_1 = date("d", strtotime($end_date));
$date_2 = date("d", strtotime($month_add));

if($date_1 == $date_2){
    echo 'ຄ່າໄຟຄັ້ງຕໍ່ໄປ: <span class="text-info small pt-1 fw-bold">';
    echo $month_add_c;
    echo '</span><br>';
} else {
    echo 'ຄ່າໄຟຄັ້ງຕໍ່ໄປ: <span class="text-info small pt-1 fw-bold">';
    echo  $month_add_last_c;
    echo '</span><br>';
}


// -------- -------- -------- -------- -------- -------- --------
// -------- -------- -------- -------- -------- -------- --------
// -------- -------- -------- - MYSQL - -------- -------- --------
// -------- -------- -------- -------- -------- -------- --------
// -------- -------- -------- -------- -------- -------- --------

// Join Query and IS NULL
SELECT r1.id as r_id, r2.id FROM
(SELECT * FROM w_l_room) as r1 LEFT JOIN
(SELECT * FROM w_db_room_customer_info WHERE record_by = '') as r2 ON r1.id = r2.room_no WHERE r2.id IS NULL

// Ifnull change to
SELECT i1.id as id, i1.cat_id, i1.item_en as item_en, i1.item_la as item_la, ifnull(i2.p_u, 0) as u_purchase, ifnull(i3.r_u, 0) as u_return , ifnull(i4.add_u, 0) as u_add , ifnull(i5.d_u, 0) as u_dispose, (ifnull(i2.p_u, 0) + ifnull(i3.r_u, 0)) - (ifnull(i4.add_u, 0) + ifnull(i5.d_u, 0)) as total FROM (SELECT * FROM w_db_list_itemt_item) as i1 LEFT JOIN (SELECT item_id, sum(unit) as p_u FROM w_stock WHERE cat_id = 1 GROUP BY item_id) as i2 ON i1.id = i2.item_id LEFT JOIN (SELECT item_id, sum(unit) as r_u FROM w_stock WHERE cat_id = 2 GROUP BY item_id) as i3 ON i1.id = i3.item_id LEFT JOIN (SELECT item_id, sum(unit) as add_u FROM w_stock WHERE cat_id = 5 GROUP BY item_id) as i4 ON i1.id = i4.item_id LEFT JOIN (SELECT item_id, sum(unit) as d_u FROM w_stock WHERE cat_id = 4 GROUP BY item_id) as i5 ON i1.id = i5.item_id WHERE (ifnull(i2.p_u, 0) + ifnull(i3.r_u, 0)) - (ifnull(i4.add_u, 0) + ifnull(i5.d_u, 0)) > 0 ORDER BY i1.cat_id ASC

// Select last id 
// 1
SELECT * FROM w_db_room_electric WHERE id IN (SELECT MAX(id) FROM w_db_room_electric WHERE customer_id = $customer_id)

// Extract day, month, year
SELECT extract(DAY from start_date) as day, extract(MONTH from start_date) as month, extract(YEAR from start_date) as year, start_date FROM w_db_room_rental WHERE customer_id = $customer_id