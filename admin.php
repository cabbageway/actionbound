<!DOCTYPE html>
<html>
<head>
<title>Anmeldung</title>
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">



<script>
	//alert("aus JS");
	
</script>
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
echo "<div>";
	echo "<br>Welcome zu den Admin Tätigkeiten <br />";
	
	
	echo "<p>Waehle bitte aus welche Fragen du erweitern möchtest. <br />
	</p> ";
	echo "<form name='form1' action='fragenEditieren.php' method='get'>";
		echo "<br><input  type='radio'  checked='true' name='tabelle' value='question_multiple'> Multiple Choice</input>";
		echo "<br><input  type='radio'  name='tabelle' value='question_schaetzspiel'> Schätzspiel</input>";
		echo "<br><input  type='radio'  name='tabelle' value='question_text'> Textfragen</input>";
		echo "<br><input  type='radio'  name='tabelle' value='question_zuordnung'> Zuordnung</input>";

		echo "<br><input  type='submit' value='Los gehts'>";
	echo "</form>";
echo "</div>";
?>
</body>

</html>