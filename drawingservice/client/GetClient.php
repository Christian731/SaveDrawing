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

    // // set URL and other appropriate options
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
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/SaveDrawing/drawingservice/api/file/?authorize=no&userName='.$userName."&fileName=Ayaka");
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer '.$token));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    // close cURL reource, and free up system resources
    var_dump($response);
    $files = json_decode($response)->payload;
    echo $files;
    curl_close($ch);
?>