<?php
header("Content-Type: application/json");

require '../src/Database.php';
require '../src/Api.php';

$blogApi = new Api();

$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$resource = $requestUri[0];
$id = $requestUri[1] ?? null;

switch ($requestMethod) {
    case 'GET':
        if ($resource === 'posts' && $id) {
            echo json_encode($blogApi->getPost($id));
        } elseif ($resource === 'posts') {
            echo json_encode($blogApi->getPosts());
        } else {
            echo json_encode(["message" => "Endpoint not found"]);
        }
        break;
    case 'POST':
        if ($resource === 'posts') {
            $input = json_decode(file_get_contents('php://input'), true);
            echo json_encode($blogApi->createPost($input));
        } else {
            echo json_encode(["message" => "Endpoint not found"]);
        }
        break;
    case 'PUT':
        if ($resource === 'posts' && $id) {
            $input = json_decode(file_get_contents('php://input'), true);
            echo json_encode($blogApi->updatePost($id, $input));
        } else {
            echo json_encode(["message" => "Endpoint not found"]);
        }
        break;
    case 'DELETE':
        if ($resource === 'posts' && $id) {
            echo json_encode($blogApi->deletePost($id));
        } else {
            echo json_encode(["message" => "Endpoint not found"]);
        }
        break;
    default:
        echo json_encode(["message" => "Method not supported"]);
        break;
}
