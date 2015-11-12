<?php

include "states.php";
include "myDBConnection.php";

$message = "";
$canQuery = true;

if(isset($_REQUEST['Register'])){
	
	$date = date('Y-m-d H:i:s');

	$state = $_REQUEST['state'];

	if($_REQUEST['fname'] != ""){
		$fname = $_REQUEST['fname'];
	} else {
		$message = "MISSING REQUIRED FIELD";
		$canQuery = false;
	}
	
	if($_REQUEST['lname'] != ""){
		$lname = $_REQUEST['lname']; 
	} else {
		$message = "MISSING REQUIRED FIELD";
		$canQuery = false;
	}
	
	if($_REQUEST['add1'] != ""){
		$add1 = $_REQUEST['add1'];
	} else {
		$message = "MISSING REQUIRED FIELD";
		$canQuery = false;
	}
	
	if($_REQUEST['city'] != ""){
		$city = $_REQUEST['city'];
	} else {
		$message = "MISSING REQUIRED FIELD";
		$canQuery = false;
	}

	if($_REQUEST['zip'] != ""){
		$zip = $_REQUEST['zip'];
		$zip_pattern = "/(^\d{5}(?:[-\s]\d{4})?$)/";
		if(!preg_match($zip_pattern, $zip)){
			$message = "INPROPER ZIPCODE";
			$canQuery = false;
		}

	} else {
		$message = "MISSING REQUIRED FIELD";
		$canQuery = false;
	}

	if($_REQUEST['country'] != ""){
		$country = $_REQUEST['country'];
	} else {
		$message = "MISSING REQUIRED FIELD";
		$canQuery = false;
	}

	if($_REQUEST['add2'] != ""){
		$add2 = $_REQUEST['add2'];
		$add2IsSet = true;
	} else {
		$add2IsSet = false;
	}
	if($canQuery){
		if($add2IsSet){
			$sql = "INSERT INTO user (fname, lname, add1, add2, city, state, zip, country, date) VALUES (:fname, :lname, :add1, :add2, :city, :state, :zip, :country, :date)";
			$query = $pdo->prepare($sql);
			$query->bindValue(':add2', $add2);
		} else {
			$sql = "INSERT INTO user (fname, lname, add1, city, state, zip, country, date) VALUES (:fname, :lname, :add1, :city, :state, :zip, :country, :date)";
			$query = $pdo->prepare($sql);
		}

		$query->bindValue(':fname', $fname);
		$query->bindValue(':lname', $lname);
		$query->bindValue(':add1', $add1);
		$query->bindValue(':city', $city);
		$query->bindValue(':state', $state);
		$query->bindValue(':zip', $zip);
		$query->bindValue(':country', $country);
		$query->bindValue(':date', $date);
		
		try{
			$query->execute();
			$message = "$fname $lname has successfully registered.";
		} catch(PDOException $e){
			$message = "There was an error in your registration, please try again later.";
		}
	}		

}

?>
<link href="css/main.css" rel="stylesheet" type="text/css">
<link href="css/validate.css" rel="stylesheet" type="text/css">

<h1>Registration Form</h1>

<?php
	echo $message;
?>

<form id="register" action="index.php" method="POST">
	<fieldset>
		<label>First Name: </label>
		<input type="text" name="fname" id="fname" value="" class="txtInput"/>
		<br/ class="clear">
		<label>Last Name: </label>
		<input type="text" name="lname" id="lname" value="" class="txtInput"/>
		<br/ class="clear">
		<label>Address1: </label>
		<input type="text" name="add1" id="add1" value="" class="txtInput"/>
		<br/ class="clear">
		<label>Address2: </label>
		<input type="text" name="add2" id="add2" value="" class="txtInput"/>
		<br/ class="clear">
		<label>City: </label>
		<input type="text" name="city" id="city" value="" class="txtInput"/>
		<br/ class="clear">
		<label>State: </label>
		<select name="state" class="txtInput">
			<?php
				foreach($state_abbrevs as $value){
					echo "<option value='$value'>$value</option>";
				}
			
			?>
		</select>
		<br/ class="clear">
		<label>Zip: </label>
		<input type="text" name="zip" id="zip" value="" class="txtInput"/>
		<br/ class="clear">
		<label>Country: </label>
		<select name="country" class="txtInput">
			<option value="USA">USA</option>
		</select>
		<br/ class="clear">
		<input type="submit" name="Register" value="Register"/>
	</fieldset>	
</form>

<a href="report.php">View Registration Report</a>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/formVal.js"></script>