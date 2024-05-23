<?php
include('db_connection.php');

// Check if Session ID is set
if (isset($_REQUEST['session_id'])) {
  $session_id = $_REQUEST['session_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM session_playlist WHERE SessionID=?");
  $stmt->bind_param("i", $session_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $session_id = $row['SessionID'];
    $playlist_id = $row['PlaylistID'];
  } else {
    echo "Session playlist not found.";
    exit; // Exit script if session playlist not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Session Playlist Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update session playlist information form -->
        <h2><u>Update Session Playlist Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="playlist_id">Playlist ID:</label>
            <input type="text" name="playlist_id" value="<?php echo isset($playlist_id) ? $playlist_id : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $playlist_id = $_POST['playlist_id'];

  // Update the session playlist in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE session_playlist SET PlaylistID=? WHERE SessionID=?");
  $stmt->bind_param("ii", $playlist_id, $session_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: session_playlist.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
