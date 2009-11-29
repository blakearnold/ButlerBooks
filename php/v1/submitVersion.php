<?
	require("api.php");
	
	$book_version_id = add_version($_GET['book_id'], $_GET['version'], $_GET['isbn_10'], $_GET['isbn_13']);
	if($book_version_id) {
	
		?>
		
		
<html>
<head>
</head>
<body>


<h1>Version successfully added!</h1>
Version:<?=$_GET['version']?><br />
ISBN-10:<?=$_GET['isbn_10']?><br />
ISBN-13:<?=$_GET['isbn_13']?><br />

<h2>Add instance:</h2>

<form method="get" action="submitInstance.php">
	price:<input type="text" name="price" value="price" /><br />
	seller:<input type="text" name="seller" value="seller" /><br />
	<input type="hidden" name="book_version_id" 
		value="<?=$book_version_id?>" />

	<input type="submit" value="Add" />
</form>

</body>
</html>		


		
		<?
		
	}
	else {
	
		?>
		
		
		
<html>
<head>
</head>
<body>


<h1>Error adding version.</h1>
<h2>Please try again.</h2>

<form method="get" action="submitVersion.php">
	Version:<input type="text" name="version" value="version" /><br />
	ISBN-10:<input type="text" name="isbn_10" value="isbn_10" /><br />
	ISBN-13:<input type="text" name="isbn_13" value="isbn_13" /><br />
	<input type="hidden" name="book_id" value="<?=$_GET['book_id']?>" />

	<input type="submit" value="Add" />
</form>

</body>
</html>			
		
		<?	
		
	}
	
?>



