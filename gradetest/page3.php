<?php

$year = $_GET["year"];
$accyear = $_GET["accyear"];
$sem = $_GET["sem"];
$subject = $_GET["subject"];

$servername = "localhost";
$username = "cybr_hun7r";
$password = "fuckoff"; 

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connect to the new database
$dbName = $year . "_Y_" . $accyear . "_S_" . $sem;
$conn->select_db($dbName);

// Create the table 'Marks' with user-provided subject
$tableName = "Marks_" . $subject;
$sqlCreateTable = "CREATE TABLE $tableName (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
    index_No VARCHAR(20) NOT NULL,
    ca1 INT,
    ca2 INT,
    ca3 INT,
    avgCA FLOAT,
    exam_marks INT,
    avg_marks FLOAT,
    grade VARCHAR(2)
)";

if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Table '$tableName' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
    exit();
}

// Copy data from another database to this table
$sourceDB = "students";  // Source database name
$sourceTable = "students";  // Source table name

// Copy the id and index_No columns from the source table
$sqlCopyData = "INSERT INTO $tableName (id, index_No)
                SELECT id, index_number FROM $sourceDB.$sourceTable";

if ($conn->query($sqlCopyData) === TRUE) {
    echo "Data copied successfully from $sourceTable to $tableName";
} else {
    echo "Error copying data: " . $conn->error;
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grading</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Grading System</h1>
        <h2>Eastern University of Sri Lanka</h2>
        <h2>Trincomalee Campus</h2>
    </div>

    <div class="yeardiv">
        <h3><?php echo "Year: " .$year; ?></h3>
        <h3><?php echo "Y: " .$accyear . "     Sem: " .$sem; ?></h3>
    </div>
    <hr>
    <h3><?php echo "Marks for: ".$subject;?></h3>

    


    <?php

$servername = "localhost";
$username = "cybr_hun7r" ;
$password = "fuckoff" ;


$conn = new mysqli($servername, $username, $password);

$dbName = $year . "_Y_" . $accyear . "_S_" . $sem;
$conn->select_db($dbName);



$sql = "SELECT id, index_no FROM $tableName";
$result = $conn->query($sql);

// Assuming $result contains the fetched data from the database

if ($result->num_rows > 0) {
    echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Index NO</th>
            
        </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td style=\"width:100px;\">{$row['id']}</td>
            <td>{$row['index_no']}</td>
            
        </tr>";
    }
    
    echo "</table>";
} else {
    echo "No records found.";
}


$conn->close();
    ?>


<form action="page2.php" method="get">
        <!-- Pass the same year, accyear, and sem to Page 2 -->
        <input type="hidden" name="year" value="<?php echo $year; ?>">
        <input type="hidden" name="accyear" value="<?php echo $accyear; ?>">
        <input type="hidden" name="sem" value="<?php echo $sem; ?>">
        <button type="submit" style="margin-top: 20px;">Add Another Subject</button>
    </form>
    
</body>
</html>
