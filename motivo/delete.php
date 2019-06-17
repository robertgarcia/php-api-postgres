<?php 

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../models/motivo.php';

// get database connection
$database = new Database();
$db = $database->get()->connect();

// prepare object
$motivo = new Motivo($db);

// get id of data to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of data to be edited
$motivo->motivo = $data->id;

//delete row
if($motivo->delete()){
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "data was deleted."));
}else{
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to delete data."));
}

?>