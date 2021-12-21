<?php
    require_once(dirname(__DIR__).'\\vendor\\autoload.php');
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    use GuzzleHttp\Client;    
    $client = new Client();

    $pw = "wefrwef";
    $userName= "sexybeast69";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'http://localhost/SaveDrawing/drawingservice/api/client/?authorize=yes&pw='.$pw."&userName=".$userName);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    // close cURL reource, and free up system resources
    $token = json_decode($response)->payload;
    curl_close($ch);

    // $data = json_encode(array(
    //     "intent"=> "clientPost",
    //     "pw"=> "wefrwef",
    //     "userName"=> "sexybeast69",
    //     "rawFile"=> "",
    //     "fileName"=> "",
    //     "format"=> "png",
    // ));
    // $payload = json_encode($data);
    // // create a new cURL resource
    // $ch = curl_init();

    // set URL and other appropriate options
    // curl_setopt($ch, CURLOPT_POST, true);    
    // curl_setopt($ch, CURLOPT_URL, "http://localhost/SaveDrawing/drawingservice/api/file/");
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Bearer '.$token));

    // curl_exec($ch);

    // // close cURL reource, and free up system resources
    // curl_close($ch);

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, 'http://localhost/SaveDrawing/drawingservice/api/client/?authorize=no&userName='.$userName);
    // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer '.$token));
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($ch);
    // // close cURL reource, and free up system resources
    // $files = json_decode($response)->payload;
    // echo json_encode($files);
    // curl_close($ch);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/SaveDrawing/drawingservice/api/client/?authorize=no&userName='.$userName);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer '.$token));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    // close cURL reource, and free up system resources
    $files = json_decode($response)->payload;
    echo json_encode($files);
    curl_close($ch);


    // // Inserting file.
    // $insertFile = $client->request('POST', 'http://localhost/SaveDrawing/drawingservice/api/file/', 
    // ['headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token], 
    // 'body' => json_encode(array(        
    // 'userName' => 'ebra',
    // 'pw' => 'pass123',
    // 'format' => '.jpg',
    // 'rawFile' => 'C:\xampp\htdocs\SaveDrawing\drawingservice\api\orangePic.jpg',
    // 'fileName' => 'Ayaka.png'
    // )), 'multipart' => [
    //     [
    //     'Content-type' => 'multipart/form-data',
    //     'name' => 'file_name',
    //     'contents' => file_get_contents('C:\xampp\htdocs\SaveDrawing\drawingservice\SavedFiles\Ayaka.png', 'file_name')
    //     ]
    // ]
    // ]);
    // echo $insertFile->getBody();
    
?>