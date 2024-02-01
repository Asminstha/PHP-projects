<?php
include('dbconnection.php');

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete student with the provided ID
    $query = "DELETE FROM students WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the delete query
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to the page showing the list of students after successful deletion
        header("Location: index.php?delete_msg=Student record deleted successfully");
        exit;
    } else {
        // If delete query fails, display an error message
        die("Query Failed: " . mysqli_error($connection));
    }
} else {
    // If no ID is provided in the URL, display an error message
    echo "No student ID specified in the URL";
}
?>