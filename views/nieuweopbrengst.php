<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title>Autokosten</title>
	<link rel="stylesheet" type="text/css" href="autokosten.css">
</head>

<body>
<div class="invoer">
	<h1>Nieuwe opbrengst</h1>
</div>

<form id="onderhoud" action="parse/parse-opbrengst.php" method="post">
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
			<td>Vergoeder</td>
			<td><input type="text" name="vergoeder" /></td>
		</tr>
		<tr>
			<td>Gereden kilometers</td>
			<td><input type="text" name="gereden_kms" /></td>
		</tr>
		<tr>
			<td>Opbrengst</td>
			<td><input type="text" name="opbrengst" /></td>
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