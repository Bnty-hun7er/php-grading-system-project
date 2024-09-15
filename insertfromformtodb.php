<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form to DB</title>
</head>

<body>

    <?php
    include 'dbforform.php'; // Include the database processing file

    $fname = $lname = $email = "";
    $fnameErr = $lnameErr = $emailErr = "";
    $formsubmited = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // First Name
        if (empty($_POST['fname'])) {
            $fnameErr = "First name is required";
        } else {
            $fname = validate_name($_POST['fname']);
        }

        // Last Name
        if (empty($_POST['lname'])) {
            $lnameErr = "Last name is required";
        } else {
            $lname = validate_name($_POST['lname']);
        }

        // Email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = validate_name($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Only submit form data to the database if no validation errors
        if (empty($fnameErr) && empty($lnameErr) && empty($emailErr)) {
            $formsubmited = true;
        }
    }

    // Function to sanitize user input
    function validate_name($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <!-- Success message after redirect -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p style="color:green;">Record inserted successfully!</p>
    <?php endif; ?>

    <!-- Form to collect user data -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <td>Name: </td>
                <td>
                    <input type="text" name="fname" placeholder="First Name" value="<?php echo $fname; ?>">
                    <span style="color:red;"><?php echo $fnameErr; ?></span>
                </td>
                <td>
                    <input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>">
                    <span style="color:red;"><?php echo $lnameErr; ?></span>
                </td>
            </tr>
            <tr>
                <td>Email: </td>
                <td>
                    <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
                    <span style="color:red;"><?php echo $emailErr; ?></span>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>

</body>

</html>
