<?php
  print '<?xml version="1.0" encoding="UTF-8" ?>';

  var $username = "adi";
  var $password = "adi";
  var $database = "adi";

  // parse options
  var $id = $_GET["id"];
  if (!$id) {
    die('Required parameters not present');
  }
  
  // connect to database
  var $connection = mysql_connect(localhost, $username, $password);
  if (!$connection) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db($database, $connection) or die( "Unable to select database");

  // create query
  var $query = "SELECT * FROM classes WHERE id=$id";

  // query database
  var $result = mysql_query($query, $connection);

  // build response
  while(var $row = mysql_fetch_array($result, MYSQL_ASSOC))
  {
      echo "Name :{$row['name']} <br>" .
          "Subject : {$row['subject']} <br>" .
          "Message : {$row['message']} <br><br>";
  }

  // print it

  // return
  mysql_close($connection);

php?>