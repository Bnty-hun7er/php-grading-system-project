<?php

$fname = $lname = $email = "";
$fnameErr = $lnameErr = $emailErr = "";
$formSubmitted = false; // Flag to avoid repeated submissions

// Process form only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate first name
    if (empty($_POST['fname'])) {
        $fnameErr = "First name is required";
    } else {
        $fname = validate_name($_POST['fname']);
    }

    // Validate last name
    if (empty($_POST['lname'])) {
        $lnameErr = "Last name is required";
    } else {
        $lname = validate_name($_POST['lname']);
    }

    // Validate email
    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else {
        $email = validate_name($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Insert into database only if no errors
    if (empty($fnameErr) && empty($lnameErr) && empty($emailErr)) {
        // Database connection
        $severname = "localhost";
        $username =  "cybr_hun7r";
        $pasword = "fuckoff"; // Ensure your actual password is used
        $dbname = "formtest";

        $dbcon = new mysqli($severname, $username, $pasword, $dbname);

        // Check the connection
        if ($dbcon->connect_error) {
            die("Connection error: " . $dbcon->connect_error);
        }

        // Insert the record into the database
        $sql = "INSERT INTO USERS (fname, lname, email) VALUES ('$fname', '$lname', '$email')";

        if ($dbcon->query($sql) === TRUE) {
            // Redirect to the same page to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }

        $dbcon->close(); // Close the connection
    }
}

// Function to sanitize user input
function validate_name($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form to DB</title>
</head>
<body>

    <!-- Success message after redirection -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p style="color:green;">Record inserted successfully!</p>
    <?php endif; ?>

    <!-- Form to collect user data -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <td>Name: </td>
                <td><input type="text" name="fname" placeholder="First Name">
                    <span style="color:red;"><?php echo $fnameErr; ?></span>
                </td>
                <td><input type="text" name="lname" placeholder="Last Name">
                    <span style="color:red;"><?php echo $lnameErr; ?></span>
                </td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><input type="email" name="email" placeholder="Email">
                    <span style="color:red;"><?php echo $emailErr; ?></span>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>

    <!-- Display records from the database -->
    <?php
    // Database connection again to fetch records
    $severname = "localhost";
    $username =  "cybr_hun7r";
    $pasword = "fuckoff"; // Ensure your actual password is used
    $dbname = "formtest";
    $dbcon = new mysqli($severname, $username, $pasword, $dbname);
    
    $sql = "SELECT id, fname, lname, email FROM USERS";
    $result = $dbcon->query($sql);

    if ($result->num_rows > 0) {
        // Output each record from the database
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Name: " . $row["fname"] . " " . $row["lname"] . " - Email: " . $row["email"] . "<br>";
        }
    } else {
        echo "No results found.";
    }

    $dbcon->close(); // Close the connection
    ?>

</body>
</html>
