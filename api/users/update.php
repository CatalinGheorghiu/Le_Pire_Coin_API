<?php //  /resources/users/update-one.php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';


//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate DB & connect
$user = new User($db);

//Get raw posted data
$data = json_decode((file_get_contents('php://input')));

//Set ID to update
$user->id = $data->id;
$user->name = $data->name;
$user->email = $data->email;

//Update User
if ($user->update()) {
    echo json_encode(
        [
            'message' => 'User Updated'
        ]
    );
} else {
    echo json_encode(
        [
            'message' => 'User Not Updated'
        ]
    );
}



































// parse_str(file_get_contents('php://input'), $dataReceived);

// if (!array_key_exists('email', $dataReceived) or !array_key_exists('password', $dataReceived)) {
//     header($_SERVER['SERVER_PROTOCOL'] . ' 409 Conflict');
//     header('Content-Type: application/json');
//     echo json_encode(['message' => 'Champ(s) manquant(s)']);
//     exit;
// }

// $email = trim($dataReceived['email']);
// $password = trim($dataReceived['password']);

// if (empty($email) or empty($password)) {
//     header($_SERVER['SERVER_PROTOCOL'] . ' 409 Conflict');
//     header('Content-Type: application/json');
//     echo json_encode(['message' => 'Champ(s) vide(s)']);
//     exit;
// }

// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     header($_SERVER['SERVER_PROTOCOL'] . ' 409 Conflict');
//     header('Content-Type: application/json');
//     echo json_encode(['message' => 'Adresse électronique non valide']);
//     exit;
// }

// $dbh = new PDO(
//     'mysql:host=localhost;dbname=Le_pire_coin;charset=utf8',
//     'root',
//     '',
//     [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     ]
// );

// $query =
//     '
//         UPDATE
//             Users
//         SET
//             email = :email,
//             hashedPassword = :hashedPassword
//         WHERE
//             id = :id
//     ';
// $sth = $dbh->prepare($query);
// $sth->bindValue(':email', $email, PDO::PARAM_STR);
// $sth->bindValue(':hashedPassword', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
// $sth->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
// $sth->execute();

// if ($sth->rowCount() == 0) {
//     header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
//     header('Content-Type: application/json');
//     echo json_encode(['message' => 'Utilisateur inexistant']);
//     exit;
// }

// $user =
//     [
//         'id' => $_GET['id'],
//         'email' => $email
//     ];

// header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
// header('Content-Type: application/json');
// echo json_encode($user);
// exit;
