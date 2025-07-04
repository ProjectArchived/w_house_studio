<?php

include "connect.hdl.php";

//  >>>> >>>> Customer <<<< <<<<
    // View Customer
        $customers_detail = mysqli_query($db, "SELECT r1.id, r1.room_no, CONCAT(r1.fname, ' ',r1.lname) as name, r1.gender, r1.nationality, r1.phone_no, r1.id_no, r1.id_start_date, r1.id_end_date, r2.e_unit, r2.checkin_date, r2.checkout_date, r1.check_by FROM (SELECT * FROM w_db_room_customer_info) as r1 LEFT JOIN (SELECT * FROM w_db_room_room_info WHERE id IN (SELECT MAX(id) FROM w_db_room_room_info)) as r2 ON r1.id = r2.customer_id ORDER BY r1.check_by = ' ' DESC, r1.id DESC");

//  >>>> >>>> Country <<<< <<<<
    // Add
        if(isset($_POST['new_country'])){
            $country_en = $_POST['country_en'];
            $country_la = $_POST['country_la'];
            $national_en = $_POST['national_en'];

            $query = "INSERT INTO w_db_list_country(country_en, country_la, national_en) VALUES ('$country_en', '$country_la', '$national_en')" ;
            mysqli_query($db, $query);
            header('location: ../w_l_country.php');
        }

    // Remove
        if(isset($_GET['country_del_id'])){
            $id = $_GET['country_del_id'];
            mysqli_query($db, "DELETE FROM w_db_list_country where id=$id");
            header('location: ../w_l_country.php');
        }

    // Check
        if(isset($_GET['customer_check_id'])){
            $id = $_GET['customer_check_id'];
            $user_id = $_GET['user_id'];
            date_default_timezone_set("Asia/Bangkok");
            $check_date = date("Y-m-d");
            mysqli_query($db, "UPDATE w_db_room_customer_info SET check_by = '$user_id', check_date = '$check_date' WHERE id=$id");
            header('location: ../w_room_customers.php');
        }   

// >>>> >>>> Record <<<< <<<<

    // View Rental Fee
        $view_customer_rental = mysqli_query($db,"SELECT r1.id as id, r2.room_no as room_no, r1.customer_id as customer_id, r1.contract_no as contract_no, r1.start_date as start_date, r1.end_date as end_date, r1.currency as currency, r1.paid_amount as paid_amount, r1.create_date as create_date FROM
        (SELECT * FROM w_db_room_rental) as r1 LEFT JOIN 
        (SELECT * FROM w_db_room_customer_info) as r2 ON r1.customer_id = r2.id ORDER BY r1.id DESC");

    // View Electric Fee
        $view_customer_electric = mysqli_query($db,"SELECT * FROM w_db_room_electric ORDER BY id DESC");

    // View Room Info
        $view_room_info = mysqli_query($db,"SELECT r2.id, CONCAT(r1.fname, ' ',r1.lname) as name, r2.room_no, r2.e_date, r2.e_unit, r2.checkin_date, r2.checkout_date, r2.clean_date FROM 
        (SELECT * FROM w_db_room_customer_info) as r1 LEFT JOIN 
        (SELECT * FROM w_db_room_room_info) as r2 ON r1.id = r2.customer_id ORDER BY r2.id DESC");
