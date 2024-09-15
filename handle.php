<?php 

$name = $email= "" ;
$nameErr = $emailErr = "" ;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST['fname'])) {
			$nameErr= "Name is required" ;
			
		} else {
			$name = validate_name($_POST["fname"]) ;

		}

		if (empty($_POST['email'])) {
			$emailErr= "mail is required" ;
		} else {
			$email = validate_name($_POST["email"]) ;

		}


	

	
}


function validate_name($data) {
	
	$data= trim($data) ;
	$data = stripcslashes($data) ;
	$data = htmlspecialchars($data) ;
	return $data ; 
}


echo "Your Name is: " . $name ; 
echo "<br>" ;
echo "Your email is : " .$email ;


?>