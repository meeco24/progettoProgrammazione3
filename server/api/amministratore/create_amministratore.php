<?php

// get posted data
$data = json_decode(file_get_contents("php://input"));

$amministratore->admin_name = $data->admin_name;
$amministratore->password = $data->password;

try {
    
    $amministratore->create();

    echo json_encode(array("message" => "amministratore creato."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo $e->getMessage();
    http_response_code(500);
    die;

}

?>