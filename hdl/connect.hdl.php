<?php

// >>>> >>>> Connection <<<< <<<<
// Local Connection

    // $db = mysqli_connect('localhost', 'root', '', 'w_project');

// Online Server Connection (Main)
    $db = mysqli_connect('localhost', 'alterndc_studiohouse', '@WStudiohouse8888', 'alterndc_studiohouse');

// Online Server Connection (Test)
    // $db = mysqli_connect('localhost', 'alterndc_studiohouse_trial', '@WSugarboy1989', 'alterndc_studiohouse_trial');


mysqli_set_charset($db,"utf8");