<?php
require_once 'config/init-1.php';

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
            $message = "Appointment approved successfully";
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    } else {
        $errors[] = "Invalid request";
    }

//             // Execute the query
//             $result = $statement->execute();

//             // Check if any rows were affected
//             if ($result && $statement->rowCount() > 0) {
//                 $message = "Approved successfully";
//             } else {
//                 $errors[] = "No record found with the given ID";
//             }
//         } catch (PDOException $e) {
//             $errors[] = "Database error: " . $e->getMessage();
//         } 
//     } else {
//     $errors[] = "Invalid request";
// }

// Redirect to the dashboard with appropriate messages
$url = "dash.php";
if (!empty($errors)) {
    $url .= "?error=" . urlencode(implode(", ", $errors));
} elseif (!empty($message)) {
    $url .= "?message=" . urlencode($message);
}
header("Location: $url");
exit();

if (isset($_POST["refer"])) {
    if (isset($_SESSION['us3rid']) == 4) {
        $hostid = $_SESSION['hostid'];
    } else {
        $errors[] = "You are not authorized to perform this action";
    }

}