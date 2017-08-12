<?php

	session_start();
	print_r($_SESSION);
	

	
	

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
	// im folgenden werden die Fragen in ein Array zusammengefügt und der Session mitgegeben
	//jederzeit kann dann dieser Session  eingetragen werden wieviele Fragen bereits beantwortet worden sind.

	// alle oder brache extrahieren noch durchzuführen

	$_SESSION["FragenAus"]="Alle";
	
	include("db_connectLokal.php");
// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	else {
		$fragen = array(array(0,"Start",0,0));  // erste Frage = 0 "start", 0 für nicht gestellt, 0 kein Aussteller
		$sql="SELECT `QMID`,`AusstellerID` FROM `question_multiple` WHERE 1";
		$result=mysqli_query($con,$sql);

		$rowcount=mysqli_num_rows($result);
		
		//echo "Diese Tabelle hat " . $rowcount . " Fragen";
		while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			// Frage für Frage wird zum Array dazugefügt
			echo $zeile["AusstellerID"];
			$fragen[] = array($zeile["QMID"],"question_multiple",0,$zeile["AusstellerID"]);
		}
		
	 $sql="SELECT `QSID`,`AusstellerID` FROM `question_schaetzspiel`";
		$result=mysqli_query($con,$sql);
	
		$rowcount=mysqli_num_rows($result);
	
		//echo "Diese Tabelle hat " . $rowcount . " Fragen";
		while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$fragen[] = array($zeile["QSID"],"question_schaetzspiel",0,$zeile["AusstellerID"]);
		} 
		
		
		$sql="SELECT `TextfrageID`,`AusstellerID` FROM `question_text` WHERE 1";
		$result=mysqli_query($con,$sql);

		$rowcount=mysqli_num_rows($result);
		
		//echo "Diese Tabelle hat " . $rowcount . " Fragen";
		while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$fragen[] = array($zeile["TextfrageID"],"question_text",0,$zeile["AusstellerID"]);
		}
		
		$sql="SELECT `QZUID`,`AusstellerID` FROM `question_zuordnung` WHERE 1";
		$result=mysqli_query($con,$sql);

		$rowcount=mysqli_num_rows($result);
		
		//echo "Diese Tabelle hat " . $rowcount . " Fragen";
		while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$fragen[] = array($zeile["QZUID"],"question_zuordnung",0,$zeile["AusstellerID"]);
		}
		
		
		
		
		//print_r($fragen);
		
		// der Session das Fragearray mitgeben
		
		$_SESSION["Fragenliste"]=$fragen;
		
		//print_r ($_SESSION["Fragenliste"]);
		 
		
		
	}  //ende else


	
	?>
	<div id='mystyle'>
	<p>Hallo <?php echo $_SESSION["nickname"]; ?>, Du hast Fragen aller Aussteller gewählt</p><br>
	<p>Du bekommst pro richtiger Frage 10 Punkte</p>
	<p> Los gehts mit der ersten Frage wenn du auf den Button klickst</p><br>
	<p>Möchtest du eine Frage eines bestimmten Ausstellers?  Dann gib vorher diesen Aussteller im Auswahlmenü ein</p>	
		<?php 

	echo "<form name='form1' action='einzelfrage.php' method='get'>";
		$sql2="SELECT * FROM `aussteller` WHERE 1";
		$result2=mysqli_query($con,$sql2);
		echo "<div class='form-group'>";
			echo "<label for='sel1'>Aussteller (ID)</label> <select  class='form-control' id='sel1' name='AusstellerID' >";
						// bei Zufallsfrage wird 0 übertragen sonst die AusstellerID
						echo "<option value='0'>Zufallsfrage</option> ";
						while ($zeile2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
							
							echo "<option value='".$zeile2['AusstellerID']. "'>".$zeile2['Name']."</option> ";
						 
						}
					echo "</select>";
		echo "</div>";  // ende class form-group
		echo "<input  class='btn btn-success' type='submit' value='Los gehts'>";
	echo "</form>";
	mysqli_close($con);
		 ?>
	</div>
</div> <!-- Ende Container --> 
</body>

</html>