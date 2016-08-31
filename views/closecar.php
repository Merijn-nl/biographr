<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>Auto's beheren</title>
	<link rel="stylesheet" type="text/css" href="autokosten.css">
	<script src="auto.js"></script>
</head>
<body>

	<div class="invoer">
		<h1>Auto's beheren</h1>
	</div>
	
	<div id="autobeheren">
	
		<?php include 'showcars.php';?>		
	
		<button id="autotoevoegen" type="submit" onclick="showDiv('autosluit')">Sluit een auto af</button>
	</div>
	
	<div id="autosluit">
		<form id="autosluit" action="parse/parse-closecar.php" method="post">
			<table>
				<tr>
					<td>Auto</td>
					<td>
						<select name="auto"></select>
					</td>
				</tr>
				<tr>
					<td>Verkoopdatum</td>
					<td><input type="date" name="verkoopdatum"></td>
				</tr>
				<tr>
					<td>Verkoopprijs</td>
					<td><input type="text" name="verkoopprijs"></td>
				</tr>
				<tr>
					<td>Kilometerstand bij verkoop</td>
					<td><input type="text" name="kmstand_verkoop"></td>
				</tr>
				<tr>
					<td><button name="invoeren" type="submit" autofocus>Auto afsluiten</button></td>
					<td><button name="opnieuw" type="reset">Toch maar niet</button></td>		
				</tr>
			</table>
		</form>
	</div>	
	
</body>
</html>