<canvas id="myChartLeft"></canvas>
<canvas id="myChartRight"></canvas>

	<div class="invoer">
		<h1>Uw auto-biografie</h1>

		<?php include 'views/showcars.php';?>		
	</div>
	<div id="buttons">
			<input type="button" value="Nieuwe onderhoudsbeurt" onclick="showDiv('nieuweonderhoud');" />
			<input type="button" value="Nieuwe tankbeurt" onclick="showDiv('nieuwetank');" autofocus="true" />
			<input type="button" value="Overige kosten invoeren" onclick="showDiv('nieuweoverig');" />
			<br /><br />
			<input type="button" value="Auto toevoegen" onclick="showDiv('nieuweauto');" />
			<input type="button" value="Nieuwe opbrengst" onclick="showDiv('nieuweopbrengst');" />
	</div>
	<div id="forms">
		<div id="nieuweauto">	
			<form id="auto" action="parse/parse-auto.php" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
						<td><input type="text" name="buy_kms"></td>
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
			<form id="sluit" action="parse/parse-closecar.php" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
						<td><input type="text" name="sell_kms"></td>
					</tr>
					<tr>
						<td><button name="invoeren" type="submit" autofocus>Auto afsluiten</button></td>
						<td><button name="opnieuw" type="reset">Toch maar niet</button></td>		
					</tr>
				</table>
			</form>
		</div>		

		<div id="nieuweonderhoud">
			<form id="onderhoud" action="parse/parse-onderhoud.php" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
		</div>

		<div id="nieuweoverig">
			<form id="overig" action="parse/parse-overig.php" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
						<td>Bedrijf</td>
						<td><input type="text" name="bedrijf" /></td>
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
		</div>

		<div id="nieuweopbrengst">
			<form id="opbrengst" action="parse/parse-opbrengst.php" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
		</div>

		<div id="nieuwetank">
			<form id="verbruik" action="parse/parse-verbruik.php" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
						<td>Aantal liters</td>
						<td><input type="text" name="liters" /></td>
					</tr>
					<tr>
						<td>Bedrag</td>
						<td><input type="text" name="kosten" /></td>
					</tr>
					<tr>
						<td><button name="invoeren" type="submit" autofocus>Invoeren</button></td>
						<td><button name="opnieuw" type="reset">Opnieuw</button></td>		
					</tr>
				</table>
			</form>
		</div>
		
		<div id="nieuwevastekosten">
			<form id="kosten" action="parse/parse-kosten.php" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<table>
					<tr>
						<td>Auto</td>
						<td>
							<select name="auto_id"><?php include 'select-auto-kn.php'; ?></select>
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
	</div>	