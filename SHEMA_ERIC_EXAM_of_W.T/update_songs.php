<?php
include('db_connection.php');

// Check if Song ID is set
if (isset($_REQUEST['song_id'])) {
  $song_id = $_REQUEST['song_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM songs WHERE SongID=?");
  $stmt->bind_param("i", $song_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $song_id = $row['SongID'];
    $title = $row['Title'];
    $artist = $row['Artist'];
    $duration = $row['DurationSeconds'];
    $genre = $row['Genre'];
  } else {
    echo "Song not found.";
    exit; // Exit script if song not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Song Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update song information form -->
        <h2><u>Update Song Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
            <br><br>

            <label for="artist">Artist:</label>
            <input type="text" name="artist" value="<?php echo isset($artist) ? $artist : ''; ?>">
            <br><br>

            <label for="duration">Duration (Seconds):</label>
            <input type="text" name="duration" value="<?php echo isset($duration) ? $duration : ''; ?>">
            <br><br>

            <label for="genre">Genre:</label>
            <input type="text" name="genre" value="<?php echo isset($genre) ? $genre : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $title = $_POST['title'];
  $artist = $_POST['artist'];
  $duration = $_POST['duration'];
  $genre = $_POST['genre'];

  // Update the song in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE songs SET Title=?, Artist=?, DurationSeconds=?, Genre=? WHERE SongID=?");
  $stmt->bind_param("sssii", $title, $artist, $duration, $genre, $song_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: songs.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
