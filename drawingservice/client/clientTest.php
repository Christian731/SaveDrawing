<?php 

    // For Alex V and Christian David's Client API.

    require_once('C:\XAMPP\htdocs\SaveDrawing\drawingservice\vendor\autoload.php');
    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7;

    $client = new GuzzleHttp\Client();

    $pw = "wefrwef";
    $userName= "sexybeast69";
    $file = "C:\\XAMPP\\htdocs\\SaveDrawing\\drawingservice\\client\\orange.jpg";

    //Authorizing. 
    $authorize = $client->request('GET', 'http://localhost/SaveDrawing/drawingservice/api/client/?authorize=yes&pw='. $pw. "&userName=" . $userName, ['headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']]);
    $token = json_decode($authorize->getBody())->payload;
    echo $token . '<br><br>';


    // // Getting all files.
    // $getFiles = $client->request('GET', 'http://localhost/SaveDrawing/drawingservice/api/client/?authorize=no&userName=' . $userName, 
    // ['headers' => ['Content-Type' => 'application/json' , 'Authorization' => 'Bearer ' . $token]]);
    // echo $getFiles->getBody() . '<br><br>';


    // // Inserting a client.
    // $insertClient = $client->request('POST', 'http://localhost/SaveDrawing/drawingservice/api/client/', 
    // ['headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'], 
    // 'body' => json_encode(array(		
	// 'clientName' => 'John',
	// 'password' => 'pass1234',
	// 'userName' => 'johnny'
	// ))]);


    // Finding file.
    $findFile = $client->request('GET', 'http://localhost/SaveDrawing/drawingservice/api/file/?authorize=no&userName='. $userName .'&fileName=orange', 
    ['headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token]]);
    echo $findFile->getBody() . '<br><br>';

    
    // Inserting file.
    // $insertFile = $client->request('POST', 'http://localhost/SaveDrawing/drawingservice/api/file/?userName=sexybeast69&format=jpg&rawFile&fileName=orange', 
    // ['headers' => ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token], 
        
    //     'multipart' =>  [
    //         [
    //             'name' => 'FileContents',
    //             'contents' => file_get_contents($file),
    //             'filename' => 'orange.jpg'
    //         ]
    //     ]

    // ]);
    // echo $insertFile->getBody();
?>