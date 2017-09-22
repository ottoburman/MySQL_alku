<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-10" />
	<title>MySQL - alku</title>
</head>
<body>
<h3> _13_01_SQLite_alkuvaiheet1.php </h3>
<?php 
// Muuttujien alkuarvoja - tarkista localhost/phpmyadmin
$servername = "localhost";// 
$username = "Knimi";//root
$password = "salasana";//Vaaditaan
$dbasename = "myDB_kanta";//Vaaditaan
$tblname = "tblNuorisoa"; // tarkista taulun nimi
$sql1= "SELECT * FROM $tblname ";// taulun tiedot poimitaan sql-lauseella
// Create connection - nyt luodaan yhteys tietokannan tauluun
$database = new mysqli($servername, $username, $password, $dbasename);
// Kyselyn tulos
$result = $database->query($sql1);
// esitellään rivinro-muuttuja jonka alkuarvoksi laitetaan 0
$rivinro = 0;
// 
print 'While-rakenteella listataan tiedot: <br><br>';
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
?>
</body>
</html>