<?php
class User {
	private $database;
	public $userid, $username, $password, $usergroup, $role, $isactive, $created;

	public function __construct() {
		$this->database = new Connection();
		$this->database = $this->database->connect();
	}

	// Create record in database table


	// Read row(s) from the database table
	public function getUser() {
		$statement = $this->database->prepare("SELECT * FROM tb_user");
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $results ? $results : false;
	}


	public function countAll() {
		$statement = $this->database->prepare("SELECT COUNT(*) AS count FROM tb_user");
		$statement->execute();
		$result = $statement->fetch();

		return !empty($result['count']) ? $result['count'] : false;
	}

	public function login($username, $password) {
		$statement = $this->database->prepare("SELECT * FROM tb_user WHERE username = :username AND password = :password");
		$statement->execute(array("username"=>$username, "password"=>$password));

		$result = $statement->fetch(

        );

		// Create SESSION variables for logged in user
		if ($result) {
			$_SESSION['us3rid'] = $result['userid'];
			$_SESSION['us3rgr0up'] = $result['usergroup'];
            $_SESSION['loggedin_time'] = $result['loggedin_time'];
			$_SESSION['1s@dmin'] = ($result['usergroup'] == 118) ? true : false;
		}

		return $result ? true : false;
	}
	
	public function getName($userid) {
		$statement = $this->database->prepare("SELECT role FROM tb_user WHERE userid = :userid");
		$statement->execute(array("userid"=>$userid));
		$result = $statement->fetch();

		return $result ? $result['role'] : '';
	}

	public function logout() {
		if (isset($_SESSION['us3rid'])){
			unset($_SESSION['us3rid']);
			session_destroy();

			return true;
		}
		return false;
	}
}
