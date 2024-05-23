<?php
include('db_connection.php');

// Check if Session ID is set
if (isset($_REQUEST['session_id'])) {
  $session_id = $_REQUEST['session_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM sessions WHERE SessionID=?");
  $stmt->bind_param("i", $session_id);
  $stmt->execute();
  $result = $stmt->get_result();
//SessionID
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $session_id = $row['SessionID'];
    $therapist_id = $row['TherapistID'];
    $client_id = $row['ClientID'];
    $date = $row['Date'];
    $duration_minutes = $row['DurationMinutes'];
    $notes = $row['Notes'];
  } else {
    echo "Session not found.";
    exit; // Exit script if session not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Session Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update session information form -->
        <h2><u>Update Session Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="therapist_id">Therapist ID:</label>
            <input type="text" name="therapist_id" value="<?php echo isset($therapist_id) ? $therapist_id : ''; ?>">
            <br><br>

            <label for="client_id">Client ID:</label>
            <input type="text" name="client_id" value="<?php echo isset($client_id) ? $client_id : ''; ?>">
            <br><br>

            <label for="date">Date:</label>
            <input type="text" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
            <br><br>

            <label for="duration_minutes">Duration (minutes):</label>
            <input type="text" name="duration_minutes" value="<?php echo isset($duration_minutes) ? $duration_minutes : ''; ?>">
            <br><br>

            <label for="notes">Notes:</label>
            <input type="text" name="notes" value="<?php echo isset($notes) ? $notes : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $therapist_id = $_POST['therapist_id'];
  $client_id = $_POST['client_id'];
  $date = $_POST['date'];
  $duration_minutes = $_POST['duration_minutes'];
  $notes = $_POST['notes'];

  // Update the session in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE sessions SET TherapistID=?, ClientID=?, Date=?, DurationMinutes=?, Notes=? WHERE SessionID=?");
  $stmt->bind_param("iisisi", $therapist_id, $client_id, $date, $duration_minutes, $notes, $session_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: session.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
