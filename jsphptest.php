<?php
// if(isset$_POST['Name']) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$Name = $_POST['First_Name'];
	$Street = $_POST['Street'];
	$City = $_POST['City'];
    $Phone = $_POST['Phone'];
	echo $Name;
	header('Location: PopulateFields.php');
} else {
	echo "At least this kinda of works";
}
?>