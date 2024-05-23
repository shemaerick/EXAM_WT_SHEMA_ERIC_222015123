<?php
include('db_connection.php');

// Check if PlaylistID is set
if (isset($_REQUEST['playlist_id'])) {
  $playlist_id = $_REQUEST['playlist_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM playlist WHERE PlaylistID=?");
  $stmt->bind_param("i", $playlist_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $playlist_id = $row['PlaylistID'];
    $user_id = $row['UserID'];
    $playlist_name = $row['PlaylistName'];
  } else {
    echo "Playlist not found.";
    exit; // Exit script if playlist not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Playlist Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update playlist information form -->
        <h2><u>Update Playlist Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="playlist_id">Playlist ID:</label>
            <input type="text" name="playlist_id" value="<?php echo isset($playlist_id) ? $playlist_id : ''; ?>">
            <br><br>

            <label for="user_id">User ID:</label>
            <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
            <br><br>

            <label for="playlist_name">Playlist Name:</label>
            <input type="text" name="playlist_name" value="<?php echo isset($playlist_name) ? $playlist_name : ''; ?>">
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
  $user_id = $_POST['user_id'];
  $playlist_name = $_POST['playlist_name'];

  // Update the playlist in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE playlist SET UserID=?, PlaylistName=? WHERE PlaylistID=?");
  $stmt->bind_param("isi", $user_id, $playlist_name, $playlist_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: playlist.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
