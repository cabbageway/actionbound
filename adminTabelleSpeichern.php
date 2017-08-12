

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
		font-size: 1.5em;
	}


</style>
  </head>
<body>
	
	
	<?php
	// im folgenden werden die Fragen der auswählten Tabelle gelistet und sie können dann ergänzt
	//werden.
	//Löschen und Bearbeiten vorhanderer ist noch optional
	echo print_r($_GET);
	$tabelle = $_GET["Hidden"];
	echo $tabelle;
	
	include("db_connectLokal.php");
// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	else {
		
		$sql="SELECT * FROM `".$tabelle."` WHERE 1";
				
				$result=mysqli_query($con,$sql);

				$rowcount=mysqli_num_rows($result);
				
				echo "<br>Diese Tabelle hat " . $rowcount . " Fragen";
		
		switch($tabelle) {
			case "question_multiple" :
				
				$sql="INSERT INTO `question_multiple` (`AusstellerID`, `Fragetext`,`Antwort_A`, `Antwort_B`, `Antwort_C`, `Antwort_D`,`Loesung`) 
				VALUES (".$_GET['AusstellerID'].",'".$_GET['Fragetext']."','".$_GET['Antwort_A']
				."','".$_GET['Antwort_B']."','".$_GET['Antwort_C']."','".$_GET['Antwort_D']."',".$_GET['Loesung'].")";
				echo $sql;
				$result=mysqli_query($con,$sql);
				//include ("fragenEditieren.php?tabelle=question_multiple"); 
				include ("admin.php");
				break;
				
			case "question_text" :
				
				$sql="INSERT INTO `question_text` (`AusstellerID`, `Frage`,`Antworten`) 
		VALUES (".$_GET['AusstellerID'].",'".$_GET['Frage']."','".$_GET['Antworten']."')";
				echo $sql;
				$result=mysqli_query($con,$sql);
				//include ("fragenEditieren.php?tabelle=question_multiple"); 
				include ("admin.php");
				break;
				
		    case "question_schaetzspiel" :
				
				$sql="INSERT INTO `question_schaetzspiel` (`AusstellerID`, `Frage`,`Antwort`) 
		VALUES (".$_GET['AusstellerID'].",'".$_GET['Frage']."',".$_GET['Antwort'].")";
				echo $sql;
				$result=mysqli_query($con,$sql);
				//include ("fragenEditieren.php?tabelle=question_multiple"); 
				include ("admin.php");
				break;
				
			case "question_zuordnung" :
				
				$sql="INSERT INTO `question_zuordnung` (`AusstellerID`, `FrageWasgehoertZusammen`,`AussageA`, `LoesungA`, `AussageB`, `LoesungB`,`AussageC`, `LoesungC`, `AussageD`, `LoesungD`)
				VALUES (".$_GET['AusstellerID'].",'".$_GET['FrageWasgehoertZusammen']."','"
				.$_GET['AussageA']."','".$_GET['LoesungA']."','".$_GET['AussageB']."','".$_GET['LoesungB']."','".$_GET['AussageC']."','".$_GET['LoesungC']."','".$_GET['AussageD']."','".$_GET['LoesungD']."')";
				echo $sql;
				$result=mysqli_query($con,$sql);
				//include ("fragenEditieren.php?tabelle=question_multiple"); 
				include ("admin.php");
				break;
				
		}
		
	/*	 
		
		$sql="SELECT `QZUID` FROM `question_zuordnung` WHERE 1";
		$result=mysqli_query($con,$sql);

		$rowcount=mysqli_num_rows($result);
		
		echo "Diese Tabelle hat " . $rowcount . " Fragen";
		while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$fragen[] = array($zeile["QZUID"],"question_zuordnung",0);
		}
		*/
		
		
		
	}  //ende else


	mysqli_close($con);
	?>
<div>
Hier kommen die Fragen</p>

</div>
</body>

</html>