<?php

include "connect.hdl.php";

    // Total Income
        $check_sale = mysqli_query($db, "SELECT sum(total_sale) as total_sale FROM wutb_db_sale WHERE cat_id = 1");
        $total_sale = mysqli_fetch_array($check_sale);

    // Total Expense 

        $check_expense = mysqli_query($db, "SELECT sum(total_purchase) as total_expense FROM wutb_db_expense WHERE cat_id = 1");
        $total_expense = mysqli_fetch_array($check_expense);

    // Total Net 

        $net = $total_sale['total_sale'] - $total_expense['total_expense'];

    // Check debt

        $check_debt = mysqli_query($db, "SELECT r1.id as id, r1.sub_id as sub_id, r1.name as name, ifnull(sum(r2.total_debt), 0) as total_debt, ifnull(sum(r3.total_payment), 0) as total_payment, ifnull(sum(r2.total_debt), 0) - ifnull(sum(r3.total_payment), 0) as remain_debt, r3.settle_date as settle_date FROM 
        (SELECT * FROM wutb_db_list_customer) as r1 LEFT JOIN 
        (SELECT customer_id, sum(total_sale) as total_debt FROM wutb_db_sale WHERE payment = 2 GROUP BY customer_id) as r2 on r1.id = r2.customer_id LEFT JOIN
        (SELECT customer_id, MAX(create_date) as settle_date, sum(total_sale) as total_payment FROM wutb_db_sale WHERE cat_id = 6 GROUP BY customer_id) as r3 on r1.id = r3.customer_id
        WHERE r2.total_debt > 0 GROUP BY sub_id");


    // Income and Expense 
        $net_sum = mysqli_query($db, "SELECT r1.month, r1.year, ifnull(r1.total_sale, 0) as total_sale, ifnull(r2.delivery_fee, 0) as delivery_fee, ifnull(r3.total_purchase, 0) as total_purchase, ifnull(r4.total_return, 0) as total_return, (ifnull(r1.total_sale, 0) + ifnull(r2.delivery_fee, 0) - ifnull(r3.total_purchase, 0) - ifnull(r4.total_return, 0)) as total FROM 
        (SELECT month(create_date) month, year(create_date) as year, sum(total_sale) as total_sale FROM wutb_db_sale WHERE cat_id = 1 GROUP BY month(create_date), year(create_date)) as r1 LEFT JOIN 
        (SELECT month(create_date) month, year(create_date) as year, sum(delivery_fee) as delivery_fee FROM wutb_db_sale WHERE cat_id = 1 GROUP BY month(create_date), year(create_date)) as r2 ON r1.year = r2.year AND r1.month = r2.month LEFT JOIN
        (SELECT month(create_date) month, year(create_date) as year, sum(total_sale) as total_return FROM wutb_db_sale WHERE cat_id = 4 GROUP BY month(create_date), year(create_date)) as r4 ON r1.year = r4.year AND r1.month = r4.month LEFT JOIN
        (SELECT month(create_date) month, year(create_date) as year, sum(total_purchase) as total_purchase FROM wutb_db_expense WHERE cat_id = 1 GROUP BY month(create_date), year(create_date)) as r3 ON r1.year = r3.year AND r1.month = r3.month ORDER BY r1.year DESC, r2.month DESC");



    // Income per product

        $per_product = mysqli_query($db,"SELECT r1.year as year, r1.month as month, r1.product_id as product_id, ifnull(r2.total_unit, 0) as total_unit_sale, ifnull(r3.total_return, 0) as total_unit_return, ifnull(r2.total_sale, 0) as total_sale, ifnull(r3.total_sale, 0) as total_return, ifnull(r2.total_sale, 0) - ifnull(r3.total_sale, 0) as total FROM
        (SELECT year(create_date) as year, month(create_date) as month, product_id as product_id FROM wutb_db_sale WHERE cat_id = 1 OR cat_id = 4 GROUP BY year(create_date) DESC, month(create_date) DESC, product_id DESC) as r1 LEFT JOIN
        (SELECT year(create_date) as year, month(create_date) as month, product_id as product_id, sum(total_sale) as total_sale, sum(unit) as total_unit FROM wutb_db_sale WHERE cat_id = 1 GROUP BY year(create_date) DESC, month(create_date) DESC, product_id DESC) as r2 ON r1.year = r2.year AND r1.month = r2.month AND r1.product_id = r2.product_id LEFT JOIN
        (SELECT year(create_date) as year, month(create_date) as month, product_id as product_id, sum(total_sale) as total_sale, sum(unit) as total_return FROM wutb_db_sale WHERE cat_id = 4 GROUP BY year(create_date) DESC, month(create_date) DESC, product_id DESC) as r3 ON r1.year = r3.year AND r1.month = r3.month AND r1.product_id = r3.product_id");

    // Income per customer

        $per_customer = mysqli_query($db,"SELECT r1.year as year, r1.month as month, r1.customer_id as customer_id, ifnull(r2.total_unit, 0) as total_unit_sale, ifnull(r3.total_return, 0) as total_unit_return, ifnull(r2.total_sale, 0) as total_sale, ifnull(r3.total_sale, 0) as total_return, ifnull(r2.total_sale, 0) - ifnull(r3.total_sale, 0) as total FROM
        (SELECT year(create_date) as year, month(create_date) as month, customer_id as customer_id FROM wutb_db_sale WHERE cat_id = 1 OR cat_id = 4 GROUP BY year(create_date) DESC, month(create_date) DESC, customer_id DESC) as r1 LEFT JOIN
        (SELECT year(create_date) as year, month(create_date) as month, customer_id as customer_id, sum(total_sale) as total_sale, sum(unit) as total_unit FROM wutb_db_sale WHERE cat_id = 1 GROUP BY year(create_date) DESC, month(create_date) DESC, customer_id DESC) as r2 ON r1.year = r2.year AND r1.month = r2.month AND r1.customer_id = r2.customer_id LEFT JOIN
        (SELECT year(create_date) as year, month(create_date) as month, customer_id as customer_id, sum(total_sale) as total_sale, sum(unit) as total_return FROM wutb_db_sale WHERE cat_id = 4 GROUP BY year(create_date) DESC, month(create_date) DESC, customer_id DESC) as r3 ON r1.year = r3.year AND r1.month = r3.month AND r1.customer_id = r3.customer_id");
