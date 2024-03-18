<?php
$products = [
    [
        "id" => 1,
        "marque" => "Product 1",
        "model" => "Model 1",
        "dscription" => "Description 1",
        "price" => 100
    ],
    [
        "id" => 2,
        "marque" => "Product 2",
        "model" => "Model 2",
        "dscription" => "Description 2",
        "price" => 45
    ],
    [
        "id" => 3,
        "marque" => "Product 3",
        "model" => "Model 3",
        "dscription" => "Description 3",
        "price" => 99.99
    ],
    [
        "id" => 4,
        "marque" => "Product 4",
        "model" => "Model 4",
        "dscription" => "Description 4",
        "price" => 67
    ],
];

// Vérifier la méthode HTTP
if($_SERVER["REQUEST_METHOD"] ==="GET") { 
    // Le contenttype approprié
    header("Content-type: application/json");
    //header("Access-Control-Allow-Origin: *"); 
    // Permet d'acceder depuis n'importe quelle origine au données de notre site, 
    //n'importe qui peut accéder à nos données, mêmes celles de sécuritées

    // Envoie les données des produits ($products) au format JSON
    echo json_encode($products);
}
// Autre actions à gérer pour d'autres méthodes HTTP
// Méthods non autorisées