	<div id="forms">
		<form id="vaste-kosten" action="../parse/parse-kosten.php" method="post">
			<table>
				<tr>
					<td>Auto</td>
					<td>
						<select name="auto_id"><?php include 'views/select-auto-kn.php'; ?></select>
					</td>
				</tr>
				<tr>
					<td>Afschrijving jaar 1</td>
					<td><input type="number" name="afschr1"></td>
				</tr>
				<tr>
					<td>Afschrijving jaar 2</td>
					<td><input type="number" name="afschr2"></td>
				</tr>
				<tr>
					<td>Afschrijving jaar 3</td>
					<td><input type="number" name="afschr3"></td>
				</tr>
				<tr>
					<td>Belasting</td>
					<td><input type="number" name="bel"></td>
				</tr>
				<tr>
					<td>Verzekering</td>
					<td><input type="number" name="verz"></td>
				</tr>
				<tr>
					<td>Gem # kilometers per jaar</td>
					<td><input type="number" name="kmjaar"></td>
				</tr>
				<tr>
					<td><button name="invoeren" type="submit" autofocus>Invoeren</button></td>
					<td><button name="opnieuw" type="reset">Opnieuw</button></td>		
				</tr>
			</table>
		</form>
	</div>