<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-10" />
	<title>SQL PHP lomake</title>
</head>
<body>
<h3> _13_02_MySQL_alkuvaiheet2.php </h3>
<?php 
// 0. VAIHE: Tietokannan luonti tai avaaminen
Print '<h3> TIETOKANNAN TIETOJENKÄSITTELYN ALKEITA </h3>';
// Muuttujien alkuarvoja - tarkista localhost/phpmyadmin
$servername = "localhost";// 
$username = "Knimi";//root
$password = "salasana";//Vaaditaan
$dbasename = "myDB_kanta";//Vaaditaan
$tblname = "tblNuorisoa"; // tarkista taulun nimi
$sql1= "SELECT * FROM $tblname ";// taulun tiedot poimitaan sql-lauseella


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
// Muuttujien alkuarvot lomakkeelta 
$servername = ($_POST["servername"]);//"localhost";// 
$username = ($_POST["username"]);//"Knimi";//root
$password = ($_POST["password"]);//"salasana";//Vaaditaan
$dbasename = ($_POST["dbasename"]);//"myDB_kanta";//Vaaditaan
$tblname = ($_POST["tblname"]);//"tblNuorisoa"; // tarkista taulun nimi
$sql1= ($_POST["sql1"]);//"SELECT * FROM $tblname ";// taulun tiedot poimitaan sql-lauseella
// tarkistetaan onko annettu poimintaehtoja
	if (strlen($_POST["enimi"]) > 0) 
	{ $sql1 = ($_POST["sql1"]) . "$tblname   WHERE enimi like '". $_POST["enimi"] ."'; ";
	}  
	elseif (strlen($_POST["snimi"]) > 0) 
	{ $sql1 = ($_POST["sql1"]) . "$tblname   WHERE snimi like '". $_POST["snimi"] ."'; ";
	}  else {$sql1 = ($_POST["sql1"]) . $tblname;}	
	Print $sql1 . "<br>" ;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbasename);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// luodaan yhteys tietokannan tauluun
$database = new mysqli($servername, $username, $password, $dbasename);

$result = $database->query($sql1);

// esitellään rivinro-muuttuja jonka alkuarvoksi laitetaan 0
$rivinro = 0;
// print 'While-rakenteella listataan tiedot: <br><br>';
if ($result->num_rows > 0) {
    // taulun kaikki rivit näkyviin 
    while($rivi = $result->fetch_assoc()) 
	{  $rivinro = $rivinro + 1;
    echo "Rivi: $rivinro " . 'Nimi: ' . $rivi['enimi'] . ' ' . 
	$rivi['snimi'] .' E-mail: ' . $rivi['sposti'] . 
	' Tunnus: ' . $rivi['tunnus'] . '<br>';
	}
	} else {
    echo "Taulussa ei ole tietoja /rivejä = 0 riviä";
}
print "<br>Taulusta raportoitiin rivejä ". $rivinro . " kpl.";
// Tietokantayhteys tauluun suljetaan
$database->close();
// loppuun laitetaan merkki onnistuneesta ajosta:)
print '<br>*---- Raportti - LOPPU ----*';
	
	print '<br> *-------- Raportti ---------* <br><br><br>';
	print '<a href="_13_02_MySQL_alkuvaiheet2.php"> Paluu alkuun </a>';
	exit;
	};
?>
<form action="_13_02_MySQL_alkuvaiheet2.php" method="post">
	<p>Palvelin: <input type="text" name="servername" size="20" value="localhost" /> </p>
	<p>Tietokanta: <input type="text" name="dbasename" size="20" value="myDB_kanta" /> </p>
	<p>Käyttäjätunnus: <input type="text" name="username" size="20" value="Knimi" /> </p>
	<p>Salasana: <input type="text" name="password" size="20" value="salasana" /> </p>
	<p>Taulu: <input type="text" name="tblname" size="20" value="tblNuorisoa" /> </p>
	<p>SQL: <input type="text" name="sql1" size="20" value="SELECT * FROM " /> </p>
<p>VALINTAEHTOJA: WHERE <p>
	<p>Etunimi <input type="text" name="enimi" size="20" value="Elke"/> </p>
	<p>Sukunimi <input type="text" name="snimi" size="20" value=""/> </p>
	<br>
	<input type="submit" name="submit" value="Hae valitut tiedot" />
</form>


</body>
</html>