<?php
include 'connect.php';

// get cars and write each to table
$cars = mysqli_query( $con , "
		SELECT 
			auto.brand, 
			auto.type, 
			auto.make, 
			verbruik.gemkosten, 
			verbruik.gemverbruik, 
			kosten.gem_vast, 
			kosten.gem_onderhoud, 
			kosten.gem_brandstof, 
			verbruik.gemverbruik3, 
			verbruik.gemverbruik5000, 
			kosten.gem_opbrengst, 
			kosten.gem_overig
		FROM auto
			JOIN verbruik 
				ON auto.id = verbruik.auto_id
			JOIN kosten
				ON verbruik.auto_id = kosten.auto_id
				WHERE verbruik.kmstand = (SELECT MAX(kmstand) FROM verbruik WHERE verbruik.auto_id = auto.id)
				AND auto.user_id = $user_id") 
		or die(mysqli_error()); 

echo"<div class='showcars'>
	<table>
	<tbody>
	<thead>
		<th>Auto</th>
		<th>Kosten / KM</th>
		<th>Opbrengst / KM</th>
		<th>Gem verbruik</th>
	</thead>";

// Count the number of rows inside the query (how many active cars does this owner have?)
$countRows = mysqli_num_rows($cars);

$i = 0;
while( $row = mysqli_fetch_array ( $cars ) ) {

	$vasteKosten[$i] = $row[5];
	$brandstofKosten[$i] = $row[3];
	$onderhoudsKosten[$i] = $row[6];
	$overigeKosten[$i] = $row[11];
	$totaleKosten = $vasteKosten[$i] + $brandstofKosten[$i] + $onderhoudsKosten[$i] + $overigeKosten[$i];
	
	$gemVerbruik[$i] = $row[4];
	$gemVerbruik3[$i] = $row[8];
	$gemVerbruik5000[$i] = $row[9];

	$brandstofKostenVerify[$i] = $row[7];

	if ($brandstofKosten[$i] != $brandstofKostenVerify[$i]) {
		echo"There is a database discrepancy";
	}
	else {
		echo"<tr>
			<td><a href='#' onmouseover=''>" . $row[0] . " " . $row[1] . " uit " . $row[2] . "</a></td>
			<td class='totCost'><a href=''>€ " . $totaleKosten . "</a></td>
			<td><a href='#'>€ " . $row[10] . "</a></td>
			<td class='totVerbruik'><a href=''>1 op " . $row[4] . "</a></td>
			</tr>";
		$i++;
	}
}
		
echo"</tbody>
	</table>
	</div>";

//close connection
mysqli_close($con);

?>
<script type="text/javascript">
	(function(){
		var rowCount = <?php echo $countRows; ?>;
		// When there is only one car to display, we can instantiate the graphs here
		if ( rowCount == 1) {
			showCost(0);
			showVerbruik(0);
		}
		// If the user has multiple active cars, bind the graphing action to the relevant data
		else {
			var ii = 0;
			while (ii < rowCount) {
				document.getElementsByClassName("totCost")[ii].getElementsByTagName('a')[0].href = "javascript:showCost(" + ii + ");";
				document.getElementsByClassName("totVerbruik")[ii].getElementsByTagName('a')[0].href = "javascript:showVerbruik(" + ii + ");";
				ii++;
			}
		}
	})();

function showCost(carId) {
	var ctx = document.getElementById("myChartLeft").getContext("2d"),
		vasteKosten = <?php echo json_encode($vasteKosten); ?>,
		verbruiksKosten = <?php echo json_encode($brandstofKosten); ?>,
		onderhoudsKosten = <?php echo json_encode($onderhoudsKosten); ?>,
		overigeKosten = <?php echo json_encode($overigeKosten); ?>,
	
		
		data = [
		{
			value: vasteKosten[carId] * 1,
	        color:"#FF5A5E",
	        highlight: "#F7464A",
	        label: "Vaste kosten"
	    },
	    {
	        value: verbruiksKosten[carId] * 1,
	        color: "#5AD3D1",
	        highlight: "#46BFBD",
	        label: "Brandstofkosten"
	    },
	    {
	        value: onderhoudsKosten[carId] * 1,
	        color: "#FFC870",
	        highlight: "#FDB45C",
	        label: "Onderhoudskosten"
	    },
	    {
	        value: overigeKosten[carId] * 1,
	        color: "#cccccc",
	        highlight: "#888888",
	        label: "Overige kosten"
	    }
		],
		myChart = new Chart(ctx).Doughnut(data);
}

function showVerbruik(carId) {
	var ctx2 = document.getElementById("myChartRight").getContext("2d"),
		gemVerbruik = <?php echo json_encode($gemVerbruik); ?>,
		gemVerbruik3 = <?php echo json_encode($gemVerbruik3); ?>,
		gemVerbruik5000 = <?php echo json_encode($gemVerbruik5000); ?>,
		

		data = {
			labels: ["Totaal" , "5000km" , "Laatste 3"],
			    datasets: [
			        {
			            label: "Gemiddeld verbruik",
			            fillColor: "rgba(120,225,120,0.5)",
			            strokeColor: "rgba(220,220,220,0.8)",
			            highlightFill: "rgba(170,255,170,0.75)",
			            highlightStroke: "rgba(220,220,220,1)",
			            data: [gemVerbruik[carId] * 1, gemVerbruik5000[carId] * 1, gemVerbruik3[carId] * 1]
			        }]
    			},
		myChart = new Chart(ctx2).Bar(data, {scaleShowGridLines : false});	
}

</script>
<?php
?>