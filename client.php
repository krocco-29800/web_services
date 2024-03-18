<?php
// soapClient.php

// Création du client SOAP
	// création d'un tableau d'options (uri, location)
    $options = [
        'location' => 'http://localhost/PHP_Web_Services/server.php',
        'uri' => 'http://localhost/PHP_Web_Services/client.php'
    ];
	// création du client avec la classe PHP SoapClient
	$client = new SoapClient(null, $options);
// Appel de la fonction du service avec la méthode __soapCall
    $result =$client->__soapCall('getAllProducts', []);
    //$result =$client->__soapCall('getProductsById', [2]);
// Affichage des résultats
echo "<pre>";
echo var_dump($result);
echo "</pre>";

?>
