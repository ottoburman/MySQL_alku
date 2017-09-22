<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>MySQL - alku</title>
</head>
<body>
<h3> _13_00_MySQL.php </h3>
<?php
/* Selaimessa käynnistä localhost/phpMyAdmin
Tarkista 
lipuke Tietokannat että muodostettacvaa tietokantaas ei ole jo olemassa!
lipuke Käyttäjätilit käytettävät username hostname salasana
Luo uusi käyttäjä: Knimi ja anna hänelle salasana
*/
// Oletus
$servername = "localhost";// 
$username = "root";//root
$password = "";//Ei vaadita

// Muutoksen jälkeen
$servername = "localhost";// 
$username = "Knimi";//root
$password = "salasana";//Vaaditaan
$dbasename = "myDB_kanta";//Vaaditaan

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
Print "<br> CREATE DATABSE $dbasename <br><br>";
$sql = "CREATE DATABASE $dbasename";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error ."<br>";
}

$conn->close();

$database = new mysqli($servername, $username, $password, $dbasename);

Print '<br> DEMO: <br> CREATE TABLE <br>';
$sql1= ' CREATE TABLE tblNuorisoa (
tunnus INTEGER PRIMARY KEY,
enimi TEXT, snimi TEXT,sposti TEXT)';
$result = $database->query($sql1);

Print 'INSERT INTO'.'<br>';
$sql2= 
' INSERT INTO 
tblNuorisoa( tunnus, enimi ,  snimi ,    sposti )
VALUES ( 10, "Vesta", "Burman", "VestanPosti@VestanPosti"); ' .
' INSERT INTO
tblNuorisoa( tunnus, enimi ,  snimi ,    sposti )
VALUES ( 20, "Elke", "Burman", "ElkenPosti@ElkenPosti") ;' . 
' INSERT INTO
tblNuorisoa( tunnus, enimi ,  snimi ,    sposti )
VALUES ( 30, "Isa", "Burman", "IsanPosti@IsanPosti") ;' 
;
$result = $database->multi_query($sql2);

print ' SELECT * FROM' .'<br><br>';

$result2 = $database->query('SELECT * FROM tblNuorisoa');

$rivinro = 0;
if ($result2->num_rows > 0) {
    // output data of each row
    while($rivi = $result2->fetch_assoc()) 
	{  $rivinro = $rivinro + 1;
    echo "Rivi: $rivinro " . 'Nimi: ' . $rivi['enimi'] . ' ' . 
	$rivi['snimi'] .' E-mail: ' . $rivi['sposti'] . 
	' Tunnus: ' . $rivi['tunnus'] . '<br><br>';
	}
	} else {
    echo "0 riviä";
}
$database->close();

print '*--------*';
?>
</body>
</html>