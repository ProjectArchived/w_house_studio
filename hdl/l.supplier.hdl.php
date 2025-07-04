<?php

include "connect.hdl.php";

// >>>> >>>> National <<<< <<<<
    // View
        $national_view = mysqli_query($db, "SELECT * FROM w_db_list_country");

// >>>> >>>> Supplier <<<< <<<<
    // View
        $supplier_view = mysqli_query($db, "SELECT * FROM w_db_list_supplier ORDER BY id DESC");

    // Add
        if(isset($_POST['new_supplier'])){
            $country = $_POST['country'];
            $location = $_POST['location'];
            $phone_no = $_POST['phone_no'];

            $query = "INSERT INTO w_db_list_supplier(country, location, phone_no) VALUES ('$country', '$location', '$phone_no')" ;
            mysqli_query($db, $query);
            header('location: ../w_l_supplier.php');
        }

    // Update
        if(isset($_POST['edit_supplier'])){
            $id = $_POST['id'];
            $country = $_POST['country'];
            $location = $_POST['location'];
            $phone_no = $_POST['phone_no'];

            $query = "UPDATE w_db_list_supplier SET country = '$country', location = '$location', phone_no = '$phone_no' WHERE id = $id";
            mysqli_query($db, $query);
            header('location: ../w_l_supplier.php');
        }

    // Remove
        if(isset($_GET['supplier_del_id'])){
            $id = $_GET['supplier_del_id'];
            mysqli_query($db, "DELETE FROM w_db_list_supplier where id=$id");
            header('location: ../w_l_supplier.php');
        }

