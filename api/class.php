/**
* @file class.php
* @author Willi Ballenthin
* @date Nov, 2009
*
*/

<?php
  print '<?xml version="1.0" encoding="UTF-8" ?>';

  $username = "adi";
  $password = "adi";
  $database = "adi";
  $id       = null;

  // parse options
  if(!isset($_GET['id'])){
    die('Required parameters not present.');
  } else {
    $id = $_GET["id"];
  }
  
  // connect to database
  $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    die('Could not connect: ' . mysql_error());
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
  }

  // build response
  ?>
<response>
  <query>
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
    // TODO
    // handle no data error
  } 

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