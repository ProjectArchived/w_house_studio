<?php

include "connect.hdl.php";


// >>>> >>>> Expense <<<< <<<<
    // View
        $expense_view = mysqli_query($db, "SELECT * FROM wutb_db_list_expense ORDER BY cat_id ASC, id ASC");
        
    // Add
        if(isset($_POST['new_expense'])){
            $cat_id = $_POST['cat_id'];
            $desc_la = $_POST['desc_la'];

            $query = "INSERT INTO wutb_db_list_expense(cat_id, desc_la) VALUES ('$cat_id', '$desc_la')" ;

            mysqli_query($db, $query);

            header('location: ../wutb_l_expense.php');

        }

    // Update
        if(isset($_POST['edit_expense'])){
            $id = $_POST['id'];
            $cat_id = $_POST['cat_id'];
            $desc_la = $_POST['desc_la'];

            $query = "INSERT INTO wutb_db_list_expense(cat_id, desc_la) VALUES ('$cat_id', '$desc_la')" ;

            $query = "UPDATE wutb_db_list_expense SET cat_id = '$cat_id', desc_la = '$desc_la' WHERE id = $id";

            mysqli_query($db, $query);

            header('location: ../wutb_l_expense.php');

        }

    // Remove
        if(isset($_GET['expense_del_id'])){
            $id = $_GET['expense_del_id'];
            mysqli_query($db, "DELETE FROM wutb_db_list_expense where id=$id");
            header('location: ../wutb_l_expense.php');
        }

