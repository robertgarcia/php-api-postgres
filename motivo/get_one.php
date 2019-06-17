<?php 
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // include database and object files
    include_once '../config/database.php';
    include_once '../models/motivo.php';

    // get database connection
    $database = new Database();
    $db = $database->get()->connect();
    
    // initialize object
    $motivo = new Motivo($db);

    // set ID property of record to read
    $motivo->motivo = isset($_GET['id']) ? $_GET['id'] : die();
    $arr = $motivo->one();
    if(!empty($arr)){
         // set response code - 200 OK
        http_response_code(200);
 
        // make it json format
        echo json_encode($arr);
    }else{
        // set response code - 404 Not found
        http_response_code(404);
 
        // tell the user product does not exist
        echo json_encode(array("message" => "Info does not exist."));
    }


?>