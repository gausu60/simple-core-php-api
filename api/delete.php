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

// get id from url
$id = intval($_GET['id'] ?? '');
// Get all or a single user from database
if ($api == 'DELETE') {
    if ($id != null) {
        if ($user->delete($id)) {
            echo $user->message('User deleted successfully!', false);
        } else {
            echo $user->message('Failed to delete an user!', true);
        }
    } else {
        echo $user->message('User not found!', true);
    }
}
else{
    echo "Method not allowed!";
}
