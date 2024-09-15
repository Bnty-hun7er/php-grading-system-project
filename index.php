
<?php
echo "hibuddy" ;

echo "<br>";

var_dump($s = 4);

var_dump($s = "mike");
echo "<br>";

echo "<br>";

echo "<br>";


$fullString = "mynameisadhil" ;


echo  substr($fullString , 8 , 5);

function addNumbers( $x , $y):int {
	
	return $x + $y  ;
	
}

echo "<br>" ;

echo addNumbers(1.1,2.2) ;



echo "<br>";

// global variables 

	$glblVar = 5 ;
	
function checkGlobal () {
	echo "this is a global var :". $GLOBALS ['glblVar'] ;
}

checkGlobal() ;

echo "<br>" ;



// _SERVER varibales 

echo $_SERVER ['PHP_SELF'] ;
echo "<br>" ;

echo $_SERVER['SERVER_NAME'];
echo "<br>" ;

echo "<br>" ;
echo "<br>" ;
echo "<br>" ;
echo $_SERVER['HTTP_HOST'];
echo "<br>" ;
echo "<br>" ;

echo "<br>" ;
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>" ;
echo $_SERVER['SCRIPT_NAME'];

echo "<br>" ;
echo "<br>" ;

echo $_SERVER['SERVER_ADDR'] ;






?>