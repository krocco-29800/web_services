<?php 

// Inclure le fichier user.php
require "./users.php";

// Vérification dela partie .htaccess
// echo "<pre>";
// var_dump($users);
// echo "</pre>";

// Récupérer la méthode HTTP et l'uri

// echo "<pre>";
// var_dump($_SERVER);
// var_dump("uri:",$_SERVER['REQUEST_URI']);
// var_dump("method:",$_SERVER['REQUEST_METHOD']);
// string(4) "uri:"
// string(31) "/PHP_Web_Services/users"
// string(7) "method:"
// string(3) "GET"
// echo "</pre>";

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Ajouter le header "application/json" à destination des navigateurs web
header('Content-Type: application/json');

// Routeur pour les différentes opérations CRUD
switch ($method){
    case 'GET': // http://localhost/PHP_Web_Services/users
        preg_match("/^\/PHP_Web_Services\/users\/?(\d+)?$/", $uri, $matches);

        if (!empty($matches) && !array_key_exists(1, $matches)) { 
            $users = getAll();
            // var_dump("getAll", $matches);
            // echo "<pre>";
            // var_dump($users);
            // echo "</pre>";
            echo json_encode($users);
            break;
        }
        if (!empty($matches) && array_key_exists(1, $matches)) {
            $user = getUserById((int)$matches[1]);
            // var_dump("getUserById", $matches);
            // echo "<pre>";
            // var_dump($user);
            // echo "</pre>";
            echo json_encode($user);
            break;
        }

        break; 
    case 'POST': 
        $user = $_POST;
        preg_match("/^\/PHP_Web_Services\/users\/?(\d+)?$/", $uri, $matches);
        $user = createUser($user);
        echo json_encode($user);
        // var_dump($_POST);
        break;

    case 'PATCH': 
        preg_match("/^\/PHP_Web_Services\/users\/?(\d+)?$/", $uri, $matches);
        $id = (int)$matches[1];
        $updates = file_get_contents('php://input');
        $items = explode('&', $updates);
        $data = [];
        foreach ($items as $item) {
            $inputs =explode('=', $item);
            $data[$inputs[0]] = $inputs[1];
        }
        $result = updateUser($id, $data);
        echo json_encode($result);
        break;
    case '': $response = deleteUser($id); break;
    default: 
        http_response_code(404); 
        echo "Ressource introuvable"; 
        break;
}


?>