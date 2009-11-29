<?
	require("api.php");
	
	$book_id = add_book($_GET['title'], $_GET['author'], $_GET['description']);
	
	if($book_id) {
	
		?>
		
		
<html>
<head>
</head>
<body>


<h1>Book successfully added!</h1>
Title:<?=$_GET['title']?><br />
Author:<?=$_GET['author']?><br />
Description:<?=$_GET['description']?><br />

<h2>Add version:</h2>

<form method="get" action="submitVersion.php">
	Version:<input type="text" name="version" value="version" /><br />
	ISBN-10:<input type="text" name="isbn_10" value="isbn_10" /><br />
	ISBN-13:<input type="text" name="isbn_13" value="isbn_13" /><br />
	<input type="hidden" name="book_id" value="<?=$book_id?>" />

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


<h1>Error adding book.</h1>
<h2>Please try again:</h2>

<form method="get" action="submitBook.php">
	Title:<input type="text" name="title" value="title" /><br />
	Author:<input type="text" name="author" value="author" /><br />
	Description:<input type="text" name="description" value="description" /><br />

	<input type="submit" value="Add" />
</form> 


</body>
</html>		
		
		<?	
		
	}
	
?>



