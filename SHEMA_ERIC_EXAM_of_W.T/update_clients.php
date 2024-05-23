<?php
include('db_connection.php');

// Check if ClientID is set
if (isset($_REQUEST['client_id'])) {
  $client_id = $_REQUEST['client_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM clients WHERE ClientID=?");
  $stmt->bind_param("i", $client_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $client_id = $row['ClientID'];
    $user_id = $row['UserID'];
    $age = $row['Age'];
    $gender = $row['Gender'];
  } else {
    echo "Client not found.";
  }
  $stmt->close(); // Close the statement after use
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Client Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update client information form -->
        <h2><u>Update Client Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="user_id">User ID:</label>
            <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
            <br><br>

            <label for="age">Age:</label>
            <input type="text" name="age" value="<?php echo isset($age) ? $age : ''; ?>">
            <br><br>

            <label for="gender">Gender:</label>
            <input type="text" name="gender" value="<?php echo isset($gender) ? $gender : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $user_id = $_POST['user_id'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];

  // Update the client in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE clients SET UserID=?, Age=?, Gender=? WHERE ClientID=?");
  $stmt->bind_param("isssi", $user_id, $age, $gender, $client_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: clients.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
