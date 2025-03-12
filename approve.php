<?php
require_once 'config/dbConnection.php';

// Initialize variables
$errors = [];
$message = '';

// Create a database connection
$connection = (new Connection('localhost', 'appt_db', 'root', ''))->connect();
// Check if the approve action is requested
if (isset($_POST["submit"]) && isset($_GET["approve"])) {
    $id = $_GET["approve"];
    $hostid = $_SESSION['hostid'];

        try {
            // Prepare the SQL query
            $query = "UPDATE tb_appt SET status_id = 2, approvedby = :hostid WHERE id = :id";

            // Prepare the statement
            $statement = $connection->prepare($query);

            $statement->bindParam(':id', $id);
            $statement->bindParam(':approvedby', $_SESSION['hostid']);
            $statement->bindParam(':hostid', $hostid);
            $statement->execute(array(':id' => $id, ':hostid' => $hostid));
            $session->message("Appointment approved successfully");
            header('Location: dash.php');
            exit();
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    } else {
        $errors[] = "Invalid request";
    }

// Redirect to the dashboard with appropriate messages
$url = "dash.php";
if (!empty($errors)) {
    $url .= "?error=" . urlencode(implode(", ", $errors));
} elseif (!empty($message)) {
    $url .= "?message=" . urlencode($message);
}
header("Location: $url");
exit();


// refer function to update rows set hostid, status_id, remark where id = :id
if (isset($_POST["refer"]) && isset($_GET["refer"])) {
    $id = $_GET["refer"];
    $hostid = $_SESSION['hostid'];
    $remarks = $_POST['remarks'];

        try {
            // Prepare the SQL query
            $query = "UPDATE tb_appt SET status_id = 4, hostid = :hostid, remark = :remarks WHERE id = :id";

            // Prepare the statement
            $statement = $connection->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->bindParam('status_id', 4);
            $statement->bindParam(':hostid', $hostid);
            $statement->bindParam(':remark', $remarks);
            $statement->execute(array(':id' => $id, ':hostid' => $hostid, ':remarks' => $remarks));
            $session->message("Appointment referred successfully");
            header('Location: dash.php');
            exit();
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    } else {
        $errors[] = "Invalid request";
    }
    // Redirect to the dashboard with appropriate messages
    $url = "dash.php";
    if (!empty($errors)) {
        $url .= "?error=" . urlencode(implode(", ", $errors));
    } elseif (!empty($message)) {
        $url .= "?message=" . urlencode($message);
    }
    header("Location: $url");
    exit();


// post refuse function to insert and update rows set hostid, status_id where id = :id
if (isset($_POST["submit"]) && isset($_GET["refuse"])) {
    $id = $_GET["refuse"];
    $hostid = $_SESSION['hostid'];

        try {
            // Prepare the SQL query
            $query = "UPDATE tb_appt SET status_id = 5, approvedby = :hostid WHERE id = :id";

            // Prepare the statement
            $statement = $connection->prepare($query);

            $statement->bindParam(':id', $id);
            $statement->bindParam(':approvedby', $_SESSION['hostid']);
            $statement->bindParam(':hostid', $hostid);
            $statement->execute(array(':id' => $id, ':hostid' => $hostid));
            $session->message("Appointment refused successfully");
            header('Location: dash.php');
            exit();
            } catch (PDOException $e) {
                $errors[] = "Database error: " . $e->getMessage();
            }
        } else {
            $errors[] = "Invalid request";
            }
?>