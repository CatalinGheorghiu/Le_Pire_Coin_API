<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// include_once '../../config/Database.php';
// include_once '../../models/Post.php';


//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate announces post object
$post = new Post($db);

//Get ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get post
$post->read_single();

//Create arrat 
$post_arr = [
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'name' => $post->name,

];

//Make JSON
print_r(json_encode($post_arr));
