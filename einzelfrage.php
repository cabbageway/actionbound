<?php
	
	session_start();
	
	if (isset($_GET["SessionEnde"])) {
		echo "Deine Session wird beendet";
		echo "Deine Session wird beendet";
		session_destroy();
		include("index.php");  // Der User kann sich wieder neu anmelden
		exit;
		}
	if ($_SESSION["AnzahlGestellteFragen"]==10) {
		
		echo "du hast alle 10 Fragen beantwortet und soviel Punkte erreicht";
		echo "Deine Session wird beendet";
		session_destroy();
		exit;
	}
	else 
		$_SESSION["AnzahlGestellteFragen"]++;  //Anzahl der gestellten Fragen wird erhöht
	
	// print_r($_SESSION);
	// neue Frage wird ausgesucht
	$anz= count($_SESSION["Fragenliste"]);  // Wieviel Fragen gibt es insgesamt
	
	echo "Die Frage wurde aus ".$anz. " Fragen ausgewählt<br>"; 
	
	if (isset($_GET['AusstellerID']))
		echo "Ausstellerid = ". $_GET['AusstellerID'];
	if ($_GET['AusstellerID']=='0'){  // bei 0 (kein Aussteller gewählt) muss eine Zufallszahl gefunden werden, die noch nicht gestellt wurde
		do {
		$zufallswert = rand(1,$anz-1);  //wurde um 1 erniedrigt noch testen 06.08
		} while ($_SESSION["Fragenliste"][$zufallswert][2]==1);  //[2] ist gestellt
	}
	else { // durchlaufe alle AustellerIDs und schau auch ob Frage bereits gestellt wurde
		for ($i = 1; $i < $anz; $i++) {
			if ($_SESSION["Fragenliste"][$i][3]== $_GET['AusstellerID'] && $_SESSION["Fragenliste"][$i][2]==0) {
				$zufallswert = $i;
				$i=$anz; //raus aus dem for
			}
		}
		if ($i == $anz){
			echo " es gibt keine Fragen von diesem Aussteller mehr - Es wird eine Zufallsfrage ausgewählt";
			do {
				$zufallswert = rand(1,$anz-1);  //
			} while ($_SESSION["Fragenliste"][$zufallswert][2]==1);  //[2] ist gestellt
		}
	}
		
	$frageart = $_SESSION["Fragenliste"][$zufallswert][1]; // question_zuordnung, question_text ..
	$frageNr = $_SESSION["Fragenliste"][$zufallswert][0];  //Fragennummer aus der jeweiligen question_table
	echo "Die Frage ".$zufallswert. " aus der Fragenliste wurde für dich  ausgewählt<br>"; 
	echo "Die Fragenr ".$frageNr . " aus der Tabelle ". $frageart. " <br>";
	$_SESSION["aktuellerZufallswert"]=$zufallswert;  // aktuelle Frage für die Auswertung
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Frage</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
</style>
  </head>
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
	// in der Datei  müssen per Zufall Fragen ausgewählt werden und gestellt werden 
	
	
	
	// in der Session wird die aktuelle Frage abgespeichert damit im Folgeschirm der Wert
	// eingetragen werden kann. 

	
	
	include("db_connectLokal.php");
// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	else {
	    echo "<div id='mystyle'>";
		echo "<form class='form-horizontal' name='form1' action='frageAuswerten.php' method='get'>";
		switch ($frageart) {
		
			case "question_zuordnung": 
								$sql="SELECT * FROM `question_zuordnung` WHERE `QZUID` = ". $frageNr; 
								
								$result=mysqli_query($con,$sql);
								while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
									 //holen der Ausstellerdaten Standdaten 
									 $sql2="SELECT * FROM `aussteller` WHERE `AusstellerID` = ". $zeile["AusstellerID"]; 
									 echo $sql2;
									 $result2=mysqli_query($con,$sql2);
									 $zeile2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
									 echo "<br>Standdaten";
									 echo "<br><p>".$zeile2["Name"]. ", ". $zeile2["Standnummer"]. "</p><hr>";
									 // Fragedaten
									 echo "<br><p>". $zeile["QZUID"]. ", ". $zeile["FrageWasgehoertZusammen"]. "</p>";
									 echo "Begriff A 	Auswahl A <br>";
									 echo "Begriff B 	Auswahl B <br>";
									 echo "Begriff C 	Auswahl C <br>";
									 echo "Begriff D 	Auswahl D <br>";
									 
									 echo " Tippe auf die Begriffe die zusammengehören";
								}
							
								break;
								
			case "question_multiple": 
								$sql="SELECT * FROM `question_multiple` WHERE `QMID` = ". $frageNr; 
								
								$result=mysqli_query($con,$sql);
								while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
									 //holen der Ausstellerdaten Standdaten 
									 $sql2="SELECT * FROM `aussteller` WHERE `AusstellerID` = ". $zeile["AusstellerID"]; 
									 echo $sql2;
									 $result2=mysqli_query($con,$sql2);
									 $zeile2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
									 echo "<br>Standdaten";
									 echo "<br><p>".$zeile2["Name"]. ", ". $zeile2["Standnummer"]. "</p><hr>";
									 // Fragedaten
									 echo "<br><p>".$zeile["QMID"]. ", ". $zeile["Fragetext"]. "</p>";
									 echo "<input type='radio' name='loesung' value=''>Lösung A<br>";
									 echo "<input type='radio' name='loesung' value=''>Lösung B<br>";
									 echo "<input type='radio' name='loesung' value=''>Lösung C<br>";
									 echo "<input type='radio' name='loesung' value=''>Lösung D<br>";
								}
							
								break;
								
			case "question_schaetzspiel": 
								$sql="SELECT * FROM `question_schaetzspiel` WHERE `QSID` = ". $frageNr; 
								echo $sql."<br>";
								$result=mysqli_query($con,$sql);
								while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
									 //holen der Ausstellerdaten Standdaten 
									 $sql2="SELECT * FROM `aussteller` WHERE `AusstellerID` = ". $zeile["AusstellerID"]; 
									 echo $sql2;
									 $result2=mysqli_query($con,$sql2);
									 $zeile2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
									 echo "<br>Standdaten";
									 echo "<br><p>".$zeile2["Name"]. ", ". $zeile2["Standnummer"]. "</p>";
									 // Fragedaten
									 echo "Frage:<br>";
									 echo "<p>".$zeile["QSID"]. ", ". $zeile["AusstellerID"]. ", ".$zeile["Frage"]. "</p>";
									 echo "<input type='text' name='schaetzwert' value='Schätzwert'><br>";
								}
							
								break;
			
			case "question_text": 
								$sql="SELECT * FROM `question_text` WHERE `TextfrageID` = ". $frageNr; 
								
								$result=mysqli_query($con,$sql);
								while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
									 //holen der Ausstellerdaten Standdaten 
									 $sql2="SELECT * FROM `aussteller` WHERE `AusstellerID` = ". $zeile["AusstellerID"]; 
									 echo $sql2;
									 $result2=mysqli_query($con,$sql2);
									 $zeile2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
									 echo "<br>Standdaten";
									 echo "<br><p>".$zeile2["Name"]. ", ". $zeile2["Standnummer"]. "</p>";
									 // Fragedaten
									 
									 echo "<br><p>".$zeile["TextfrageID"]. ", ". $zeile["Frage"]. "</p>";
									 echo "<input type='text' size='50' name='loesungsbegriffe' value=''><br>";
								}
							
								break;
								
								
			
		}
		
		
	
	}  //ende else


	mysqli_close($con);
	?>
	
<p> Wähle die richtige Antwort und werte dann die Frage aus</p>

	<?php 
	
		echo "<input class='btn btn-success' type='submit' value='Frage auswerten'>";
	echo "</form>";
	echo "</div>";
     ?>
</body>

</html>