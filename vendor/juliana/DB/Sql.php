<?php 

namespace Juliana\DB;

class Sql {

	const HOSTNAME = "juliana_aquino.mysql.dbaas.com.br";
	const USERNAME = "juliana_aquino";
	const PASSWORD = "julianaAquino";
	const DBNAME = "juliana_aquino";

	private $conn;

	//método construtor da classe Sql

	public function __construct()
	{

		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, 
			Sql::USERNAME,
			Sql::PASSWORD
		);

	}

	//método que coloca os parametros no statement

	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}


	//método que seta cada parametro individualmente

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	//método que faz uma query no banco, envia para preparar o statement e executa a query

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	//método que retorna todos os registros

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

 ?>