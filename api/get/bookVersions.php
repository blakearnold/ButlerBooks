<?
/**
* @file bookVersions.php
* @author Willi Ballenthin
* @date Nov, 2009
*

<response> 
  <query> 
  	<method>get/bookVersions</method> 
  	<book>1</book> 
  </query> 
  <result> 
  	<num_book_versions>1</num_book_versions> 
    <book_versions> 
    	<book_version>
    		<book_version_id>1</book_version_id>
    		<version>1</version>
    		<isbn_10>1234567890</isbn_10>
    		<isbn_13>1234567890123</isbn_13>
    	</book_version>	
    </book_versions> 
  </result> 
<response>

*/
?>


<?php
  print '<?xml version="1.0" encoding="UTF-8" ?>';

  $username = "adi";
  $password = "adi";
  $database = "adi";
  $id       = null;

  // parse options
  if(!isset($_GET['book'])){
  	// TODO
  	// do something other than die
    die('Required parameters not present.');
  } else {
    $id = $_GET["book"];
  }
  
  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db($database, $connection) or die( "Unable to select database");

  $query = "SELECT * FROM book_version_info WHERE book_id=$id;";
  $result   = mysql_query($query, $connection);
  $num_rows = mysql_num_rows($result);
  if ($num_rows <= 0) { /* TODO  */}

  ?>
<response>
  <query>
  	<method>get/bookVersions</method>
  	<book><?=$id?></book>
  </query>
  <result>
  	<num_book_versions><?=$num_rows?></num_book_versions>
    <book_versions>
    
    <?

	  while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	  	echo "<book_version>";
		echo "<book_version_id>$row[book_version_id]</book_version_id>";
		echo "<version>$row[version]</version>";
		echo "<isbn_10>$row[isbn_10]</isbn_10>";
		echo "<isbn_13>$row[isbn_13]</isbn_13>";
		echo "</book_version>";
	  }
	  
	?>
	
    </book_versions>
  </result>
<response><?
  
  mysql_close($connection);

php?>
