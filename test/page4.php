<?php
// Database connection details
$servername = "localhost";
$username = "cybr_hun7r";
$password = "fuckoff";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form data
$year = isset($_POST["year"]) ? (int)$_POST["year"] : 0;
$accyear = isset($_POST["accyear"]) ? (int)$_POST["accyear"] : 0;
$sem = isset($_POST["sem"]) ? (int)$_POST["sem"] : 0;
$subject = isset($_POST["subject"]) ? mysqli_real_escape_string($conn, $_POST["subject"]) : '';

// Debugging output
echo "Year: $year<br>";
echo "Accyear: $accyear<br>";
echo "Sem: $sem<br>";
echo "Subject: $subject<br>";

// Check if required parameters are present
if ($year === 0 || $accyear === 0 || $sem === 0 || empty($subject)) {
    die("Missing parameters.");
}

// Select the database
$dbName = $year . "_Y_" . $accyear . "_S_" . $sem;
$conn->select_db($dbName);

$tableName = "Marks_" . $subject;

// Prepare the SQL statement
$sql = "UPDATE $tableName SET 
        ca1 = ?, 
        ca2 = ?, 
        ca3 = ?, 
        avgCA = ?, 
        exam_marks = ?, 
        avg_marks = ?, 
        grade = ? 
        WHERE id = ?";
$stmt = $conn->prepare($sql);

// Check if statement preparation was successful
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("iiididsi", $ca1, $ca2, $ca3, $avgCA, $examMarks, $avgMarks, $grade, $id);

// Loop through POST data and update records
foreach ($_POST['ca1'] as $id => $ca1) {
    $ca1 = (int)$ca1;
    $ca2 = isset($_POST['ca2'][$id]) ? (int)$_POST['ca2'][$id] : 0;
    $ca3 = isset($_POST['ca3'][$id]) ? (int)$_POST['ca3'][$id] : 0;
    $examMarks = isset($_POST['exam_marks'][$id]) ? (int)$_POST['exam_marks'][$id] : 0;
    
    $avgCA = ($ca1 + $ca2 + $ca3) / 3;
    $avgMarks = ($avgCA ) + ($examMarks );

    // Calculate grade
    $grade = 'F';
    if ($avgMarks >= 80) {
        $grade = 'A';
    } elseif ($avgMarks >= 70) {
        $grade = 'B';
    } elseif ($avgMarks >= 60) {
        $grade = 'C';
    } elseif ($avgMarks >= 50) {
        $grade = 'D';
    }

    // Execute the prepared statement
    if (!$stmt->execute()) {
        echo "Error updating record with ID $id: " . $stmt->error;
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect with parameters
header("Location: page3.php?year=$year&accyear=$accyear&sem=$sem&subject=" . urlencode($subject));
exit;
?>
