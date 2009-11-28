


<html>
<head>
</head>
<body>


<h1>Current Listings</h1>

<?
	require("api.php");

	$book_instances = get_all_book_instances();
	
	echo "<ul>";
	foreach($book_instances as $book_instance) {
		?>
			<li>
				<h2><?=$book_instance['title']?></h2>
				<h3><?=$book_instance['author']?></h3>
				description:<?=$book_instance['description']?><br />
				version:<?=$book_instance['version']?><br />
				isbn:<?=$book_instance['isbn_13']?><br />
				price:<?=$book_instance['price']?><br />
				<a href="buy.php?instance=<?=$book_instance['book_instance_id']?>">buy</a>
			</li>
		<?
		
	}
	echo "</ul>";
?>

</body>
</html>
