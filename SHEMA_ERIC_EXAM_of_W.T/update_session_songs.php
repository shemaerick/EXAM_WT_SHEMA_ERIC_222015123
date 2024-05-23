<?php
include('db_connection.php');

// Check if SessionID is set
if (isset($_REQUEST['session_id'])) {
  $session_id = $_REQUEST['session_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM session_songs WHERE SessionID=?");
  $stmt->bind_param("i", $session_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $session_id = $row['SessionID'];
    $song_id = $row['SongID'];
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
    <title>Update Session Songs</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update session songs form -->
        <h2><u>Update Session Songs</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="session_id">Session ID:</label>
            <input type="hidden" name="session_id" value="<?php echo isset($session_id) ? $session_id : ''; ?>">
            <br><br>

            <label for="song_id">Song ID:</label>
            <input type="text" name="song_id" value="<?php echo isset($song_id) ? $song_id : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $session_id = $_POST['session_id'];
  $song_id = $_POST['song_id'];

  // Update the session song in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE session_songs SET SongID=? WHERE SessionID=?");
  $stmt->bind_param("ii", $song_id, $session_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: session_songs.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
