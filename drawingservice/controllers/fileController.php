<?php
require_once("../model/File.php");	
	class FileController{
		function __construct(){
		}
		
		/**
 		* @OA\Post(
 		* path="/drawingservice/model/file/addFile", tags={"File"},
 		* @OA\Parameter(name="clientID", in="query", description="client's ID number", required=true),
 		* @OA\Parameter(name="format", in="query", description="file's format", required=true),
 		* @OA\Parameter(name="rawFile", in="query", description="file's original path", required=true),
 		* @OA\Parameter(name="fileName", in="query", description="file's name", required=true),
 		* @OA\Response(response="200", description="success"),
 		* @OA\Response(response="404", description="not found"),
 		* )
 		*/
		function addFile($clientID, $format, $rawFile, $fileName) {
			$file = new File();
			$file->insert($clientID, $format, $rawFile, $fileName);
		}

		/**
 		* @OA\Get(
 		* path="/drawingservice/model/file/getAllFiles", tags={"File"},
 		* @OA\Parameter(name="clientID", in="query", description="client's ID number to get all his files", required=true),
 		* @OA\Response(response="200", description="success"),
 		* @OA\Response(response="404", description="not found"),
 		* )
 		*/
        function getAllFiles($clientID){
            $file = new File();
            $file = $file->getAllFiles($clientID);
			return $file;
        }

		/**
 		* @OA\Get(
 		* path="/drawingservice/model/file/getFile", tags={"File"},
 		* @OA\Parameter(name="fileName", in="query", description="name of the file to find", required=true),
 		* @OA\Response(response="200", description="success"),
 		* @OA\Response(response="404", description="not found"),
 		* )
 		*/
		function getFile($fileName){
            $file = new File();
            $file = $file->findFile($fileName);
			return $file;
        }
	}
?>