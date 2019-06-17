<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // get database connection
    include_once '../config/database.php';
    
    // instantiate object
    include_once '../models/motivo.php';
    
    $database = new Database();
    $db = $database->get()->connect();
    
    $motivo = new Motivo($db);
    
    // get posted data
    $data = json_decode(file_get_contents("php://input"));

    // make sure data is not empty
    if(
        !empty($data->id) &&
        !empty($data->desc) &&
        !empty($data->estado) &&
        !empty($data->tipo)
    ){
    
        // set product property values
        $motivo->motivo = $data->id;
        $motivo->des_motivo = $data->desc;
        $motivo->estado = $data->estado;
        $motivo->tipo = $data->tipo;
    
        // create the product
        if($motivo->save()){
            // set response code - 201 created
            http_response_code(201);
    
            // tell the user
            echo json_encode(array("message" => "Product was created."));
        }else{ // if unable to create the product, tell the user
    
            // set response code - 503 service unavailable
            http_response_code(503);
    
            // tell the user
            echo json_encode(array("message" => "Unable to create info."));
        }
    }else{ // tell the user data is incomplete
        // set response code - 400 bad request
        http_response_code(400);
    
        // tell the user
        echo json_encode(array("message" => "Unable to create info. Data is incomplete."));
    }
?>