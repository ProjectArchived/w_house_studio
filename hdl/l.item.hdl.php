<?php

include "connect.hdl.php";

// >>>> >>>> Item <<<< <<<<
    // View
        $item_view = mysqli_query($db, "SELECT * FROM w_db_list_item ORDER BY id DESC");

    // Add
        if(isset($_POST['new_item'])){
            $cat_id = $_POST['cat_id'];
            $item_en = $_POST['item_en'];
            $item_la = $_POST['item_la'];
            $room_use = $_POST['room_use'];
            $s_unit = $_POST['s_unit'];

            $query = "INSERT INTO w_db_list_item(cat_id, item_en, item_la, room_use, s_unit) VALUES ('$cat_id','$item_en', '$item_la', '$room_use', '$s_unit')" ;
            mysqli_query($db, $query);
            header('location: ../w_l_item.php');
        }

    // Update
        if(isset($_POST['edit_item'])){
            $id = $_POST['id'];
            $cat_id = $_POST['cat_id'];
            $item_en = $_POST['item_en'];
            $item_la = $_POST['item_la'];
            $room_use = $_POST['room_use'];
            $s_unit = $_POST['s_unit'];

            $query = "UPDATE w_db_list_item SET cat_id = '$cat_id', item_en = '$item_en', item_la = '$item_la',  room_use = '$room_use', s_unit = '$s_unit' WHERE id = $id";
            mysqli_query($db, $query);
            header('location: ../w_l_item.php');
        }

    // Remove
        if(isset($_GET['item_del_id'])){
            $id = $_GET['item_del_id'];
            mysqli_query($db, "DELETE FROM w_db_list_item where id=$id");
            header('location: ../w_l_item.php');
        }

