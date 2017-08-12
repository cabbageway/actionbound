

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
	div {
		position:relative;
		border: 1px solid green;
		width:50%;
		left: 10px;
		padding:10px;
		font-size: 1em;
	}


</style>
  </head>
<body>
	
	
	<?php
	// im folgenden werden die Fragen der auswählten Tabelle gelistet und sie können dann ergänzt
	//werden.
	//Löschen und Bearbeiten vorhanderer ist noch optional

	$tabelle = $_GET["tabelle"];
	echo "Inhalte der Tabelle ".$tabelle;
	
	include("db_connectLokal.php");
// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	else {
		
		$sql="SELECT * FROM `".$tabelle."` WHERE 1";
				//echo $sql;
				$result=mysqli_query($con,$sql);

				$rowcount=mysqli_num_rows($result);
				
				echo "<br>Diese Tabelle hat " . $rowcount . " Fragen<br>";
		$sql2="SELECT * FROM `aussteller` WHERE 1";
		$result2=mysqli_query($con,$sql2);
		echo "<div>";
		switch($tabelle) {
			case "question_multiple" :
				
				echo "QMID 	AusstellerID 	Fragetext 	Antwort_A 	Antwort_B 	Antwort_C 	Antwort_D 	Loesung";
				while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
					echo $zeile['QMID'] . "<br> ". $zeile['Fragetext']. "<br> ".$zeile['Antwort_A']. " <br>".$zeile['Antwort_B']. " <br>".$zeile['Antwort_C']. "<br> ".$zeile['Antwort_D']. "<br> ".$zeile['Loesung']. "<br><hr> ";
					 
				}
				echo "Bitte neue Fragen eingeben:";
				echo "<form name='form1' action='adminTabelleSpeichern.php' method='get'>";
				echo "<br><label>Aussteller (ID)</label> <select  name='AusstellerID' >";
					while ($zeile2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
						
						echo "<option value='".$zeile2['AusstellerID']. "'>".$zeile2['Name']."</option> ";
					 
					}
				echo "</select><br><hr>";
				echo "<br><label>Fragetext</label> <input  name='Fragetext' type='text' >";
				echo "<br><label>Antwort_A</label> <input  name='Antwort_A' type='text' >";
				echo "<br><label>Antwort_B</label> <input  name='Antwort_B' type='text' >";
				echo "<br><label>Antwort_C</label> <input  name='Antwort_C' type='text' >";
				echo "<br><label>Antwort_D</label> <input  name='Antwort_D' type='text' >";
				echo "<br><label>Loesung (Eingabe 1,2,3, oder4)</label> <input  name='Loesung' type='text' >";
				echo "<br><label>hidden</label> <input  name='Hidden' type='hidden' value='".$tabelle."' >";
				echo "<br><input  type='submit' value='Speichern'>";
				
				echo "</form>";
				break;
				
				
				case "question_text" :
				
				//echo "QMID 	AusstellerID 	Fragetext 	Antwort_A 	Antwort_B 	Antwort_C 	Antwort_D 	Loesung";
				while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
					echo $zeile['TextfrageID'] . "<br> ". $zeile['Frage']. "<br> ".$zeile['Antworten']. "<br><hr> ";
					 
				}
				echo "Bitte neue Fragen eingeben:";
				echo "<form name='form1' action='adminTabelleSpeichern.php' method='get'>";
				echo "<br><label>Aussteller (ID)</label> <select  name='AusstellerID' >";
					while ($zeile2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
						
						echo "<option value='".$zeile2['AusstellerID']. "'>".$zeile2['Name']."</option> ";
					 
					}
				echo "</select><br><hr>";
				echo "<br><label>Frage</label> <input  name='Frage' type='text' >";
				echo "<br><label>Antwort (Begriffe)</label> <input  name='Antworten' type='text' >";
				
				echo "<br><label>hidden</label> <input  name='Hidden' type='hidden' value='".$tabelle."' >";
				echo "<br><input  type='submit' value='Speichern'>";
				
				echo "</form>";
				break;
				
				case "question_schaetzspiel" :
				
				//echo "QMID 	AusstellerID 	Fragetext 	Antwort_A 	Antwort_B 	Antwort_C 	Antwort_D 	Loesung";
				while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
					echo $zeile['QSID'] . "<br> ". $zeile['Frage']. "<br> ".$zeile['Antwort']. "<br><hr> ";
					 
				}
				echo "<form name='form1' action='adminTabelleSpeichern.php' method='get'>";
				echo "Bitte neue Fragen eingeben:";
				echo "<br><label>Aussteller (ID)</label> <select  name='AusstellerID' >";
					while ($zeile2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
						
						echo "<option value='".$zeile2['AusstellerID']. "'>".$zeile2['Name']."</option> ";
					 
					}
				echo "</select><br><hr>";
				echo "<br><label>Frage</label> <input  name='Frage' type='text' >";
				echo "<br><label>Antwort (Int Wert)</label> <input  name='Antwort' type='text' >";
				
				echo "<br><label>hidden</label> <input  name='Hidden' type='hidden' value='".$tabelle."' >";
				echo "<br><input  type='submit' value='Speichern'>";
				
				echo "</form>";
				break;
				
			case "question_zuordnung" :
				
				//echo "QMID 	AusstellerID 	Fragetext 	Antwort_A 	Antwort_B 	Antwort_C 	Antwort_D 	Loesung";
				while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
					echo $zeile['QZUID'] . "<br> ". $zeile['FrageWasgehoertZusammen']. "<br> "
					.$zeile['AussageA']. " mit ".$zeile['LoesungA']. " <br>"
					.$zeile['AussageB']. " mit ".$zeile['LoesungB']. " <br>"
					.$zeile['AussageC']. " mit ".$zeile['LoesungC'].  " <br>"
					.$zeile['AussageD']. " mit ".$zeile['LoesungD'].  "<br><hr> ";
					 
				}
				echo "Bitte neue Fragen eingeben:";
				echo "<form name='form1' action='adminTabelleSpeichern.php' method='get'>";
				echo "<br><label>Aussteller (ID)</label> <select  name='AusstellerID' >";
					while ($zeile2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
						
						echo "<option value='".$zeile2['AusstellerID']. "'>".$zeile2['Name']."</option> ";
					 
					}
				echo "</select><br><hr>";
				echo "<br><label>Fragetext</label> <input  name='FrageWasgehoertZusammen' type='text' >";
				echo "<br><label>Aussage_A</label> <input  name='AussageA' type='text' >";
				echo "<br><label>Loesung_A</label> <input  name='LoesungA' type='text' >";
				echo "<br><label>Aussage_B</label> <input  name='AussageB' type='text' >";
				echo "<br><label>Loesung_B</label> <input  name='LoesungB' type='text' >";
				echo "<br><label>Aussage_C</label> <input  name='AussageC' type='text' >";
				echo "<br><label>Loesung_C</label> <input  name='LoesungC' type='text' >";
				echo "<br><label>Aussage_D</label> <input  name='AussageD' type='text' >";
				echo "<br><label>Loesung_D</label> <input  name='LoesungD' type='text' >";
				echo "<br><label>hidden</label> <input  name='Hidden' type='hidden' value='".$tabelle."' >";
				echo "<br><input  type='submit' value='Speichern'>";
				
				echo "</form>";
				break;
				
		}
		

		
	}  //ende else

	echo "</div>";
	mysqli_close($con);
	?>



</body>

</html>