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
	#mystyle {
		position:relative;
		border: 1px solid green;
		
		left: 10px;
		padding:10px;
		font-size: 1.2em;
		font-family: Calibri;
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
	
	<div id="mystyle">
	
	<?php 
	echo "<form name='form1' action='anmeldung.html' method='get'>";
	echo "<input class='btn btn-success' type='submit' value='Anmelden zu neuem Spiel'>";
	
	echo "</form>";
	
     ?>
	 <?php 
	echo "<form name='form2' action='admin.php' method='get'>";
	
	echo "<br><input  class='btn btn-success' type='submit' name='Frageneditieren' value='Fragen editieren (Admin)'>";
	echo "</form>";
	
     ?>
	</div>
</div>

</body>

</html>