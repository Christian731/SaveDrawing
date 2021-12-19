<?php 

    require_once(dirname(__DIR__).'/vendor/autoload.php');
    use GuzzleHttp\Client;

    $config = simplexml_load_file(dirname(__DIR__).'/client/GuzzleConfig.xml');
    
    $client = new Client([
        'base_uri' => "$config->baseURI",
        'timeout' => $config->timeout,
    ]);
    
    echo "\nPOST request\n";

    $request = file_get_contents(dirname(__DIR__).'/client/PostRequest.json');
    $reponse = $client->request('POST', 'file/', 
    ['headers' => ['Content-Type' => 'application/json'],
    'body' => $request]);
    echo $reponse->getBody();
?>