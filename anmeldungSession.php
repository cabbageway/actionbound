 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Auswahl Branchen</title>
  <meta charset="UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


<script>
	//alert("aus JS");
	
</script>
<style>
	#mystyle {
		position:relative;
		border: 1px solid green;
		
		left: 10px;
		padding:10px;
		font-size: 1.2em;
		font-family: Calibri
		border-radius: 5px;
	}
	form {
		position:relative;
		
		
		left: 20px;
	}
		
</style>
</head>
<body>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">ActionBound by HAKOST</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Ausstellungsplan</a></li>
      <li><a href="#">Spielstand</a></li>
      <li><a href="#">Hilfe</a></li>
    </ul>
  </div>
</nav>
<div class="container">
	
	


<?php
//session_name($_GET["nickname"]); // Der Session wird nicki zugeordnet
session_start();
$id=session_id();
$_SESSION["nickname"]=$_GET["nickname"];

$_SESSION["AnzahlFragen"]=10; // Wieviel Fragen pro Session gestellt werden
$_SESSION["AnzahlGestellteFragen"]=0; // Wieviel Fragen pro Session gestellt werden
$_SESSION["AnzahlErreichtePunkte"]=0;

echo " Die Session ".$id. "wurde gestartet<br>";
echo " Die Session hat den Namen ". session_name()."<br>";


include("db_connectLokal.php");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

else {
// ablegen der Verbindung in der Session Variable



echo "Ausgabe der Sessionvariable<br>";
print_r($_SESSION);
echo "Ende Ausgabe der Sessionvariable<br>";
echo "konnte DB actionbound gut erreichen";

$sql="SELECT * FROM angemeldet";
$result=mysqli_query($con,$sql);

// Return the number of rows in result set, Zähle die Zeilen
  $rowcount=mysqli_num_rows($result);

echo "<br>"."es sind ". $rowcount. " Benutzer angemeldet";

// Associative array
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
//printf ("%s (%s)\n",$row["Nachname"],$row["Vorname"]);


//while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	//echo $zeile["Nachname"]." ". $zeile["Vorname"]. ",";
//} 

// eintragen vom neuen User

$sql="INSERT INTO `angemeldet`(`Nickname`, `Nachname`, `Vorname`, `selfie`, `sessionID`) 
VALUES ('".$_GET['nickname']."','".$_GET['lastname']."','".$_GET['firstname']."','meni.jpg','".$id."')";
//echo $sql;
$result=mysqli_query($con,$sql);

// auslesen der Branchen und ausgeben

$sql="SELECT * FROM branchen";
$result=mysqli_query($con,$sql);

$rowcount=mysqli_num_rows($result);

echo "<br>"."es sind ". $rowcount. " Branchen auswählbar";
echo "<div id='mystyle'>";
	echo "<br>Welcome ".  $_GET["nickname"]. "<br />";
	
	echo "Du bist registriert und kannst jetzt loslegen <br />";
	echo "<p>Waehle bitte aus ob du Fragen von allen Austellern oder nur von einer Branche beantworten moechtest <br />
	</p> ";
	echo "<form class='form-horizontal' name='form1' action='fragenErstellen.php' method='get'>";
		echo "<div class='radio'>";
		echo "<input  type='radio'  name='branche' value='alle'>Alle Branchen</input>";
		echo "</div>";
		while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			$wert= $zeile["Branche"]; // damit nicht weitergezählt wird
			echo "<div class='radio'>";
			echo "<input type='radio'  name='branche'  value='".$wert."'>".$wert."</input>";
			echo "</div>";
		} 

		echo "<br><input  class='btn btn-success' type='submit' value='Los gehts'>";
	echo "</form>";
echo "</div>";  // mystyle
}  //ende else


mysqli_close($con);


?>


</div> <!-- Ende Container --> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>