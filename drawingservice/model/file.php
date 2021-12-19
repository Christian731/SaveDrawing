<?php
	require_once("../database/connectionManager.php");

	class File{
		
		private $clientID;
		private $fileID;
		private $dateCreated;
		private $format;
		private $rawFile;
		private $fileName;

		private $connectionManager;
		private $dbConnection;
	
		function __construct() {
			$this->connectionManager = new ConnectionManager();
			
			$this->dbConnection = $this->connectionManager->getConnection();
		}
		
		function getAllFiles($clientID) {
			$query = "select * from file where clientID='".$clientID."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

        function findFile($fileName) {
			$query = "select * from file where fileName='".$fileName."'";
			$statement = $this->dbConnection->query($query);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}

		function insert($clientID, $format, $rawFile, $fileName) {
			$query = "INSERT INTO file(clientID, format, rawFile, fileName) 
			VALUES (:clientID, :format, :rawFile, :fileName)";
			$stmt = $this->dbConnection->prepare($query);
			$stmt->execute(['clientID' => $clientID, 'format' => $format, 'rawFile' => $rawFile, 'fileName' => $fileName]);
		}
	}

?>