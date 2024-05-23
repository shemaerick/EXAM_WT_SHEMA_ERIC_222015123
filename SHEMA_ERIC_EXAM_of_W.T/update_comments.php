<?php
include('db_connection.php');

// Check if CommentID is set
if (isset($_REQUEST['comment_id'])) {
  $comment_id = $_REQUEST['comment_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM comments WHERE CommentID=?");
  $stmt->bind_param("i", $comment_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $comment_id = $row['CommentID'];
    $session_id = $row['SessionID'];
    $user_id = $row['UserID'];
    $comment = $row['Comment'];
    $date = $row['Date'];
  } else {
    echo "Comment not found.";
    exit; // Exit script if comment not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Comment Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update comment information form -->
        <h2><u>Update Comment Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="session_id">Session ID:</label>
            <input type="text" name="session_id" value="<?php echo isset($session_id) ? $session_id : ''; ?>">
            <br><br>

            <label for="user_id">User ID:</label>
            <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
            <br><br>

            <label for="comment">Comment:</label>
            <input type="text" name="comment" value="<?php echo isset($comment) ? $comment : ''; ?>">
            <br><br>

            <label for="date">Date:</label>
            <input type="text" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
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
  $user_id = $_POST['user_id'];
  $comment = $_POST['comment'];
  $date = $_POST['date'];

  // Update the comment in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE comments SET SessionID=?, UserID=?, Comment=?, Date=? WHERE CommentID=?");
  $stmt->bind_param("iissi", $session_id, $user_id, $comment, $date, $comment_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: comments.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
