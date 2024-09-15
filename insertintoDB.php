<?php 
$servername = "localhost" ;
$username ="cybr_hun7r" ;
$password = "fuckoff"; 
$dbname = "phpTest" ;


$conn = new mysqli($servername,$username,$password,$dbname) ;


if ($conn -> connect_error) {
    die("Connection faild: " . $conn->connect_error) ;

} 
echo "Connection Successfull <br>" ;




// insert data  

$sql = "   INSERT INTO USERS(FIRSTNAME , LASTNAME ,EMAIL)
        VALUES ('Bitch' , 'BEN' , 'MIKEADHIL2001@GMAIL.COM') 

" ; 

if ($conn->query($sql) === TRUE) {
    echo " new Details Inserted Successfully" ;
} else {
    echo "Error inserting  " . $conn->error ;

}

$conn->close() ;
?>