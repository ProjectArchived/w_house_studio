<?php

include "connect.hdl.php";

// >>>> >>>> Menu <<<< <<<<
    // View
        $menu_view = mysqli_query($db, "SELECT * FROM wutb_db_list_menu ORDER BY id ASC");

    // Add
        if(isset($_POST['new_menu'])){

            $type = $_POST['type'];
            $menu_en = $_POST['menu_en'];
            $menu_la = $_POST['menu_la'];

            $query = "INSERT INTO wutb_db_list_menu (type, menu_en, menu_la) VALUES ('$type','$menu_en', '$menu_la')" ;
            mysqli_query($db, $query);
            header('location: ../wutb_l_menu.php');
        }

    // Update
        if(isset($_POST['edit_menu'])){

            $id = $_POST['id'];
            $type = $_POST['type'];
            $menu_en = $_POST['menu_en'];
            $menu_la = $_POST['menu_la'];

            $query = "UPDATE wutb_db_list_menu SET type = '$type', menu_en = '$menu_en', menu_la = '$menu_la' WHERE id = $id";
            mysqli_query($db, $query);
            header('location: ../wutb_l_menu.php');
        }

    // Remove
        if(isset($_GET['menu_del_id'])){

            $id = $_GET['menu_del_id'];

            mysqli_query($db, "DELETE FROM wutb_db_list_menu where id=$id");
            header('location: ../wutb_l_menu.php');
        }

// >>>> >>>> Menu Price <<<< <<<<
    // View
        $menu_price_rec = mysqli_query($db, "SELECT * FROM wutb_db_list_menu_price ORDER BY id DESC");

    // New
        if(isset($_POST['new_price'])){

            $menu_id = $_POST['menu_id'];
            $cat_id = $_POST['cat_id'];
            $unit_price = str_replace(",", "", $_POST['unit_price']); 
            
            $query = "INSERT INTO wutb_db_list_menu_price (menu_id, cat_id, unit_price) VALUES ('$menu_id','$cat_id', '$unit_price')" ;
            mysqli_query($db, $query);
            header('location: ../wutb_l_menu_price.php');
        }

    // Del
        if(isset($_GET['price_del_id'])){

            $id = $_GET['price_del_id'];

            mysqli_query($db, "DELETE FROM wutb_db_list_menu_price where id=$id");
            header('location: ../wutb_l_menu_price.php');
        }

// >>>> >>>> Menu Price Category <<<< <<<<
    // View
        $menu_price_cat = mysqli_query($db, "SELECT * FROM wutb_db_list_price_cat ORDER BY id DESC");

        $price_cat_select = mysqli_query($db, "SELECT * FROM wutb_db_list_price_cat ORDER BY id ASC");

    // New
        if(isset($_POST['new_cat'])){
            $desc_la = $_POST['desc_la'];

            $query = "INSERT INTO wutb_db_list_price_cat (desc_la) VALUES ('$desc_la')" ;
            mysqli_query($db, $query);
            header('location: ../wutb_l_price_cat.php');
        }

    // edit
        if(isset($_POST['edit_cat'])){

            $id = $_POST['id'];
            $desc_la = $_POST['desc_la'];

            $query = "UPDATE wutb_db_list_price_cat SET desc_la = '$desc_la'WHERE id = $id";
            mysqli_query($db, $query);
            header('location: ../wutb_l_price_cat.php');
        }

    // del
        if(isset($_GET['cat_del_id'])){

            $id = $_GET['cat_del_id'];

            mysqli_query($db, "DELETE FROM wutb_db_list_price_cat where id=$id");
            header('location: ../wutb_l_price_cat.php');
        }

    // Select Price

        if(isset($_POST['price_check'])){

            $cat_id = $_POST['cat_id'];

            header('location: ../wutb_price_check.php?cat_id='.$cat_id.'');
        }

    // Cat view
        $mcat_view = mysqli_query($db, "SELECT * FROM wutb_db_list_price_cat");

    // New expense cat
        if(isset($_POST['new_menu_cat'])){
            $desc_la = $_POST['desc_la'];

            $query = "INSERT INTO wutb_db_list_menu_cat (desc_la) VALUES ('$desc_la')" ;
            mysqli_query($db, $query);
            header('location: ../wutb_l_menu_cat.php');
        }

    // del
        if(isset($_GET['mcat_del_id'])){
            $id = $_GET['mcat_del_id'];
            mysqli_query($db, "DELETE FROM wutb_db_list_menu_cat where id=$id");
            header('location: ../wutb_l_menu_cat.php');
        }

    // Confirm stock record
        if(isset($_POST['edit_mcat'])){
            $id = $_POST['id'];
            $desc_la = $_POST['desc_la'];
            date_default_timezone_set("Asia/Bangkok");
            mysqli_query($db, "UPDATE wutb_db_list_menu_cat SET desc_la = '$desc_la' WHERE id=$id");
            header('location: ../wutb_l_menu_cat.php');
        }