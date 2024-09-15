<html>

<head>

	<title>
	FORM
	</title>

</head>


<body>
	





<form method="post" action="">

Name : <input type ="text" name = "fname" >
<input type = "submit" > 

</form>



<?php 
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$name = htmlspecialchars ($_REQUEST['fname']) ;
	
	if (empty($name)) {
		echo "Empty name "  ;
		
	}else {
				echo "Hii " . $name ;

		
	}
		
	}
	
			
	
	$word = "mikebeneusltc";
	
	echo preg_match("/mike/i", $word) ;
	
	echo "<br>" ;	
	echo preg_replace("/mike/i" , "adhil",$word) ;
	?>







</body>

</html>