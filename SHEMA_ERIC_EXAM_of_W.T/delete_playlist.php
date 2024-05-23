<?php
include('db_connection.php');

// Check if PlaylistID is set
if(isset($_REQUEST['playlist_id'])) {
    $playlist_id = $_REQUEST['playlist_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM playlist WHERE PlaylistID=?");
    $stmt->bind_param("i", $playlist_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="playlist_id" value="<?php echo $playlist_id; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Playlist ID is not set.";
}

$connection->close();
?>
