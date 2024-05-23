<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {

 include('db_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'clients' => "SELECT  Age FROM clients WHERE Age LIKE '%$searchTerm%'",
        'comments' => "SELECT CommentID FROM comments WHERE CommentID LIKE '%$searchTerm%'",
        'likes' => "SELECT  UserID FROM likes WHERE  UserID LIKE '%$searchTerm%'",
        'playlist' => "SELECT  PlaylistName FROM playlist WHERE PlaylistName LIKE '%$searchTerm%'",
        'session_playlist' => "SELECT PlaylistID FROM session_playlist WHERE PlaylistID LIKE '%$searchTerm%'",
         'session_songs' => "SELECT SongID FROM session_songs WHERE SongID LIKE '%$searchTerm%'",
        'sessions' => "SELECT SessionID FROM sessions WHERE SessionID LIKE '%$searchTerm%'",
        'songs' => "SELECT Artist FROM songs WHERE  Artist LIKE '%$searchTerm%'",
        'therapists' => "SELECT Specialization FROM therapists WHERE Specialization LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>


