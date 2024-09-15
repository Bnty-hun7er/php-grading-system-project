<!DOCTYPE html>
<html>
<body>

<?php
$name = $email = "";
$nameErr = $emailErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the name
    if (empty($_POST["fname"])) {
        $nameErr = "Name is required";
    } else {
        $name = validate_name($_POST["fname"]);

    }

    // Validate the email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = validate_name($_POST["email"]);
		if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$emailErr="Invalid email" ;
		}
    }
}

// Function to validate and sanitize input
function validate_name($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!-- Form to collect data -->
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="fname" value="<?php echo $name; ?>">
    <span style="color:red;"><?php echo $nameErr; ?></span><br><br>

    E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
    <span style="color:red;"><?php echo $emailErr; ?></span><br><br>

    <input type="submit">
</form>

<!-- Display the validated input -->
<?php
if (!empty($name) && !empty($email)) {
    echo "<h3>Your Input:</h3>";
    echo "Your Name is: " . $name . "<br>";
    echo "Your Email is: " . $email . "<br>";
}
?>

</body>
</html>
