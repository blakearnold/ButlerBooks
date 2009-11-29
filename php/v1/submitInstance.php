<?
	require("api.php");
	
	$book_instance_id = add_instance($_GET['book_version_id'], $_GET['seller'], $_GET['price']);
	if($book_instance_id) {
	
		?>
		
		
<html>
<head>
</head>
<body>


<h1>Instance successfully added!</h1>
Seller:<?=$_GET['seller']?><br />
Price:<?=$_GET['price']?><br />

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


<h1>Error adding instance.</h1>
<h2>Please try again.</h2>

<form method="get" action="submitInstance.php">
	price:<input type="text" name="price" value="price" /><br />
	seller:<input type="text" name="seller" value="seller" /><br />
	<input type="hidden" name="book_version_id" 
		value="<?=$_GET['book_version_id']?>" />

	<input type="submit" value="Add" />
</form>

</body>
</html>			
		
		<?	
		
	}
	
?>



