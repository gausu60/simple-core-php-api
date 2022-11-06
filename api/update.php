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
if ($api == 'PUT') {
    parse_str(file_get_contents('php://input'), $post_input);

    $name = $user->test_input($post_input['name']);
    $email = $user->test_input($post_input['email']);
    $phone = $user->test_input($post_input['phone']);

    if ($id != null) {
        if ($user->update($name, $email, $phone, $id)) {
            echo $user->message('User updated successfully!', false);
        } else {
            echo $user->message('Failed to update an user!', true);
        }
    } else {
        echo $user->message('User not found!', true);
    }
} else {
    echo "Method Not Allowed!";
}
