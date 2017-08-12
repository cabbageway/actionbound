<?php

	session_start();
	
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
	
	// die Fragegestellt wird auf 1 gesetzt.

	$_SESSION["Fragenliste"][$_SESSION["aktuellerZufallswert"]][2]= 1;
	echo $_SESSION["aktuellerZufallswert"];
	 //print_r($_SESSION);
	
	include("db_connectLokal.php");
// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	else {
	    echo "<div id='mystyle'>";
		echo $_SESSION["Fragenliste"][$_SESSION["aktuellerZufallswert"]][1]."<br>";
		switch ($_SESSION["Fragenliste"][$_SESSION["aktuellerZufallswert"]][1]) {
		
			case "question_zuordnung": 
								$sql="SELECT * FROM `question_zuordnung` WHERE `QZUID` = ". $_SESSION["Fragenliste"][$_SESSION["aktuellerZufallswert"]][0]; 
								
								echo $sql."<br>";
								$result=mysqli_query($con,$sql);
								while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
									 echo "<br><p>". $zeile["LoesungA"]. "</p>";
									 
									 // hier muss der Wert der Lösung vom Formular einzelfrage.php
									 // verglichen werden mit diesem Lösungswert
								
								}
								break;
								
			case "question_multiple": 
								$sql="SELECT * FROM `question_multiple` WHERE `QMID` = ".  $_SESSION["Fragenliste"][$_SESSION["aktuellerZufallswert"]][0]; 
								echo $sql."<br>";
								$result=mysqli_query($con,$sql);
								while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
									 echo "<br><p>".$zeile["Loesung"]. "</p>";
									  // hier muss der Wert der Lösung vom Formular einzelfrage.php
									 // verglichen werden mit diesem Lösungswert
								}
							
								break;
								
			case "question_text": 
								$sql="SELECT * FROM `question_text` WHERE `TextfrageID` = ".  $_SESSION["Fragenliste"][$_SESSION["aktuellerZufallswert"]][0]; 
								echo $sql."<br>"; 
								$result=mysqli_query($con,$sql);
								while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
									 echo "<br><p>".$zeile["Antworten"].  "</p>";
									  // hier muss der Wert der Lösung vom Formular einzelfrage.php
									 // verglichen werden mit diesem Lösungswert
								}
							
								break;
								
			case "question_schaetzspiel": 
								$sql="SELECT * FROM `question_schaetzspiel` WHERE `QSID` = ".  $_SESSION["Fragenliste"][$_SESSION["aktuellerZufallswert"]][0]; 
								echo $sql."<br>"; 
								$result=mysqli_query($con,$sql);
								while ($zeile = mysqli_fetch_array($result,MYSQLI_ASSOC)){
									 echo "<br><p>".$zeile["Antwort"].  "</p>";
									  // hier muss der Wert der Lösung vom Formular einzelfrage.php
									 // verglichen werden mit diesem Lösungswert
								}
							
								break;
								
								
			
		} //ende switch
		
		
		echo "<p> Die Lösung war richtig und du erhältst 10 Punkte</p>";
		$_SESSION["AnzahlErreichtePunkte"] +=10;
		echo $_SESSION["nickname"].", du hast inzwischen ". $_SESSION['AnzahlErreichtePunkte']. "Punkte gesammelt"; 
	
	}  //ende else


	
	?>
	


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
		echo "<input class='btn btn-success' type='submit' value='nächste Frage'><br>";
	
		echo "<br><input  class='btn btn-success' type='submit' name='SessionEnde' value='Session beenden'>";
	echo "</form>";
	echo "</div>"; //div Frage
	mysqli_close($con);
     ?>
</div> <!-- Ende Container -->
</body>

</html>