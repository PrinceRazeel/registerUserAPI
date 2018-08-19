<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers , Content-type, Access-Control-Allow-Methods, X-Requested-With ');

include_once '../Models/Authenticate.php';

$data = json_decode(file_get_contents("php://input"));
$headers = getallheaders();

$auth = new Authenticate();

//checking for user, would use a query for look up with database of users and passwords
// for the purpose of this task, we will just use the name zain as an authorized user
if($data->name == 'zain'){
  
$jwt = $auth->encrypt($data->name);

//echo $headers['Authorization'];

$username= $auth->decrypt($headers['Authorization']);
echo $username->user_name;
echo json_encode(array('token'=> $jwt));
}else{
    echo json_encode(array('message'=> 'error, input is invalid'));

}


