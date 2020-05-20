<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';


//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate announces post object
$post = new Post($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//
$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->user_id = $data->user_id;

//Create Post
if ($post->create()) {
    echo json_encode(
        [
            'message' => 'Post Created'
        ]
    );
} else {
    echo json_encode(
        [
            'message' => 'Post Not Created'
        ]
    );
}
