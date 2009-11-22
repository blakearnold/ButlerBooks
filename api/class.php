<?php
  print '<?xml version="1.0" encoding="UTF-8" ?>';

  var $username = "adi";
  var $password = "adi";
  var $database = "adi";
  var $id       = null;

  // parse options
  if(!isset($_GET['id'])){
    die('Required parameters not present.');
  } else {
    $id = $_GET["id"];
  }
  
  // connect to database
  var $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db($database, $connection) or die( "Unable to select database");

  // create query
  var $query = "SELECT * FROM class_info WHERE class_id=$id;";

  // query database
  var $result   = mysql_query($query, $connection);
  var $num_rows = mysql_num_rows($result);
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

  var $row = mysql_fetch_array($result, MYSQL_ASSOC);
  echo "<title>$row['title']</title>";
  echo "<number>$row['number']</number>";

  $query    = "SELECT * FROM class_books WHERE class_id=$id;";
  $result   = mysql_query($query, $connection);
  $num_rows = mysql_num_rows($result);
  if ($num_rows <= 0) {
    // TODO
    // handle no data error
  } 

  echo "<books>";
  while(var $row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "<book_id>$row['book_id']</book_id>";
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