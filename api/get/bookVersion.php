<?
/**
* @file bookVersion.php
* @author Willi Ballenthin
* @date Nov, 2009
*
*/
?>


<?php
  print '<?xml version="1.0" encoding="UTF-8" ?>';

  $username = "adi";
  $password = "adi";
  $database = "adi";
  $id       = null;

  // parse options
  if(!isset($_GET['id'])){
  	// TODO
  	// do something other than die
    die('Required parameters not present.');
  } else {
    $id = $_GET["id"];
  }
  
  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db($database, $connection) or die( "Unable to select database");

  $query = "SELECT * FROM book_info;";
  $result   = mysql_query($query, $connection);
  $num_rows = mysql_num_rows($result);
  if ($num_rows <= 0) { /* TODO  */}

  ?>
<response>
  <query>
  	<method>get/books</method>
  </query>
  <result>
  	<num_books><?=$num_rows?></num_books>
    <books>
    
    <?

	  while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	  	echo "<book>";
		echo "<book_id>$row[book_id]</book_id>";
		echo "<title>$row[title]</title>";
		echo "<author>$row[author]</author>";
		echo "<description>$row[description]</description>";
		echo "</book>";
	  }
	  
	?>
	
    </books>
  </result>
<response><?
  
  mysql_close($connection);

php?>
