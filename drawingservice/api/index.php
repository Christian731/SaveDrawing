<?php
require '../vendor/autoload.php';

require_once '../vendor/firebase/php-jwt/src/BeforeValidException.php';
require_once '../vendor/firebase/php-jwt/src/ExpiredException.php';
require_once '../vendor/firebase/php-jwt/src/SignatureInvalidException.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once ("./request.php");
require_once ("./response.php");

spl_autoload_register('autoLoad');
function autoLoad($classname) {
    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
        require_once ('../controllers/' . $classname . '.php');
        return true;
    }
}

$hash = "HS256";

//Validates the token
function checkToken($token, $userName, $hash) {
    $decoded = JWT::decode($token, new Key($userName, $hash));
    $decoded_array = (array) $decoded;

    if(time() < $decoded_array["exp"]){
        return true;
    }
    else {
        return false;
    }
}

$request = new Request();

$request->accept = "application/json";

$response = new Response();

$keys = array();
$keys = array_keys($request->url_parameters);

$controllerName = ucfirst($keys[0]) . 'Controller';
if (class_exists($controllerName)) {

    $controller = new $controllerName();

    if ($request->accept == "application/json") {
        if ($request->verb == "POST") {
            // $data = json_decode($request->payload);

            //Check if the controller is for files
            if ($controllerName == "FileController") {
                try {
                    $jwt;
                    //Extracts the token
                    foreach (getallheaders() as $name => $value) {
                        if($name == "Authorization"){
                            $jwt = substr($value, 7);
                        }
                    }
                    
                    //Validate the token
                    $clientUserName = $data["userName"];
                    $isValid = checkToken($jwt, $clientUserName, $hash);

                    //Add a new file when the token is valid
                    if($isValid) {
                        $client = new ClientController();
                        $client = $client->getClient($data["userName"]);
                        if ($client != null) {
                            $controller->addFile($client["clientID"], $data["format"], $data["rawFile"], $data["fileName"]);
                            $targetFolder = dirname(__DIR__, 1) . "\\SavedFiles";
                            move_uploaded_file($_FILES['FileContents']['tmp_name'], $targetFolder . "\\" . $_FILES['FileContents']['name']);
                        } else {
                            echo "client does not exist";
                        }
                    }
                    else {
                        echo "invalid token";
                    }
                }
                catch(Exception $e) {
                    echo $e;
                }

            }
            // Posts a new client
            else {
                $data = json_decode($request->payload);
                $client = $controller->addClient($data->clientName, $data->userName, $data->password);
                $response->payload = $client;
            }
            // echo $response->payload;
        }

        //Get requests processes.
        elseif($request->verb == "GET"){
            $data = ($request->url_parameters);
            //Get token
            if($data["authorize"] == "yes") {
                $clientUserName = $data["userName"];
                $clientPW = $data["pw"];
        
                $client = $controller->getClient($clientUserName);
                if($client["pw"] == $clientPW){
                    $payload = array(
                        "iss" => "http://localhost/client/GetClient.php",
                        "aud" => "http://localhost/SaveDrawing/drawingservice/api",
                        "iat" => time(),
                        "exp" => time() + 60 //In 1 minute
                    );
                    
                    $jwt = JWT::encode($payload, $clientUserName, $hash);
                    $response->payload = $jwt;
                }
            }
            //Get the files of a user
            elseif($data["authorize"] == "no" && $controllerName == "ClientController") {
                try {
                    $jwt;
                    foreach (getallheaders() as $name => $value) {
                        if($name == "Authorization"){
                            $jwt = substr($value, 7);
                        }
                    }
                    $clientUserName = $data["userName"];
                    $isValid = checkToken($jwt, $clientUserName, $hash);

                    if($isValid) {
                        $client = $controller->getClient($data["userName"]);
                        $fileController = new FileController();
                        $files = $fileController->getAllFiles($client["clientID"]);
                        $response->payload = $files;
                    }
                    else {
                        echo "invalid token";
                    }
                }
                catch(Exception $e) {
                    echo $e;
                }
            }
            elseif($data["authorize"] == "no" && $controllerName == "FileController") {
                try {
                    $jwt;
                    foreach (getallheaders() as $name => $value) {
                        if($name == "Authorization"){
                            $jwt = substr($value, 7);
                        }
                    }
                    $clientUserName = $data["userName"];
                    $isValid = checkToken($jwt, $clientUserName, $hash);

                    if($isValid) {
                        $client = new ClientController();
                        $client = $client->getClient($data["userName"]);
                        $file = $controller->getFile($data["fileName"]);
                        // var_dump($file);
                        $url = 'http://localhost/SaveDrawing/drawingservice/SavedFiles/'. $file["fileName"].$file["format"];
                        $file_name = basename($url);
                        if (file_put_contents($file_name, file_get_contents($url)))
                        {
                            echo "File downloaded successfully";
                        }
                        else
                        {
                            echo "File downloading failed.";
                        }
                        $response->payload = $file;
                    }
                    else {
                        echo "invalid token";
                    }
                }
                catch(Exception $e) {
                    echo $e;
                }
            }
        }
    }
}
echo json_encode($response);
?>
