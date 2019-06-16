<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // include database and object files
    include_once '../config/database.php';
    include_once '../models/motivo.php';
    // instantiate database and motivo object
    $database = new Database();
    $db = $database->get()->connect();
    
    // initialize object
    $motivo = new Motivo($db);
    
    // query products
    $stmt = $motivo->all();
    if(empty($stmt)){
        // set response code - 404 Not found
        http_response_code(404);
        
        // tell the user no info found
        echo json_encode(
            array("message" => "No data found.")
        );
    }else{
        // set response code - 200 OK
        http_response_code(200);
 
        // show products data in json format
        echo json_encode($stmt);
    }

?>