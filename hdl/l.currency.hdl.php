<?php

include "connect.hdl.php";

// >>>> >>>> Currency <<<< <<<<
    // View
        $currency_view = mysqli_query($db, "SELECT * FROM w_db_list_currency");
        $currency_view_2 = mysqli_query($db, "SELECT * FROM w_db_list_currency");
        
    // View Consol Currency Exchange
        $currency_exchange_view = mysqli_query($db, "SELECT r1.id, r1.currency_en, r1.currency_la, r2.buy_rate, r2.sell_rate, r2.create_date FROM (SELECT id, currency_en, currency_la FROM w_db_list_currency) as r1 LEFT JOIN (SELECT * FROM w_db_exchange_rate WHERE id IN (SELECT MAX(id) FROM w_db_exchange_rate GROUP BY currency_id)) as r2 ON r1.id = r2.currency_id ORDER BY r1.id");
    // Add
        if(isset($_POST['new_currency'])){
            $currency_en = $_POST['currency_en'];
            $currency_la = $_POST['currency_la'];

            $query = "INSERT INTO w_db_list_currency (currency_en, currency_la) VALUES ('$currency_en', '$currency_la')" ;
            mysqli_query($db, $query);
            header('location: ../w_l_currency.php');
        }
    // Edit
        if(isset($_POST['edit_currency'])){

            $id = $_POST['id'];
            $currency_en = $_POST['currency_en'];
            $currency_la = $_POST['currency_la'];

            $query = "INSERT INTO w_db_list_currency (currency_en, currency_la) VALUES ('$currency_en', '$currency_la')" ;
            $query = "UPDATE w_db_list_currency SET currency_en = '$currency_en', currency_la = '$currency_la' WHERE id = $id";
            mysqli_query($db, $query);
            header('location: ../w_l_currency.php');
        }

    // Remove
        if(isset($_GET['currency_del_id'])){
            $id = $_GET['currency_del_id'];
            mysqli_query($db, "DELETE FROM w_db_list_currency where id=$id");
            header('location: ../w_l_currency.php');
        }

    

// >>>> >>>> Exchange Rate <<<< <<<<
    // View
        $rate_view = mysqli_query($db, "SELECT * FROM w_db_exchange_rate ORDER BY id DESC");
    // Add
        if(isset($_POST['new_rate'])){
            $currency = $_POST['currency'];
            // $buy_rate = str_replace(",", "", $_POST['buy_rate']);
            // $sell_rate = str_replace(",", "", $_POST['sell_rate']);
            $buy_rate = $_POST['buy_rate'];
            $sell_rate = $_POST['sell_rate'];

            $query = "INSERT INTO w_db_exchange_rate (currency_id, buy_rate, sell_rate) VALUES ('$currency', '$buy_rate', '$sell_rate')" ;
            mysqli_query($db, $query);
            header('location: ../w_l_currency.php');
        }

    // Remove
        if(isset($_GET['ex_del_id'])){
            $id = $_GET['ex_del_id'];
            mysqli_query($db, "DELETE FROM w_db_exchange_rate where id=$id");
            header('location: ../w_l_exchange_rate.php');
        }