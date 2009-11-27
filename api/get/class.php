<?
/**
* @file class.php
* @author Willi Ballenthin
* @date Nov, 2009

output:

<?xml version="1.0" encoding="UTF-8" ?>
<response>
  <query>
    <id>[id]</id>
  </query>
  <result>
    <class>
		<id>$id</id>
		<title>$row[title]</title>
		<num_books>$row[number]</num_books>
		<books>
			<book_id>$row[book_id]</book_id>
			<book_id>$row[book_id]</book_id>
			...
			<book_id>$row[book_id]</book_id>
      	</books>
    </class>
  </result>
<response>

sample output:
<response> 
  <query> 
  	<method>get/class</method> 
    <id>1</id> 
  </query> 
  <result> 
    <class> 
	  <id>1</id>
	  <title>Object Oriented Design</title>
	  <number>1007</number>
	  <num_books>1</num_books>
	  <books>
	  	<book_id>1</book_id> 
	  </books> 
    </class> 
  </result> 
<response> 


error output:

<?xml version="1.0" encoding="UTF-8" ?>
  <response>
    <query>
      <id><?=$id?></id>
    </query>
    <error>
      <text>
        The specified class does not exist.
      </text>
    </error>
  </response>

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
  	?>
      <response>
        <query>
          <method>get/class</method>
          <id><?=$id?></id>
        </query>
        <error>
          <text>
            Required parameters not present.
          </text>
        </error>
      <?
      return;
  } else {
    $id = $_GET["id"];
  }
  
  // connect to database
  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
  	?>
      <response>
        <query>
          <method>get/class</method>
          <id><?=$id?></id>
        </query>
        <error>
          <text>
            Could not connect to database.
          </text>
        </error>
      </response>
    <?

    return;
  }
  mysql_select_db($database, $connection) or die( "Unable to select database");

  // create query
  $query = "SELECT * FROM class_info WHERE class_id=$id;";

  // query database
  $result   = mysql_query($query, $connection);
  $num_rows = mysql_num_rows($result);
  if ($num_rows <= 0) {
    // TODO
    // handle no data error
    ?>
      <response>
        <query>
          <method>get/class</method>
          <id><?=$id?></id>
        </query>
        <error>
          <text>
            The specified class does not exist.
          </text>
        </error>
      </response>
    <?

    return;
  }

  // build response
  ?>
<response>
  <query>
  	<method>get/class</method>
    <id><?=$id?></id>
  </query>
  <result>
    <class>
  <?
  echo "<id>$id</id>";

  $row = mysql_fetch_array($result, MYSQL_ASSOC);
  print "<title>$row[title]</title>";
  echo "<number>$row[number]</number>";

  $query    = "SELECT * FROM class_books WHERE class_id=$id;";
  $result   = mysql_query($query, $connection);
  $num_rows = mysql_num_rows($result);
  if ($num_rows <= 0) {
    // i dont think this is an error
    // there are just no books
  } 
  echo "<num_books>$num_rows</num_books>";

  echo "<books>";
  while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "<book_id>$row[book_id]</book_id>";
  }
  ?>
      </books>
    </class>
  </result>
<response>

  <?
  // return
  mysql_close($connection);

php?>
