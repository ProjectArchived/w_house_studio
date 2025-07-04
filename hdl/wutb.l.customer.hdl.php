<?php

include "connect.hdl.php";

// >>>> >>>> Customer <<<< <<<<
    // View
        $customer_view = mysqli_query($db, "SELECT * FROM wutb_db_list_customer ORDER BY id DESC");
    // Add
        if(isset($_POST['new_customer'])){
            
            $sub_id = $_POST['sub_id'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $branch = $_POST['branch'];
            $phone_no = $_POST['phone_no'];
            $location = $_POST['location'];

            if(empty($sub_id)){

            // if no sub id value available
            $check_sub_id = mysqli_query($db, "SELECT max(sub_id) as max_sub_id FROM wutb_db_list_customer");
            $sub_id = mysqli_fetch_array($check_sub_id);
            $new_sub_id =  $sub_id['max_sub_id'] + 1;

            $query = "INSERT INTO wutb_db_list_customer(sub_id, type, name, branch, phone_no, location) VALUES ('$new_sub_id', '$type', '$name', '$branch', '$phone_no', '$location')" ;
            mysqli_query($db, $query);

            } else {

            // if sub id value available
                $query = "INSERT INTO wutb_db_list_customer(sub_id, type, name, branch, phone_no, location) VALUES ('$sub_id', '$type', '$name', '$branch', '$phone_no', '$location')" ;
                mysqli_query($db, $query);
            }

            header('location: ../wutb_l_customer.php');

        }

    // Update

        if(isset($_POST['edit_customer'])){
            
            $id = $_POST['id'];
            $sub_id = $_POST['sub_id'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $branch = $_POST['branch'];
            $phone_no = $_POST['phone_no'];
            $location = $_POST['location'];

            $query = "UPDATE wutb_db_list_customer SET sub_id = '$sub_id', type = '$type', name = '$name', branch = '$branch',  phone_no = '$phone_no', location = '$location' WHERE id = $id";

            mysqli_query($db, $query);

            header('location: ../wutb_l_customer.php');

        }

    // Remove
        if(isset($_GET['customer_del_id'])){
            $id = $_GET['customer_del_id'];
            mysqli_query($db, "DELETE FROM wutb_db_list_customer where id=$id");
            header('location: ../wutb_l_customer.php');
        }



    // Cat view
        $ccat_view = mysqli_query($db, "SELECT * FROM wutb_db_list_customer_cat");

    // New expense cat
        if(isset($_POST['new_customer_cat'])){
            $desc_la = $_POST['desc_la'];

            $query = "INSERT INTO wutb_db_list_customer_cat (desc_la) VALUES ('$desc_la')" ;
            mysqli_query($db, $query);
            header('location: ../wutb_l_customer_cat.php');
        }

    // del
        if(isset($_GET['ccat_del_id'])){
            $id = $_GET['ccat_del_id'];
            mysqli_query($db, "DELETE FROM wutb_db_list_customer_cat where id=$id");
            header('location: ../wutb_l_customer_cat.php');
        }

    // Confirm stock record
        if(isset($_POST['edit_ccat'])){
            $id = $_POST['id'];
            $desc_la = $_POST['desc_la'];
            date_default_timezone_set("Asia/Bangkok");
            mysqli_query($db, "UPDATE wutb_db_list_customer_cat SET desc_la = '$desc_la' WHERE id=$id");
            header('location: ../wutb_l_customer_cat.php');
        }