<?php

include "connect.hdl.php";

// >>>> >>>> Meter <<<< <<<<
    // View
        $meter_view = mysqli_query($db, "SELECT * FROM w_db_list_meter");

    // Add
        if(isset($_POST['new_meter'])){
            $user_id = $_POST['user_id'];
            $cat_id = $_POST['cat_id'];
            $meter_no = $_POST['meter_no'];
            $account_no = $_POST['account_no'];
            $user_no = $_POST['user_no'];
            $name = $_POST['name'];
            $location = $_POST['location'];
            $m_call = $_POST['m_call'];

            $query = "INSERT INTO w_db_list_meter (cat_id, meter_no, account_no, user_no, name, location, emergency_call, create_by) VALUES ('$cat_id', '$meter_no', '$account_no', '$user_no','$name', '$location', '$m_call', '$user_id')" ;
            mysqli_query($db, $query);
            header('location: ../w_l_meter.php');
        }

    // Update
        if(isset($_POST['update_meter'])){
            $id = $_POST['id'];
            $cat_id = $_POST['cat_id'];
            $meter_no = $_POST['meter_no'];
            $account_no = $_POST['account_no'];
            $user_no = $_POST['user_no'];
            $name = $_POST['name'];
            $location = $_POST['location'];
            $m_call = $_POST['m_call'];

            $query = "UPDATE w_db_list_meter SET cat_id = '$cat_id', meter_no = '$meter_no', account_no = '$account_no', user_no = '$user_no', name = '$name', location = '$location', emergency_call = '$m_call' WHERE id = $id";
            mysqli_query($db, $query);
            header('location: ../w_l_meter.php');
        }

    // Remove
        if(isset($_GET['meter_del_id'])){
            $id = $_GET['meter_del_id'];
            mysqli_query($db, "DELETE FROM w_db_list_meter where id=$id");
            header('location: ../w_l_meter.php');
        }

// >>>> >>>> Service Category <<<< <<<<
    // View
        $view_service_cat = mysqli_query($db, "SELECT * FROM w_db_list_service");

    // Update
        if(isset($_POST['update_service_cat'])){
            $id = $_POST['id'];
            $description = $_POST['description'];
            $remark = $_POST['remark'];

            $query = "UPDATE w_db_list_service SET description = '$description', remark = '$remark' WHERE id = $id";
            mysqli_query($db, $query);
            header('location: ../w_l_servicecat.php');
        }

    // Add
        if(isset($_POST['new_service_cat'])){
            $description = $_POST['description'];
            $remark = $_POST['remark'];

            $query = "INSERT INTO w_db_list_service (description, remark) VALUES ('$description', '$remark')";
            mysqli_query($db, $query);
            header('location: ../w_l_servicecat.php');
        }

    // Remove
        if(isset($_GET['del_service_cat'])){
            $id = $_GET['del_service_cat'];
            mysqli_query($db, "DELETE FROM w_db_list_service where id=$id");
            header('location: ../w_l_servicecat.php');
        }