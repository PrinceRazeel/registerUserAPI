<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');


include_once '../Database/config.php';
include_once '../Models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);
$output = $user->view();

$rCount = $output->rowCount();

if($rCount){
    $responseArray =  array();
    $responseArray['data'] = array();

    while( $row = $output->fetch(PDO::FETCH_OBJ)){

        $item = array(
            'id' => $row->id,
            'name' => $row->name,
            'email' => $row->email,  
        );

        array_push($responseArray['data'], $item);
    }

    echo json_encode($responseArray);

}else{
    echo json_encode(array('message' => 'no users'));
}