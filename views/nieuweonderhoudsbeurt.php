<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>Autokosten</title>
	<link rel="stylesheet" type="text/css" href="autokosten.css">
	<script src="Chart.js"></script>
	<script src="auto.js"></script>
</head>

<body>
<div class="invoer">
	<h1>Nieuwe onderhoudsbeurt invoeren</h1>
</div>	

<form id="onderhoud" action="parse/parse-onderhoud.php" method="post">
	<table>
		<tr>
			<td>Auto</td> 
				<td>
					<select name="auto_id"><?php include 'select-auto.php'; ?></select>
				</td>
		</tr>
		<tr>
			<td>Datum</td>
			<td><input type="date" name="datum" /></td>
		</tr>
		<tr>
			<td>Kilometerstand</td>
			<td><input type="text" name="kmstand" /></td>
		</tr>
		<tr>
			<td>Kosten</td>
			<td><input type="text" name="kosten" /></td>
		</tr>
		<tr>
			<td>Garage</td>
			<td><input type="text" name="garage" /></td>
		</tr>
		<tr>
			<td>Bijzonderheden</td>
			<td><input type="text" name="bijz" /></td>
		</tr>
		<tr>
			<td><button name="invoeren" type="submit" autofocus>Invoeren</button></td>
			<td><button name="opnieuw" type="reset">Opnieuw</button></td>		
		</tr>
	</table>
</form>
</body>
</html>