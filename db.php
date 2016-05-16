<?php
require_once("config.php");

/**
 * DB represents a simple access layer to the database, providing a really easy
 * mechanism for interacting with query scripts within the sql directory.
 * 
 * A magic method is used to allow any method name to be called on this class,
 * which will be used as the sql file name. See docs below.
 */
class DB{
	/**
	 * @var PDO Database handle
	 */
	private $dbh;
	/**
	 * @var PDOStatement Current prepared statement
	 */
	private $stmt;

	function __construct(){	
		try {
			$this->dbh = new PDO(
				Config::get("db_dsn"), 
				Config::get("db_user"),
				Config::get("db_pass")
			);
		}
		catch(Exception $e) {
			die("Connection failed: " . $e->getMessage());
		}

		$this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}
	
	/**
	 * Shows how a method can be used to override behaviour of a particular
	 * query. This method loops over the provided array and calls the 
	 * updateOrder query for each index.
	 *
	 * @param array $id_array Array of integers representing IDs in the database
	 */
	function updateOrder($id_array){
		foreach ($id_array as $index => $id){
			$this->updateLayout([
				"id" => $id,
				"index" => $index + 1,
			]);
		}
	}

	/**
 	 * Creates a prepared statement by loading the SQL file and parsing for
 	 * variable placeholders. By default, placeholders are indicated by using
 	 * the colon (:).
	 * 
	 * @param string $name The name of the SQL file to load
	 */
	private function prepareStatement($name) {
		$sql = file_get_contents("sql/$name.sql");
		$this->stmt = $this->dbh->prepare($sql);
	}

	/**
	 * Binds parameters to the prepared statement, preventing SQL injection.
	 *
	 * @param array $params The key-value-pairs to bind
	 */
	private function execute($params = []) {
		$this->stmt->execute($params);
	}

	/**
	 * Magic method to automatically link called methods to their corresponding
	 * SQL queries.
	 *
	 * @param string $name The name of the called method
	 * @param array $args An indexed array of arguments passed to the method
	 *
	 * @return array An indexed array containing a mixed array for each row in
	 * the result
	 */
	public function __call($name, $args) {
		$params = [];
		if(isset($args[0])) {
			$params = $args[0];
		}

		$this->prepareStatement($name);
		$this->execute($params);
		return $this->stmt->fetchAll();
	}

	public function getRows() {
		$this->prepareStatement("getRows");
		$this->execute([
			":userID" => $_SESSION["userID"],
			":projectID" => $_SESSION["projectID"],
		]);

		return $this->stmt->fetchAll();
	}
}

// Removed the ending PHP tag. See notes for why.
