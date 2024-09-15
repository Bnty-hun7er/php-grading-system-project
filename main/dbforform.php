<?php
// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email'])) {
    // Database connection settings
    $servername = "localhost";
    $username = "cybr_hun7r";
    $password = "fuckoff"; // Update this with your actual password
    $dbname = "formtest";

    // Connect to the database
    $dbcon = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }

    // Sanitize POST data
    $fname = $dbcon->real_escape_string($_POST['fname']);
    $lname = $dbcon->real_escape_string($_POST['lname']);
    $email = $dbcon->real_escape_string($_POST['email']);

    // SQL Insert query
    $sql = "INSERT INTO USERS (fname, lname, email) VALUES ('$fname', '$lname', '$email')";

    if ($dbcon->query($sql) === TRUE) {
        // Redirect to avoid form resubmission
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
        exit;
    } else {
        echo "Error inserting: " . $dbcon->error;
    }
}

// Display records
$servername = "localhost";
$username = "cybr_hun7r";
$password = "fuckoff"; // Update this with your actual password
$dbname = "formtest";

// Connect to the database
$dbcon = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($dbcon->connect_error) {
    die("Connection failed: " . $dbcon->connect_error);
}

// SQL Select query
$sql = "SELECT id, fname, lname, email FROM USERS";
$result = $dbcon->query($sql);

// Assuming $result contains the fetched data from the database

if ($result->num_rows > 0) {
    echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>FNAME</th>
            <th>LNAME</th>
            <th>EMAIL</th>
        </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td style=\"width:100px;\">{$row['id']}</td>
            <td>{$row['fname']}</td>
            <td>{$row['lname']}</td>
            <td>{$row['email']}</td>
        </tr>";
    }
    
    echo "</table>";
} else {
    echo "No records found.";
}


// Close the connection
$dbcon->close();
?>
