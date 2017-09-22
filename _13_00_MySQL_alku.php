<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-10" />
	<title>SQL - alku</title>
</head>
<body>
<h3> _13_00_MySQL_alku.php </h3>
<?php 
// Johdantoa MySQL-tietokannan k�ytt��n
// Oletusasetuksia
$servername = "localhost";// 
$username = "root";//root
$password = "";//Ei vaadita
// Muutoksen j�lkeen
$servername = "localhost";// 
$username = "Knimi";//root
$password = "salasana";//Vaaditaan
$dbasename = "myDB_kanta";//Vaaditaan

// Create database - tehty ohjelmassa
// Create table - tehty aiemmassa ohjelmassa 
/* $sql1= ' CREATE TABLE tblNuorisoa ( tunnus INTEGER PRIMARY KEY,
enimi TEXT, snimi TEXT,sposti TEXT)';
$result = $database->query($sql1); */
// Create connection - nyt luiodaan yhteys tietokannan tauluun
$database = new mysqli($servername, $username, $password, $dbasename);
// Lisätään vielä 3 tietuetta
Print 'Lisätään tietueita: INSERT INTO'.'<br>';
$sql2= ' INSERT INTO 
tblNuorisoa( tunnus, enimi ,  snimi ,    sposti )
VALUES ( 100, "Pilvi", "Burman", "PilvinPosti@Posti"); ' .
' INSERT INTO
tblNuorisoa( tunnus, enimi ,  snimi ,    sposti )
VALUES ( 200, "Otto", "Burman", "ElkenPosti@Posti") ;' . 
' INSERT INTO
tblNuorisoa( tunnus, enimi ,  snimi ,    sposti )
VALUES ( 300, "Bööna", "Burman", "BöönanPosti@Posti") ;' ;
// Suoritetaan kysely multi_query-funktiolla
$result = $database->multi_query($sql2);
// Tulostetaan taulun tiedot
print 'Valitaan taulun tiedot: SELECT * FROM' .'<br><br>';
// Suoritetaan kysely query-funktiolla 
$result = $database->query('SELECT * FROM tblNuorisoa;');
// esitellään muuttuja jonka alkuarvoksi laitetaan 0
$rivinro = 0;
// 
print 'While-rakenteella listataan tiedot: <br><br>';
if ($result->num_rows > 0) {
    // taulun kaikki rivit näkyviin 
    while($rivi = $result->fetch_assoc()) 
	{  $rivinro = $rivinro + 1;
    echo "Rivi: $rivinro " . 'Nimi: ' . $rivi['enimi'] . ' ' . 
	$rivi['snimi'] .' E-mail: ' . $rivi['sposti'] . 
	' Tunnus: ' . $rivi['tunnus'] . '<br><br>';
	}
	} else {
    echo "Taulussa ei ole tietoja /rivejä = 0 riviä";
}
// Tietokantayhteys tauluun suljetaan
$database->close();
// loppuun laitetaan merkki
print '*---- LOPPU ----*';
?>
</body>
</html>