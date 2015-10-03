<html>
<body>

<form method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
First_Name:<br>
<input type="text" name="First_Name">
<br>
Last_Name:<br>
<input type="text" name="Last_Name">
<br>
Street:<br>
<input type ="text" name="Street">
<br>
City:<br>
<input type ="text" name="City">
<br>
Province:<br>
<input type ="text" name="Province">
<br>
Country:<br>
<input type ="text" name="Country">
<br>
Postal_Code:<br>
<input type ="text" name="Postal_Code">
<br>
Phone:<br>
<input type ="text" name="Phone">
<br>
E-mail:<br>
<input type ="text" name="E_Mail">
<br>
Day:<br>
<input type ="text" name="Day">
<br>
Month:<br>
<input type ="text" name="Month">
<br>
Year:<br>
<input type ="text" name="Year">
<br>
<br>
Custom Fields:<br>
<input type ="text" name="CustomField1">:<br>
<input type ="text" name="Street">
<br><br>
<input type ="text" name="CustomField1">:<br>
<input type ="text" name="Street">
<br><br>
Input Template:<br>
<input type ="file" name="input_template">
<br>
PDF:<br>
<input type ="file" name="PDF">
<br><br>
<input type="submit" value="Submit">
</form>

<?php
require_once('merge.php');
// if(isset$_POST['Name']) {

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$pathtoinput = array (
		$First_Name => $_POST['First_Name'],
		$Last_Name => $_POST['Last_Name'],
		$Street => $_POST['Street'],
		$City => $_POST['City'],
	    $Phone => $_POST['Phone'],
	    );
	pageToPDF($pathToFile, $pathToTemplate, $pathToInput);
}
?>

</body>
</html>