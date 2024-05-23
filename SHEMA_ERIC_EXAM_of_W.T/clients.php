<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CLIENTS Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
        
  </head>

  <header>

<body bgcolor="green">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/OIP.jfif" width="90" height="60" alt="Logo">
  </li>
      <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./clients.php">Clients</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./comments.php">Comments</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./likes.php">Likes</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./playlist.php">Playlist</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./sessions.php">Sessions</a>
  </li>  <li style="display: inline; margin-right: 10px;"><a href="./session_playlist.php">Session_playlist</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./session_songs.php">Session_songs</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./songs.php">Songs</a>
   </li>
   <li style="display: inline; margin-right: 10px;"><a href="./therapists.php">Therapists</a>
   </li>
   
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
    <h1><u>CLIENTS Form</u></h1>

<form method="post" onsubmit="return confirmInsert();">


    <label for="ClientID">ClientID:</label>
    <input type="number" id="book_id" name="book_id" required><br><br>

    <label for="UserID">UserID:</label>
    <input type="number" id="ride_id" name="ride_id" required><br><br>

    <label for="Age">Age:</label>
    <input type="number" id="passenger_id" name="passenger_id" required><br><br>

    <label for="gend">Gender:</label>
        <select name="gend" id="gend">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>
    </select><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO clients(ClientID, UserID, Age, Gender) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $ClientID, $UserID, $Age, $Gender);
    // Set parameters and execute
    $ClientID = $_POST['book_id'];
    $UserID = $_POST['ride_id'];
    $Age = $_POST['passenger_id'];
    $Gender = $_POST['gend'];

    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>clients Table</h2></center>
    <table border="3">
        <tr>

            <th>ClientID</th>
            <th>UserID</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all clients
$sql = "SELECT * FROM clients";
$result = $connection->query($sql);

// Check if there are any clients
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $ClientID = $row['ClientID']; // Fetch the ClientID
        echo "<tr>

            <td>" . $row['ClientID'] . "</td>
            <td>" . $row['UserID'] . "</td>
            <td>" . $row['Age'] . "</td>
            <td>" . $row['Gender'] . "</td>
            <td><a style='padding:4px' href='delete_clients.php?ClientID=$ClientID'>Delete</a></td> 
            <td><a style='padding:4px' href='update_clients.php?ClientID=$ClientID'>Update</a></td> 
        </tr>";
    }

} else {
    echo "<tr><td colspan='7'>No data found</td></tr>";
}
// Close the database connection
$connection->close();
?>
      </table>

</body>

</section>
 
<footer>
  <center> 
   <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by:SHEMA ERIC</h2></b>
  </center>
</footer>
  
</body>
</html>

