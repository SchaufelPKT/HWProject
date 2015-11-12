<?php

include "myDBConnection.php";

$sql = "SELECT * FROM user ORDER BY date DESC";
$query = $pdo->query($sql);


?>

<h1>Registration Report</h1>

<table border="1">
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Address 1</th>
		<th>Address 2</th>
		<th>City</th>
		<th>State</th>
		<th>Zip</th>
		<th>Country</th>
		<th>Date</th>
	</tr>
	<?php
		foreach($query as $q){
			echo "<tr>";
			echo "<td>".$q['fname']."</td>";
			echo "<td>".$q['lname']."</td>";
			echo "<td>".$q['add1']."</td>";
			echo "<td>".$q['add2']."</td>";
			echo "<td>".$q['city']."</td>";
			echo "<td>".$q['state']."</td>";
			echo "<td>".$q['zip']."</td>";
			echo "<td>".$q['country']."</td>";
			echo "<td>".$q['date']."</td>";
			echo "</tr>";
		}
	?>
	</tr>


</table>
<br/>
<a href="index.php">Return To Registration Form</a>
