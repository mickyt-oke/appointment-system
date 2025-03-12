<!-- create a delete button function to update row id set isactive = 0 from tb_appt where id = :id -->
<?php
require_once 'config/init-1.php';

// Initialize variables
$errors = [];
$message = '';

// Create a database connection
$connection = (new Connection('localhost', 'appt_db', 'root', ''))->connect();
// Check if the checkout action is requested
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];

    try {
        // Prepare the SQL query
        $query = "UPDATE tb_appt SET isactive = 0 WHERE id = :id";

        // Prepare the statement 
        $statement = $connection->prepare($query);
        // Bind the parameter
        $statement->bindParam(':id', $id);

        // Execute the query
        $result = $statement->execute();

        // Check if any rows were affected
        if ($result && $statement->rowCount() > 0) {
            $message = "Record Successfully Deleted";
        } else {
            $errors[] = "No record found with the given ID";
        }
    } catch (PDOException $e) {
        $errors[] = "Database error: " . $e->getMessage();
    }
} else {
    $errors[] = "Invalid request";
}

// Redirect to the dashboard with appropriate messages
$url = "dashboard.php";
if (!empty($errors)) {
    $url .= "?error=" . urlencode(implode(", ", $errors));
} elseif (!empty($message)) {
    $url .= "?message=" . urlencode($message);
}

header("Location: $url");
exit();
?>