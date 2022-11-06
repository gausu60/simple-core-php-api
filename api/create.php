<?php
// Include CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Content-Type: application/json');
// Include action.php file
require_once '../db.php';
// Create object of Users class
$user = new Database();
// create a api variable to get HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];
$id = intval($_GET['id'] ?? '');
if ($api == 'POST') {
    $name = $user->test_input($_POST['name']);
    $email = $user->test_input($_POST['email']);
    $phone = $user->test_input($_POST['phone']);

    if ($name!=""||$email!=""||$phone!="") {
        $user->insert($name, $email, $phone);
        echo $user->message('User added successfully!', false);
    } else {
        echo $user->message('Failed to add an user!', true);
    }
}
else{
    echo "Method Not Allowed!";
}
