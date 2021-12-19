<?php
/**
* @OA\Info(title="API drawing service", version="1.0")
*/
	require_once("../model/client.php");
	class ClientController{
		function __construct(){
		}		
		
		/**
 		* @OA\Get(
 		* path="/drawingservice/model/client/getClient", tags={"Client"},
 		* @OA\Parameter(name="userName", in="query", description="client's Username to find", required=true),
 		* @OA\Response(response="200", description="success"),
 		* @OA\Response(response="404", description="not found"),
 		* )
 		*/
		function getClient($userName) {
			$client = new Client();
			$client = $client->findClient($userName);
			return $client;
		}

		/**
 		* @OA\Post(
 		* path="/drawingservice/model/client/addClient", tags={"Client"},
 		* @OA\Parameter(name="clientName", in="query", description="client's name", required=true),
 		* @OA\Parameter(name="userName", in="query", description="client's Username", required=true),
 		* @OA\Parameter(name="password", in="query", description="client's password", required=true),
 		* @OA\Response(response="200", description="success"),
 		* @OA\Response(response="404", description="not found"),
 		* )
 		*/
		function addClient($clientName, $userName, $password) {
			$client = new Client();
			$client->insert($clientName, $userName, $password);
		}
	}
?>