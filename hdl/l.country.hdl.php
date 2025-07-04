<?php

include "connect.hdl.php";

// >>>> >>>> Country <<<< <<<<
    // View
        $country_view = mysqli_query($db, "SELECT * FROM w_db_list_country");

    // Add
        if(isset($_POST['new_country'])){
            $country_en = $_POST['country_en'];
            $country_la = $_POST['country_la'];
            $national_en = $_POST['national_en'];
            $national_la = $_POST['national_la'];

            $query = "INSERT INTO w_db_list_country(country_en, country_la, national_en, national_la) VALUES ('$country_en', '$country_la', '$national_en', '$national_la')" ;
            mysqli_query($db, $query);
            header('location: ../w_l_country.php');
        }

    // Update
        if(isset($_POST['edit_country'])){
            $id = $_POST['id'];
            $country_en = $_POST['country_en'];
            $country_la = $_POST['country_la'];
            $national_en = $_POST['national_en'];
            $national_la = $_POST['national_la'];

            $query = "UPDATE w_db_list_country SET country_en = '$country_en', country_la = '$country_la', national_en = '$national_en',  national_la = '$national_la' WHERE id = $id";
            mysqli_query($db, $query);
            header('location: ../w_l_country.php');
        }

    // Remove
        if(isset($_GET['country_del_id'])){
            $id = $_GET['country_del_id'];
            mysqli_query($db, "DELETE FROM w_db_list_country where id=$id");
            header('location: ../w_l_country.php');
        }


