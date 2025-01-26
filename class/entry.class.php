<?php
class Entry {
	private $database;
	public $title, $full_name, $gender, $mobileno, $email, $purpose, $hostid, $tagid, $remark, $prev_appt, $status_id, $addresse, $userid, $vcomment, $isactive, $stateid;
	
	public function __construct() {
		$this->database = new Connection();
		$this->database = $this->database->connect();
	}
	
	
	public function createEntry() {
		try {
			// Define the SQL query with named placeholders for better readability
			$sql = "INSERT INTO tb_appt (
				title, full_name, gender, mobileno, email, purpose, hostid, tagid, 
				remark, prev_appt, status_id, addresse, userid, vcomment, isactive, stateid
			) VALUES (
				:title, :full_name, :gender, :mobileno, :email, :purpose, :hostid, :tagid, 
				:remark, :prev_appt, :status_id, :addresse, :userid, :vcomment, :isactive, :stateid
			)";
	
			// Prepare the SQL statement
			$statement = $this->database->prepare($sql);
	
			// Bind values to named placeholders
			$statement->bindParam(':title', $this->title);
			$statement->bindParam(':full_name', $this->full_name);
			$statement->bindParam(':gender', $this->gender);
			$statement->bindParam(':mobileno', $this->mobileno);
			$statement->bindParam(':email', $this->email);
			$statement->bindParam(':purpose', $this->purpose);
			$statement->bindParam(':hostid', $this->hostid);
			$statement->bindParam(':tagid', $this->tagid);
			$statement->bindParam(':remark', $this->remark);
			$statement->bindParam(':prev_appt', $this->prev_appt);
			$statement->bindParam(':status_id', $this->status_id);
			$statement->bindParam(':addresse', $this->addresse);
			$statement->bindParam(':userid', $_SESSION['us3rid']); // Use session variable
			$statement->bindParam(':vcomment', $this->vcomment);
			$statement->bindParam(':isactive', $this->isactive);
			$statement->bindParam(':stateid', $this->stateid);
	
			// Execute the statement
			$statement->execute();
	
			// Optionally, return the last inserted ID
			return $this->database->lastInsertId();
		} catch (PDOException $e) {
			// Log the error and handle it appropriately
			error_log("Error creating entry: " . $e->getMessage());
			return false;
		}
	}

	public function tagIdExists($tagid, $db) {
		$sql = "SELECT tagid FROM tb_appt WHERE tagid = ? && isactive = 1";
		$stmt = $this->database->prepare($sql);
		$stmt->bindParam(1, $tagid);
		$stmt->execute();
		$result = $stmt->fetch();
		if ($result) {
			return true;
			} else {
				return false;
			}
	}


	// Read row(s) from the database table
	public function getAllGuests() {
		$statement = $this->database->prepare("SELECT * FROM tb_appt");
		$statement->execute();
		$results = $statement->fetch();

		return $results ? $results : false;
	}
	
	public function getAllGuestsByHost($hostid) {
		$statement = $this->database->prepare("SELECT * FROM tb_appt WHERE hostid = :hostid && isactive = 1 && status_id = 1");
		$statement->execute(array(':hostid' => $hostid));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $result ? $result : false;
	}

	public function getGuest($tagid) {
		$statement = $this->database->prepare("SELECT * FROM tb_appt WHERE tagid = ?");
		$statement->bindParam(1, $tagid);
		$statement->execute();
		$result = $statement->fetch();

		return $result ? $result : false;
	}

	public function countAll() {
		$statement = $this->database->prepare("SELECT COUNT(*) AS count FROM tb_appt ");
		$statement->execute();
		$result = $statement->fetch();

		return !empty($result['count']) ? $result['count'] : false;
	}
	
	public function countApprovedGuests() {
		$statement = $this->database->prepare("SELECT COUNT(*) AS count FROM tb_appt WHERE status_id = 2 && isactive = 1");
		$statement->execute();
		$result = $statement->fetch();

		return !empty($result['count']) ? $result['count'] : false;
	}
	
	public function countPendingGuests() {
	    $statement = $this->database->prepare("SELECT COUNT(*) AS count FROM tb_appt WHERE status_id = 1 && isactive = 1");
	    $statement->execute();
	    $result = $statement->fetch();

	    return !empty($result['count']) ? $result['count'] : false;
    }
	
	public function countRefused() {
	    $statement = $this->database->prepare("SELECT COUNT(*) AS count FROM tb_appt WHERE status_id = 4 && isactive = 1");
	    $statement->execute();
	    $result = $statement->fetch();

	    return !empty($result['count']) ? $result['count'] : false;
    }
	
	public function countCheckOut() {
	    $statement = $this->database->prepare("SELECT COUNT(*) AS count FROM tb_appt WHERE status_id = 3");
	    $statement->execute();
	    $result = $statement->fetch();

	    return !empty($result['count']) ? $result['count'] : false;
    }
// function to get records day by day
	public function getApptForToday() {
		try{
		$stmt =  $this->database->prepare("SELECT * FROM tb_appt where isactive = 1 && DATE(checkin) = CURDATE() ORDER BY checkin DESC");
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}  catch (PDOException $e) {
        // Handle any errors that occur during the query execution
        error_log("Error fetching appointments for today: " . $e->getMessage());
        return []; // Return an empty array in case of error
    	}
	}
	public function getTagbyId() {
		$statement = $this->database->prepare("SELECT * FROM tb_appt");
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $results ? $results: false;
	}

	public function checkOutGuest() {
		$statement = $this->database->prepare("UPDATE tb_appt SET status_id = 3, isactive = 2, checkout = NOW() WHERE id = ?");
		$statement->execute();
		return $statement->rowCount();
		}
	
	public function getGuestById($id) {
		$statement = $this->database->prepare("SELECT * FROM tb_appt WHERE id = ?");
		$statement->bindParam(1, $id);
		$statement->execute();
		$result = $statement->fetch();

		return $result ? $result : false;
	}

	public function countAllByHost($hostid) {
		$statement = $this->database->prepare("SELECT COUNT(*) AS count FROM tb_appt WHERE hostid = :hostid");
		$statement->execute(array(':hostid' => $hostid));
		$result = $statement->fetch();

		return !empty($result['count']) ? $result['count'] : false;
	}
	
	public function countApprovedByHost($hostid) {
		$statement = $this->database->prepare("SELECT COUNT(*) AS count FROM tb_appt WHERE status_id = 2 && isactive = 1 && hostid = :hostid");
		$statement->execute(array(':hostid' => $hostid));
		$result = $statement->fetch();

		return !empty($result['count']) ? $result['count'] : false;
	}
	
	public function countPendingByHost($hostid) {
	    $statement = $this->database->prepare("SELECT COUNT(*) AS count FROM tb_appt WHERE status_id = 1 && isactive = 1 && hostid = :hostid");
	    $statement->execute(array(':hostid' => $hostid));
	    $result = $statement->fetch();

	    return !empty($result['count']) ? $result['count'] : false;
    }
}

?>