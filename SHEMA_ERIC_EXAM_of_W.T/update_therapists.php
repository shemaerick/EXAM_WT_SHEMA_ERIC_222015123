<?php
include('db_connection.php');

// Check if Therapist ID is set
if (isset($_REQUEST['therapist_id'])) {
  $therapist_id = $_REQUEST['therapist_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM therapists WHERE TherapistID=?");
  $stmt->bind_param("i", $therapist_id);
  $stmt->execute();
  $result = $stmt->get_result();
//with table therapists(TherapistID, UserID, Specialization, Description)
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $therapistID = $row['TherapistID'];
    $usid = $row['UserID'];
    $specialization = $row['Specialization'];
    $description = $row['Description'];
  } else {
    echo "Therapist not found.";
    exit; // Exit script if therapist not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Therapist Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update therapist information form -->
        <h2><u>Update Therapist Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="userID">User ID:</label>
            <input type="number" name="userID" value="<?php echo isset($usid) ? $usid : ''; ?>">
            <br><br>

            <label for="specialization">Specialization:</label>
            <input type="text" name="specialization" value="<?php echo isset($specialization) ? $specialization : ''; ?>">
            <br><br>

            <label for="description">Description:</label>
            <input type="text" name="description"><?php echo isset($description) ? $description : ''; ?>
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $userID = $_POST['userID'];
  $specialization = $_POST['specialization'];
  $description = $_POST['description'];

  // Update the therapist in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE therapists SET UserID=?, Specialization=?, Description=? WHERE TherapistID=?");
  $stmt->bind_param("issi", $userID, $specialization, $description, $therapist_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: therapists.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
