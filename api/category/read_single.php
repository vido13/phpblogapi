<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    $cat = new Category($db);

    $cat->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    $result = $cat->read_single();

    $row = $result->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $cat_arr = array(
        'name' => $row['name']
    );

    print_r(json_encode($cat_arr));