<?php error_reporting (E_ALL ^ E_NOTICE); ?> 

<?php
// Include your database connection file
include_once('db_config.php');

// SQL query to retrieve all admins from the database
$sql = "SELECT * FROM user_creation";
$result = mysqli_query($conn, $sql);

// Displaying the admins in a table
echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>National ID</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>EPF Number</th>
        <th>Actions</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
    echo "<td>" . $row['national_id'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . $row['phone_number'] . "</td>";
    echo "<td>" . $row['epf_number'] . "</td>";
    echo "<td>
            <a href='update_user.php?id=" . $row['id'] . "'>Update</a>
            <a href='delete-user.php?id=" . $row['id'] . "'>Delete</a>
          </td>";
    echo "</tr>";
}

echo "</table>";

// Close the database connection
mysqli_close($conn);
?>
