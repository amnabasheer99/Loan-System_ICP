<?php
// Include your database connection file
include_once('db_config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Update Admin</title>
</head>
<body>

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data (you should add more validation)
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $national_id = mysqli_real_escape_string($conn, $_POST['national_id']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $epf_number = mysqli_real_escape_string($conn, $_POST['epf_number']);

    // SQL query to update data in the database
    $sql = "UPDATE user_creation SET 
            first_name = '$first_name', 
            last_name = '$last_name', 
            national_id = '$national_id', 
            address = '$address', 
            phone_number = '$phone_number', 
            epf_number = '$epf_number' 
            WHERE id = $id";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Admin updated successfully";
    } else {
        echo "Error updating admin: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);

} else {
    // If the form is not submitted, retrieve the admin's information for the specified ID
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // SQL query to retrieve admin information
        $sql = "SELECT * FROM user_creation WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        // Check if the admin exists
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Display the update form with the admin's current information
            ?>
            <div class="container mt-5">
                <form action="update_user.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="national_id">National Identity Card Number</label>
                        <input type="text" class="form-control" id="national_id" name="national_id" value="<?php echo $row['national_id']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $row['address']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $row['phone_number']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="epf_number">EPF Number</label>
                        <input type="text" class="form-control" id="epf_number" name="epf_number" value="<?php echo $row['epf_number']; ?>" required>
                    </div>
                    <div class="text-center"> 
                        <button type="submit" class="btn btn-primary">Update Admin</button>
                    </div>
                </form>
            </div>
            <?php
        } else {
            echo "Admin not found";
        }
    } else {
        echo "Admin ID not provided";
    }
}
?>

</body>
</html>
