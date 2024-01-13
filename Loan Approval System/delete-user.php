<?php
// Include your database connection file
include_once('db_config.php');

// Check if the admin ID is provided in the URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // SQL query to delete the admin
    $sql = "DELETE FROM user_creation WHERE id = $id";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Admin deleted successfully";
    } else {
        echo "Error deleting admin: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Admin ID not provided";
}
?>
