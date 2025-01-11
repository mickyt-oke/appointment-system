<?php
require_once 'config/dbConfig.php';
require_once 'config/dbConnection.php';

// Check if the checkout action is requested
if (isset($_POST["checkout"])) {
    // Sanitize and validate the input
    $id = intval($_POST["checkout"]);

    // Prepare the SQL statement to update the record
    $sql = "UPDATE tb_appt SET isactive = 2, checkout = NOW() WHERE id = ?";
    
    // Use prepared statements to prevent SQL injection
    if ($stmt = $this->databse->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            $message = "Guest checked out successfully.";
        } else {
            $errors[] = "No record found with the given ID.";
        }

        $stmt->close();
    } else {
        $errors[] = "Database error: Unable to prepare the statement.";
    }
} else {
    $errors[] = "Invalid request.";
}

// Redirect to the dashboard with appropriate messages
$url = "dashboard.php";
if (!empty($errors)) {
    $url .= "?error=" . urlencode(implode(", ", $errors));
} elseif (isset($message)) {
    $url .= "?message=" . urlencode($message);
}

header("Location: $url");
exit();