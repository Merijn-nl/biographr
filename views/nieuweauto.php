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
	
		<button id="autotoevoegen" type="submit" onclick="showDiv('nieuweauto')">Voeg een auto toe</button>
		<button id="autotoevoegen" type="submit" onclick="showDiv('autosluit')">Sluit een auto af</button>
	</div>
	
	<div id="nieuweauto">	
		<form id="nieuweauto" action="parse/parse-auto.php" method="post">
			<table>
				<tr>
					<td>Merk</td>
					<td><input type="text" name="brand"></td>
				</tr>
				<tr>
					<td>Type</td>
					<td><input type="text" name="type"></td>
				</tr>
				<tr>
					<td>Bouwjaar</td>
					<td><input type="text" name="make"></td>
				</tr>
				<tr>
					<td>Kleur</td>
					<td><input type="text" name="colour"></td>
				</tr>
				<tr>
					<td>Aanschafdatum</td>
					<td><input type="date" name="buy_date"></td>
				</tr>
				<tr>
					<td>Km stand bij aanschaf</td>
					<td><input type="text" name="buy_miles"></td>
				</tr>
				<tr>
					<td>Aanschafprijs</td>
					<td><input type="text" name="buy_price"></td>
				</tr>
				<tr>
					<td>Brandstof</td>
					<td>
						<select name="fuel">
							<option>Benzine</option>
							<option>Diesel</option>
							<option>LPG</option>
							<option>Hybride</option>
							<option>Waterstof</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><button name="invoeren" type="submit" autofocus>Invoeren</button></td>
					<td><button name="opnieuw" type="reset">Opnieuw</button></td>		
				</tr>
			</table>
		</form>
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
					<td><input type="date" name="sell_date"></td>
				</tr>
				<tr>
					<td>Verkoopprijs</td>
					<td><input type="text" name="sell_price"></td>
				</tr>
				<tr>
					<td>Kilometerstand bij verkoop</td>
					<td><input type="text" name="sell_miles"></td>
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