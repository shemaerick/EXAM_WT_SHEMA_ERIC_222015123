<?php
include('db_connection.php');

// Check if LikeID is set
if (isset($_REQUEST['like_id'])) {
  $like_id = $_REQUEST['like_id'];

  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM likes WHERE LikeID=?");
  $stmt->bind_param("i", $like_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $like_id = $row['LikeID'];
    $comment_id = $row['CommentID'];
    $user_id = $row['UserID'];
  } else {
    echo "Like not found.";
    exit; // Exit script if like not found
  }

  // Close the statement after use
  $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Like Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update like information form -->
        <h2><u>Update Like Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="comment_id">Comment ID:</label>
            <input type="text" name="comment_id" value="<?php echo isset($comment_id) ? $comment_id : ''; ?>">
            <br><br>

            <label for="user_id">User ID:</label>
            <input type="text" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $comment_id = $_POST['comment_id'];
  $user_id = $_POST['user_id'];

  // Update the like in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE likes SET CommentID=?, UserID=? WHERE LikeID=?");
  $stmt->bind_param("iii", $comment_id, $user_id, $like_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: likes.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
