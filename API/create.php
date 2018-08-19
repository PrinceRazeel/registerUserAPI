<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers , Content-type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');


include_once '../Database/config.php';
include_once '../Models/User.php';
include_once '../Models/Authenticate.php';

$database = new Database();
$db = $database->connect();
$auth = new Authenticate();



// authenticating jwt
$headers = getallheaders();
$username= $auth->decrypt($headers['Authorization']);
$username= $username->user_name;
$jwt = $auth->encrypt($username);

// if jwt received from header is the same as the one that we encrypt then they have the same secret key
if($jwt == $headers['Authorization']){
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
$user->name = $data->name;
$user->email = $data->email;
$user->age = $data->age;




if($user->create()){
    echo json_encode(array('status'=>true, "ErrorMessage"=>''));
}else{
    echo json_encode(array('status'=>false, "ErrorMessage"=>'unable to create user'));
}

}else{
    echo json_encode(array('status'=>false, "ErrorMessage"=>'unauthenticated'));
}