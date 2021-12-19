<?php
	require_once("../database/connectionManager.php");

	class Client{
		
		private $clientID;
		private $clientName;
		private $password;
		private $userName;

		private $connectionManager;
		private $dbConnection;
	
		function __construct() {
			$this->connectionManager = new ConnectionManager();
			
			$this->dbConnection = $this->connectionManager->getConnection();
		}
		
		function findClient($userName) {
			$query = "select * from client where userName='".$userName."'";
			$statement = $this->dbConnection->query($query);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}
		
		function insert($clientName, $userName, $pw) {
			$query = "INSERT INTO client(clientName, userName, pw) 
			VALUES (:clientName, :userName, :pw)";
			$stmt = $this->dbConnection->prepare($query);
			$stmt->execute(['clientName' => $clientName, 'userName' => $userName, 'pw' => $pw]);
		}
	}

?>