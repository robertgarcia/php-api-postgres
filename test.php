<?php
    require 'config/database.php';
    $database = new Database();
    try {
        $database->get()->connect();
        //Connection::get()->connect();
        echo 'A connection to the PostgreSQL database sever has been established successfully.';
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
?>
