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




// create database / table  

$sql = " CREATE TABLE USERS(
ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
FIRSTNAME VARCHAR (30) NOT NULL ,
LASTNAME VARCHAR (30) NOT NULL ,
EMAIL VARCHAR(50)  
)" ; 

if ($conn->query($sql) === TRUE) {
    echo "USERS TABLE  created  successfully" ;
} else {
    echo "Error creating table " . $conn->error ;

}

$conn->close() ;
?>