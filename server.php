<?php

// Définition des fonctions du service (ex. fonction addition)
function getAllProducts() {
    $products = file_get_contents('http://localhost/PHP_Web_Services/products.php');
    $products = json_decode($products, true);
    return $products;
}

function getProductsById(int $id) {
    $products = file_get_contents('http://localhost/PHP_Web_Services/products.php');
    $products = json_decode($products, true);
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
}

function addProducts(array $products) {
    $products = file_get_contents('http://localhost/PHP_Web_Services/products.php');
    $products = json_decode($products, true);
    $products[] = $products;
    file_put_contents('http://localhost/PHP_Web_Services/products.php', json_encode($products));
    return $products;
}

function deleteProducts(int $id) {
    $products = file_get_contents('http://localhost/PHP_Web_Services/products.php');
    $products = json_decode($products, true);
    foreach ($products as $key => $product) {
        if ($product['id'] == $id) {
            unset($products[$key]);
        }
    }
}

//Creation du serveur SOAP
// Définition du tableau d'option (uro, encoding...)
$options = [
    'uri' => 'http://localhost/PHP_Web_Services/server.php',
    'encoding' => 'UTF-8'
];
// Instancier le serveur avec la class SoapServer de PHP
$server = new SoapServer(null, $options); 
// Définition des méthodes du service avec la fonction addFuction
$server->addFunction('getAllProducts');
$server->addFunction('getProductsById');
$server->addFunction('addProducts');
$server->addFunction('deleteProducts');
// Lancement du serveur du serveur pour la gestion des requêtes SOAP
$server->handle();

// création du fichier soapServer.php

// Définir les fonctions pemettant d'implémenter nos fonctionnalités
// Création du serveur SOAP
// Définition des fonctions dans le serveur
// Lancement du serveur 