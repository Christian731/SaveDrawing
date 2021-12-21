<?php

    // JustPi API Client. 
    
    require_once(dirname(__DIR__).'\\vendor\\autoload.php');
    use GuzzleHttp\Client;

    $config = simplexml_load_file(dirname(__DIR__, 1).'\\Config\\guzzleConf.xml');

    $clientName = "HelloWorld";
    $key = "tempKey123abc";
    $token = null; 

    $client = new Client([
        'base_uri' => "$config->baseURI",
        'timeout' => $config->timeout
    ]);

    if (false) {
        // Creates a new user with a client name and license key.
        $request = $client->request('POST', 'client/insert?licenseKey='.$key.'&clientName='.$clientName, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]
        );

        echo $request->getBody();
    }

    $request = $client->request('GET', 'auth/authorize?api='.$key.'&clientName='.$clientName, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]
    );

    $token = $request->getBody();

    echo "\n Getting all clients\n";

    // Getting all clients.
    $request = $client->request('GET', 'client/all', [
        'headers' => [
            'Authorization' => "Bearer ".$token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]
    ]
    );

    echo $request->getBody();

    echo "\n Getting client 1\n";

    // Getting client 1.
    $request = $client->request('GET', 'client/1', [
        'headers' => [
            'Authorization' => "Bearer ".$token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]
    ]
    );

    echo $request->getBody();

    echo "\n\n Getting all formula's\n";

    // Getting all Formula's
    $request = $client->request('GET', 'formula/all', [
        'headers' => [
            'Authorization' => "Bearer ".$token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]
    ]
    );

    echo $request->getBody();

    // TODO:

    // Getting a specified formula
    echo "\n\n Getting a specified formula\n";

    $request = $client->request('GET', 'formula/1', [
        'headers' => [
            'Authorization' => "Bearer ".$token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]
    ]
    );

    echo $request->getBody();

    // Getting all histories.
    echo "\n\n Getting all histories\n";
    $request = $client->request('GET', 'history/all', [
        'headers' => [
            'Authorization' => "Bearer ".$token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]
    ]
    );

    echo $request->getBody();

    // Getting specified history.
    echo "\n\n Getting a specified history\n";
    $request = $client->request('GET', 'history/1', [
        'headers' => [
            'Authorization' => "Bearer ".$token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]
    ]
    );

    echo $request->getBody();

    // Result of history.
    echo "\n\n Result of formula operation\n";
    $request = $client->request('POST', 'formula/getResult?formulaName=Circle Circumference&variables=7', [
        'headers' => [
            'Authorization' => "Bearer ".$token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]
    ]
    );

    echo $request->getBody();

?>