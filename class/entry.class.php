<?php
class Entry {
	private $database;
	public $id, $title, $full_name, $gender, $mobileno, $email, $purpose, $hostid, $tagid, $remark, $prev_appt, $status_id, $checkin, $checkout, $address, $userid, $approvedby, $vcomment;
	public function __construct() {
		$this->database = new Connection();
		$this->database = $this->database->connect();
	}
	
	
	// Create record in database table
	public function createEntry() {
		$statement = $this->database->prepare("INSERT INTO tb_appt ('id','title','full_name','gender','mobileno','email','purpose','hostid','tagid','remark','prev_appt','status_id','checkin','checkout','address','userid','approvedby','vcomment') VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		// Bind all values to the placeholders
		$statement->bindParam(1, $this->id);
		$statement->bindParam(2, $this->title);
		$statement->bindParam(3, $this->full_name);
		$statement->bindParam(4, $this->gender);
		$statement->bindParam(5, $this->mobileno);
		$statement->bindParam(6, $this->email);
		$statement->bindParam(7, $this->purpose);
		$statement->bindParam(8, $this->hostid);
		$statement->bindParam(9, $this->tagid);
		$statement->bindParam(10, $this->remark);
		$statement->bindParam(11, $this->prev_appt);
		$statement->bindParam(12, $this->status_id);
		$statement->bindParam(13, $this->checkin);
		$statement->bindParam(14, $this->checkin);
		$statement->bindParam(15, $this->checkin);
		$statement->bindParam(16, $this->checkin);
		$statement->bindParam(17, $this->checkin);
		$statement->bindParam(18, $this->checkin);

        $statement->bindParam(14, $_SESSION['us3rid']);


		// Execute the query
		$result = $statement->execute();

        $this->id = $this->database->lastInsertId();

		return $result ? true : false;
	}

	// Read row(s) from the database table
	public function getNewEntry() {
		$statement = $this->database->prepare("SELECT * FROM tbl_ppt");
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $results ? $results : false;
	}

	public function countAll() {
		$statement = $this->database->prepare("SELECT COUNT(*) AS count FROM tbl_ppt");
		$statement->execute();
		$result = $statement->fetch();

		return !empty($result['count']) ? $result['count'] : false;
	}
	public function countPptReturn($missionid) {
	    $statement = $this->database->prepare("SELECT COUNT(missionid) AS count FROM tbl_ppt WHERE missionid = :mission");
	    $statement->execute(array("mission->$missionid"));
	    $result = $statement->fetch();

	    return $result ? $result : false;
    }
    public function getReturnbyMonth($missionid) {
        $statement = $this->database->prepare("SELECT * FROM tbl_ppt WHERE missionid = :mission ORDER BY month DESC");
        $statement->execute(array("mission"=>$missionid));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result ? $result : false;
    }

}
